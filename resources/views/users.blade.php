@extends('main')

@section('title', 'History')

@section('content')
<div class="d-flex flex-column" style="height: inherit">
  <div class="d-flex header justify-content-center text-light my-3 position-relative">
    <h5 class="m-0 py-3 page-title-dark">Manage Users</h5>
  </div>

  <div class="last-transaction card " style="height: inherit">
    <ul class="list-group list-group-flush" style="height: 100%">
      <li class="list-group-item overflow-y-scroll py-2 px-2" style="height: inherit">
        <ul class="list-group list-group-flush">
          @foreach ($users as $user)
          <li class="list-group-item px-0">
            <div class="d-flex justify-content-between py-1 mx-2 disable-cursor">
              <div class="list-item-kiri d-flex gap-2" style="width: 60%">
                <div class="list-img d-flex">
                  <img src="{{ asset('img/google-logo.png') }}" alt="" style="width: 24px">
                </div>
                <div class="list-desc d-flex flex-column justify-content-center">
                  <h5 class="m-0 item-name">{{ ucwords(strtolower($user->name)) }}

                  </h5>
                </div>
              </div>
              <div class="list-item-kanan d-flex flex-column justify-content-center align-items-end" style="width: 35%">
                Kanan
              </div>
            </div>
          </li>
          @endforeach

  </div>

</div>
@endsection
