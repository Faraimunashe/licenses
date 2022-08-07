<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::latest()->get();
        return view('admin.dashboard', [
            'transactions' => $transactions
        ]);
    }
}
