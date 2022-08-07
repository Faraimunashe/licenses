<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::where('status', 1)
            ->get();

        return view('admin.companies', [
            'companies' =>$companies
        ]);
    }
}
