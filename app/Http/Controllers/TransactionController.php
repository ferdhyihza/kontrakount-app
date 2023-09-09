<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = parent::getTransaction();
        $arr_saldo_perbulan = array();
        for ($i = 0; $i < 100; $i++) {
            $jumlah_transaksi_per_bulan = count(Transaction::bulanSebelumIni($i)->get());
            if ($jumlah_transaksi_per_bulan > 0) {
                array_push($arr_saldo_perbulan, Transaction::bulanSebelumIni($i)->get()->sum('amount'));
            }
        };
        // return dd($arr_saldo_perbulan);

        return view('history', [
            'transactions' => $transactions,
            'arr_saldo_perbulan' => $arr_saldo_perbulan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plain_amount = (int) preg_replace('/\./', '', $request->amount);
        $request->merge(['amount' => $plain_amount]);
        $rules = [
            'type' => 'required|in:pemasukan,pengeluaran',
            'title'     => 'required',
            'amount'     => 'required|integer|min:3',
            'category'     => 'required|in:iuran-anggota,pemasukan-lain,belanja-kebutuhan,tagihan,pengeluaran-lain',
            'datetime' => 'required',
            'note' => '',
            'attachment' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        $validated_data = $request->validate($rules);
        if ($validated_data['type'] == 'pengeluaran') {
            $validated_data['amount'] = $validated_data['amount'] * -1;
        };
        // return dd($validated_data);

        //upload image
        if (isset($validated_data['attachment'])) {
            $image = $request->file('attachment');
            // $image->storeAs('public/transactions', $image->hashName());
            Gdrive::put($image->hashName(), $image);
            $validated_data['attachment'] = $image->hashName();
        };

        //create post
        Transaction::create($validated_data);

        //redirect to index
        return redirect()->route('dashboard')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {

        // return dd($transaction);
        return view('detail', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
        // Gdrive::delete($transaction->attachment);
    }

    public function getImage(Transaction $transaction)
    {
        $data = Gdrive::get($transaction->attachment);
        return response($data->file, 200)
            ->header('Content-Type', $data->ext);
    }
}
