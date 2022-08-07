<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->latest()->get();

        return view('user.transactions', [
            'transactions'=>$transactions
        ]);
    }
}
