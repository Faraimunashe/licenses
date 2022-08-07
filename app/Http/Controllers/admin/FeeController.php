<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LicenseFee;
use App\Models\RegistrationFee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
        $registration = RegistrationFee::first();
        $license = LicenseFee::first();

        return view('admin.fees', [
            'registration'=>$registration,
            'license'=>$license
        ]);
    }

    public function update_reg(Request $request)
    {
        $request->validate([
            'amount'=>['required','numeric']
        ]);

        $reg = RegistrationFee::first();

        $reg->amount = $request->amount;
        $reg->save();

        return redirect()->back()->with('success', 'successfully updated registration fee');
    }

    public function update_license(Request $request)
    {
        $request->validate([
            'amount'=>['required','numeric']
        ]);

        $lic = LicenseFee::first();

        $lic->amount = $request->amount;
        $lic->save();

        return redirect()->back()->with('success', 'successfully updated license fee');
    }
}
