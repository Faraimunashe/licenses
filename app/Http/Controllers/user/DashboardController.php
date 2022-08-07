<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyDirector;
use App\Models\License;
use App\Models\LicenseFee;
use App\Models\Registration;
use App\Models\RegistrationFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(!registered_company(Auth::id()))
        {
            return redirect()->route('user-company-registry')->with('error', 'you must register company first!');
        }
        $company = Company::where('user_id', Auth::id())->first();
        $directors = CompanyDirector::where('company_id', $company->id)->get();
        $regfee = RegistrationFee::first();
        $licensefee = LicenseFee::first();
        $registration = Registration::where('company_id', $company->id)->first();
        $license = License::where('company_id', $company->id)->first();
        //dd($license->expiry);

        return view('user.dashboard', [
            'company' => $company,
            'directors' => $directors,
            'regfee' => $regfee,
            'licensefee' => $licensefee,
            'registration' => $registration,
            'license' => $license
        ]);
    }
}
