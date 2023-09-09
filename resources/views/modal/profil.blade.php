<div class="modal fade" id="profilModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered px-5">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="profilModalLabel">Profil Pengguna</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center pb-4">
        <img src="{{ Auth::user()->avatar }}" class="img-thumbnail my-4">
        <p class="label-item mt-3 mb-1">Nama</p>
        <h5 class="nama-user"> {{ Auth::user()->name }}</h5>
        <p class="label-item mt-3 mb-1">Email</p>
        <h6 class="atribut-user"> {{ Auth::user()->email }}</h6>
        <p class="label-item mt-3 mb-1">Status</p>
        @if(Auth::user()->is_admin)
        {!! Auth::user()->is_admin == 1 ? '<span class="badge text-bg-secondary">Admin</span>' : '' !!}
        @else
        <h6 class="atribut-user">{{ Auth::user()->user_verified_at == null ? 'Unverified' : 'Verified' }}</h6>
        @endif
      </div>
    </div>
  </div>
</div>
