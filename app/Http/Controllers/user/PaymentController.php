<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\License;
use App\Models\Paynowlog;
use App\Models\Registration;
use App\Models\Transaction;
use App\Rules\RegFeeRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function registration(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10|starts_with:07',
            'amount' => ['required','numeric',new RegFeeRule()],
            'email' => ['required', 'email']
        ]);

        $company = Company::where('user_id', Auth::id())->first();

        $wallet = "ecocash";

        //get all data ready
        $email = $request->email;
        $phone = $request->phone;
        $amount = $request->amount;

        /*determine type of wallet*/
        if (strpos($phone, '071') === 0) {
            $wallet = "onemoney";
        }

        $paynow = new \Paynow\Payments\Paynow(
            "11336",
            "1f4b3900-70ee-4e4c-9df9-4a44490833b6",
            route('company-pay-registration'),
            route('company-pay-registration'),
        );

        // Create Payments
        $invoice_name = "company_registration" . time();
        $payment = $paynow->createPayment($invoice_name, $email);

        $payment->add("Company Registration Fee", $amount);

        $response = $paynow->sendMobile($payment, $phone, $wallet);


        // Check transaction success
        if ($response->success()) {

            $timeout = 9;
            $count = 0;

            while (true) {
                sleep(3);
                // Get the status of the transaction
                // Get transaction poll URL
                $pollUrl = $response->pollUrl();
                $status = $paynow->pollTransaction($pollUrl);


                //Check if paid
                if ($status->paid()) {
                    // Yay! Transaction was paid for
                    // You can update transaction status here
                    // Then route to a payment successful
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::user()->id;
                    $trans->reference = $info['paynowreference'];
                    $trans->method = $wallet;
                    $trans->purpose = "registration";
                    $trans->amount = $info['amount'];
                    $trans->status = "successful";

                    $trans->save();

                    $registration = new Registration();
                    $registration->company_id = $company->id;
                    $registration->amount = $info['amount'];
                    $registration->status = 1;
                    $registration->save();

                    return redirect()->back()->with('success', 'you have successfully paid registration fee!');
                }


                $count++;
                if ($count > $timeout) {
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();


                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::user()->id;
                    $trans->reference = $info['paynowreference'];
                    $trans->method = $wallet;
                    $trans->purpose = "registration";
                    $trans->amount = $info['amount'];
                    $trans->status = $info['status'];
                    $trans->save();

                    return redirect()->back()->with('error', 'Please wait a moment and refresh page transaction still processing');
                } //endif
            } //endwhile
        } //endif


        //total fail
        return redirect()->back()->with('error', 'We could not perform your request at the moment');

    }

    public function license(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits:10|starts_with:07',
            'amount' => ['required','numeric',new RegFeeRule()],
            'email' => ['required', 'email']
        ]);

        $company = Company::where('user_id', Auth::id())->first();

        $reg = check_registration($company->id);
        if($reg < 1){
            return redirect()->back()->with('error', 'Error! you are not registered to operate as a company');
        }

        $wallet = "ecocash";

        //get all data ready
        $email = $request->email;
        $phone = $request->phone;
        $amount = $request->amount;

        /*determine type of wallet*/
        if (strpos($phone, '071') === 0) {
            $wallet = "onemoney";
        }

        $paynow = new \Paynow\Payments\Paynow(
            "11336",
            "1f4b3900-70ee-4e4c-9df9-4a44490833b6",
            route('company-pay-registration'),
            route('company-pay-registration'),
        );

        // Create Payments
        $invoice_name = "license_fees" . time();
        $payment = $paynow->createPayment($invoice_name, $email);

        $payment->add("License Fee", $amount);

        $response = $paynow->sendMobile($payment, $phone, $wallet);


        // Check transaction success
        if ($response->success()) {

            $timeout = 9;
            $count = 0;

            while (true) {
                sleep(3);
                // Get the status of the transaction
                // Get transaction poll URL
                $pollUrl = $response->pollUrl();
                $status = $paynow->pollTransaction($pollUrl);


                //Check if paid
                if ($status->paid()) {
                    // Yay! Transaction was paid for
                    // You can update transaction status here
                    // Then route to a payment successful
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();

                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::user()->id;
                    $trans->reference = $info['paynowreference'];
                    $trans->method = $wallet;
                    $trans->purpose = "license";
                    $trans->amount = $info['amount'];
                    $trans->status = "successful";

                    $trans->save();

                    $lic = License::where('company_id', $company->id)->first();
                    if(is_null($lic)){
                        $lic = new License();
                        $lic->company_id = $company->id;
                        $lic->status = 1;
                        $lic->expiry = add_license_days();
                        $lic->paid = $info['amount'];
                        $lic->save();
                    }else{
                        $lic->status = 1;
                        $lic->expiry = add_license_days();
                        $lic->paid = $info['amount'];
                        $lic->save();
                    }

                    return redirect()->back()->with('success', 'you have successfully paid license fee!');
                }


                $count++;
                if ($count > $timeout) {
                    $info = $status->data();

                    $paynowdb = new Paynowlog();
                    $paynowdb->reference = $info['reference'];
                    $paynowdb->paynow_reference = $info['paynowreference'];
                    $paynowdb->amount = $info['amount'];
                    $paynowdb->status = $info['status'];
                    $paynowdb->poll_url = $info['pollurl'];
                    $paynowdb->hash = $info['hash'];
                    $paynowdb->save();


                    //transaction update
                    $trans = new Transaction();
                    $trans->user_id = Auth::user()->id;
                    $trans->reference = $info['paynowreference'];
                    $trans->method = $wallet;
                    $trans->purpose = "license";
                    $trans->amount = $info['amount'];
                    $trans->status = $info['status'];
                    $trans->save();

                    return redirect()->back()->with('error', 'Please wait a moment and refresh page transaction still processing');
                } //endif
            } //endwhile
        } //endif


        //total fail
        return redirect()->back()->with('error', 'We could not perform your request at the moment');

    }
}
