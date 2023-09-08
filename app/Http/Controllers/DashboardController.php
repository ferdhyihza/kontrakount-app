<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        $transactions = parent::getTransaction(10);
        $pemasukan = Transaction::where('type', 'pemasukan')->sum('amount');
        $pengeluaran = Transaction::where('type', 'pengeluaran')->sum('amount');
        $saldo = Transaction::sum('amount');

        // return dd($pemasukan);

        return view('dashboard', [
            'transactions' => $transactions,
            'saldo' => $saldo,
            'pemasukan' => $pemasukan,
            'pengeluaran' => abs($pengeluaran)
        ]);
    }
}
