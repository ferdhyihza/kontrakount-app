<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getTransaction($x = 0)
    {
        if ($x == 0) $transactions = Transaction::orderBy('datetime', 'DESC')->get();
        else $transactions = Transaction::orderBy('datetime', 'DESC')->take($x)->get();
        return $transactions;
    }
}
