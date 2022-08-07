<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations =  Company::join('registrations', 'registrations.company_id', '=', 'companies.id')
            ->join('users', 'users.id', '=', 'companies.user_id')
            ->where('companies.status', 0)
            ->select('users.name as user', 'companies.id', 'companies.name', 'companies.address', 'companies.objectives')
            ->orderBy('companies.created_at', 'desc')
            ->get();

        return view('admin.registration', [
            'registrations' => $registrations
        ]);
    }

    public function approve($id)
    {
        $company = Company::find($id);
        if(is_null($company)){
            return redirect()->back()->with('error', 'could not locate this registration record');
        }

        $company->status = 1;
        $company->save();

        return redirect()->back()->with('success', 'successfully approved application');
    }
}
