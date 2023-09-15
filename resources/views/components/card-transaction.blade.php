<li class="list-group-item px-0">
  <a class="text-decoration-none" target="_blank" @if (stripos($transaction->attachment, 'drive') !== false )
    href="{{ $transaction->attachment }}"
    @elseif($transaction->attachment != null)
    href="{{ route('transaction.get-image', ['transaction' => $transaction->id]) }}"
    @endif>
    <div class="d-flex justify-content-between py-1 mx-2 disable-cursor">
      <div class="list-item-kiri d-flex gap-2" style="width: 60%">
        <div class="list-img d-flex">
          <img src="{{ asset('img/icon-'. $transaction->category .'.svg') }}" alt="" style="width: 48px">
        </div>
        <div class="list-desc d-flex flex-column justify-content-center">
          <h6 class="m-0 item-name">{{ ucwords(strtolower($transaction->title)) }}
            {{ $transaction->attachment != null ? '✅' : '' }}
          </h6>
          <p class="m-0 item-desc">{{ ucwords(str_replace("-", " ", $transaction->category))  }}</p>
          <p class="m-0 item-note"><i>{!! $transaction->note !!}</i></p>
        </div>
      </div>
      <div class="list-item-kanan d-flex flex-column justify-content-center align-items-end" style="width: 35%">
        @if($transaction->type == 'pengeluaran')
        <h6 class="m-0 item-amount pengeluaran">- @currency(abs($transaction->amount))</h6>
        @else
        <h6 class="m-0 item-amount pemasukan">+ @currency(abs($transaction->amount))</h6>
        @endif
        <p class="m-0 item-date">{{ date('d/m/Y H.i', strtotime($transaction->datetime)) }}</p>
      </div>
    </div>
  </a>
</li>
