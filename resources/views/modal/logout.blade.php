<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered px-5">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-6" id="logoutModalLabel">Konfirmasi Logout</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center py-4">
        Apakah Anda yakin logout?
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
        <a href="{{ route('logout') }}" class="btn btn-logout">Logout</a>
      </div>
    </div>
  </div>
</div>
