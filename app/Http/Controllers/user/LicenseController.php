<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\License;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class LicenseController extends Controller
{
    public function index()
    {
        $company = Company::where('user_id', Auth::id())->first();
        $license = License::where('company_id', $company->id)->first();
        if(is_null($license)){
            return redirect()->back()->with('error', 'this company has no active licensing');
        }

        $registration = Registration::where('company_id', $company->id)->first();
        if(is_null($registration)){
            return redirect()->back()->with('error', 'this company has no active registration');
        }

        return view('user.license', [
            'company' => $company,
            'license' => $license,
            'registration' => $registration
        ]);
    }

    public function license_pdf()
    {
        $company = Company::where('user_id', Auth::id())->first();
        $license = License::where('company_id', $company->id)->first();
        $registration = Registration::where('company_id', $company->id)->first();

        $pdf = PDF::loadView('pdf.license-pdf', [
            'company' => $company,
            'license' => $license,
            'registration' => $registration
        ]);
        return $pdf->download($company->name.now().'.pdf');
    }
}
