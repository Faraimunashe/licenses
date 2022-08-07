<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyDirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyRegistryController extends Controller
{
    public function index()
    {
        return view('user.company-registry');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'address'=>'required|string',
            'objectives'=>'required|string'
        ]);

        $namecheck = Company::where('name', 'LIKE', $request->name)->first();
        if(!is_null($namecheck)){
            return redirect()->back()->with('error', 'company name already taken');
        }

        $company = new Company();
        $company->user_id = Auth::id();
        $company->name = $request->name;
        $company->address = $request->address;
        $company->objectives = $request->objectives;
        $company->save();

        return redirect()->route('company-director')->with('success', 'successfully added company, now add directors!');
    }

    public function director()
    {
        return view('user.director');
    }

    public function post_director(Request $request)
    {
        $request->validate([
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'natid'=>'required|string',
            'address'=>'required|string',
            'shareholder'=>'required|numeric'
        ]);

        $company = Company::where('user_id', Auth::id())->first();
        if(is_null($company))
        {
            return redirect()->route('user-company-registry')->with('error', 'you need to register company details first');
        }


        $director = new CompanyDirector();
        $director->company_id = $company->id;
        $director->firstname = $request->firstname;
        $director->lastname = $request->lastname;
        $director->natid = $request->natid;
        $director->address = $request->address;
        $director->shareholder = $request->shareholder;
        $director->save();

        return redirect()->back()->with('success', 'successfully added director, you may add another');
    }
}
