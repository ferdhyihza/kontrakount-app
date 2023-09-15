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
          $current_month = (int) date('m', strtotime($transaction->datetime));
          $year = date('Y', strtotime($transaction->datetime));
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
                @elseif($arr_saldo_perbulan[$i] < 0) <h6 class="mb-0 month-divider text-end">- @currency(abs($arr_saldo_perbulan[$i]))</h6>
                  @else
                  <h6 class="mb-0 month-divider text-end">@currency(abs($arr_saldo_perbulan[$i]))</h6>
                  @endif
              </div>
            </div>
          </li>
          <?php $i++; ?>
          @endif
          @php
          $last_month = $current_month;
          @endphp
          @include('components.card-transaction')
          @endforeach
          @if(count($transactions) == 0)
          <p class="text-center">-- No data available --</p>
          @endif
        </ul>
  </div>

</div>
@endsection
