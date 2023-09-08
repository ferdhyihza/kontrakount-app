@extends('main-nonav')

@section('title', 'History')

@section('content')
<div class="d-flex flex-column" style="height: inherit">
  <div class="d-flex header justify-content-center text-light my-3 position-relative">
    <h5 class="m-0 py-3 page-title-dark">Detail Transaksi</h5>
  </div>
  {{ $transaction }}

</div>
@endsection
