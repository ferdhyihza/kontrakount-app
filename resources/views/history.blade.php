@extends('main')

@section('title', 'History')

@section('content')
<div class="d-flex flex-column" style="height: inherit">
  <div class="d-flex header justify-content-center text-light my-3 position-relative">
    <h5 class="m-0 py-3 page-title-dark">Riwayat Transaksi</h5>
  </div>

  <div class="last-transaction card " style="height: inherit">
    <ul class="list-group list-group-flush" style="height: 100%">
      <li class="list-group-item overflow-y-scroll py-2 px-2" style="height: inherit">
        <ul class="list-group list-group-flush">
          @php
          $last_month = null;
          $i = 0;
          @endphp
          @foreach ($transactions as $transaction)
          @php
          $bulan = array (1 => 'Januari',
          'Februari',
          'Maret',
          'April',
          'Mei',
          'Juni',
          'Juli',
          'Agustus',
          'September',
          'Oktober',
          'November',
          'Desember'
          );
          $current_month = (int) date('m', strtotime($transaction->date));
          $year = date('Y', strtotime($transaction->date));
          @endphp
          @if($last_month != $current_month)
          <li class="list-group-item px-2 bg-light border {{ $loop->iteration != 1 ? 'border-top-0' : ''; }}">
            <div class="row">
              <div class="col">
                <h6 class="mb-0 month-divider">{{ $year . ' | ' . $bulan[$current_month] }}</h6>
              </div>
              <div class="col">
                @if($arr_saldo_perbulan[$i] > 0)
                <h6 class="mb-0 month-divider text-end">+ @currency(abs($arr_saldo_perbulan[$i]))</h6>
                @else
                <h6 class="mb-0 month-divider text-end">- @currency(abs($arr_saldo_perbulan[$i]))</h6>
                @endif
              </div>
            </div>
          </li>
          <?php $i++; ?>
          @endif
          @php
          $last_month = $current_month;
          @endphp
          <li class="list-group-item px-0">
            <div class="d-flex justify-content-between py-1 mx-2 disable-cursor">
              <div class="list-item-kiri d-flex gap-2" style="width: 60%">
                <div class="list-img d-flex">
                  <img src="{{ asset('img/icon-'. $transaction->category .'.svg') }}" alt="" style="width: 48px">
                </div>
                <div class="list-desc d-flex flex-column justify-content-center">
                  <a target="_blank" @if (stripos($transaction->attachment, 'drive') !== false )
                    href="{{ $transaction->attachment }}"
                    @elseif($transaction->attachment != null)
                    href="{{ route('transaction.get-image', ['transaction' => $transaction->id]) }}"
                    @endif class="m-0 item-name">{{ ucwords(strtolower($transaction->title)) }}
                    {{ $transaction->attachment != null ? '✅' : '' }}
                  </a>
                  <p class="m-0 item-desc">{{ ucwords(str_replace("-", " ", $transaction->category))  }}</p>
                  <p class="m-0 item-note"><i>{{ $transaction->note }}</i></p>
                </div>
              </div>
              <div class="list-item-kanan d-flex flex-column justify-content-center align-items-end" style="width: 35%">
                @if($transaction->type == 'pengeluaran')
                <h6 class="m-0 item-amount pengeluaran">- @currency(abs($transaction->amount))</h6>
                @else
                <h6 class="m-0 item-amount pemasukan">+ @currency(abs($transaction->amount))</h6>
                @endif
                <p class="m-0 item-date">{{ date('d/m/Y', strtotime($transaction->date)) }}</p>
              </div>
            </div>
          </li>
          @endforeach
          @if(count($transactions) == 0)
          <p class="text-center">-- No data available --</p>
          @endif
        </ul>
  </div>

</div>
@endsection
