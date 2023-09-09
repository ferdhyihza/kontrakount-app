<div class="modal fade" id="userModal{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered px-5">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="userModalLabel">Detail User</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center pb-4">
        <img src="{{ $user->avatar }}" class="img-thumbnail my-4">
        <p class="label-item mt-3 mb-1">Nama</p>
        <h5 class="nama-user"> {{ $user->name }}</h5>
        <p class="label-item mt-3 mb-1">Email</p>
        <h6 class="atribut-user"> {{ $user->email }}</h6>
        <p class="label-item mt-3 mb-1">Status</p>
        @if($user->is_admin)
        {!! $user->is_admin == 1 ? '<span class="badge text-bg-secondary">Admin</span>' : '' !!}
        @else
        @if($user->user_verified_at == null)
        <h6 class="atribut-user unverified">Unverified</h6>
        @else
        <h6 class="atribut-user verified">Verified</h6>
        @endif
        @endif
      </div>
      @if($user->user_verified_at == null)
      <div class="modal-footer d-flex justify-content-center">
        <form action="{{ route('user.verify',['user' => $user->id]) }}" method="POST">
          @csrf
          <button type="submit" class="btn btn-logout">Verified</button>
        </form>
      </div>

      @endif
    </div>
  </div>
</div>
