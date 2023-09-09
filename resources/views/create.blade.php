@extends('main')

@section('title', 'Add Record')

@section('content')
<div class="d-flex flex-column" style="height: 100%">
  <div class="d-flex header justify-content-center text-light my-3 position-relative">
    <h5 class="m-0 py-3 page-title-dark">Tambah Transaksi</h5>
  </div>

  <div class="bg-tabs d-flex justify-content-between gap-1 mb-4 mx-4" role="group" aria-label="Basic radio toggle button group">
    <input type="radio" class="input-jenis" name="type_fake" id="btnradio1" autocomplete="off" value="pemasukan" {{ old('type') == 'pemasukan' ? 'checked' : '' }} checked>
    <label class="btn-outline-primary label-jenis" for="btnradio1">Pemasukan</label>

    <input type="radio" class="input-jenis" name="type_fake" id="btnradio2" autocomplete="off" value="pengeluaran" {{ old('type') == 'pengeluaran' ? 'checked' : '' }}>
    <label class="btn-outline-primary label-jenis" for="btnradio2">Pengeluaran</label>
  </div>

  <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data" class="overflow-y-scroll disable-scrollbar">
    @csrf
    {{-- fake type --}}
    <input class="d-none" type="radio" id="pemasukan" name="type" value="pemasukan" {{ old('type') == 'pemasukan' ? 'checked' : '' }} checked>
    <input class="d-none" type="radio" id="pengeluaran" name="type" value="pengeluaran" {{ old('type') == 'pengeluaran' ? 'checked' : '' }}>
    {{-- title --}}
    <div class="mb-3">
      <label for="nama-trx" class="form-label">Judul</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="nama-trx" placeholder="Masukkan Judul" value="{{ old('title') }}" required>
      @error('title')
      <div class="invalid-feedback">
        Judul tidak boleh kosong
      </div>
      @enderror
    </div>
    {{-- amount --}}
    <div class="mb-3">
      <label for="jumlah-trx" class="form-label">Jumlah</label>
      <div class="input-group has-validation" id="parent-jumlah">
        @if(old('type') == 'pengeluaran')
        <span class="input-group-text prepend prepend-pengeluaran">- Rp</span>
        @else
        <span class="input-group-text prepend prepend-pemasukan">+ Rp</span>
        @endif
        <input type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" id="jumlah-trx" placeholder="Masukkan Jumlah" aria-describedby="inputGroupPrepend" value="{{ old('amount') }}" onkeyup="formatRupiah(this)" required>
        <span class="input-group-text">,00</span>
        <div class="invalid-feedback">
          Pilih bilangan bulat saja
        </div>
      </div>
    </div>
    {{-- category --}}
    <div class="mb-3">
      <label for="jumlah-trx" class="form-label">Kategori</label>
      <select class="form-select @error('category') is-invalid @enderror" name="category" id="select-kategori" aria-label="Default select example" required>
        @switch(old('type'))
        @case('pengeluaran')
        <option selected>-- Pilih kategori pengeluaran --</option>
        <option {{ old('category') == 'belanja-kebutuhan' ? "selected" : "" }} value="belanja-kebutuhan">Belanja Kebutuhan</option>
        <option {{ old('category') == 'tagihan' ? "selected" : "" }} value="tagihan">Tagihan</option>
        <option {{ old('category') == 'pengeluaran-lain' ? "selected" : "" }} value="pengeluaran-lain">Pengeluaran Lain</option>
        @break
        @case('pemasukan')
        <option selected>-- Pilih kategori pemasukan --</option>
        <option {{ old('category') == 'iuran-anggota' ? "selected" : "" }} value="iuran-anggota">Iuran Anggota</option>
        <option {{ old('category') == 'pemasukan-lain' ? "selected" : "" }} value="pemasukan-lain">Pemasukan Lain</option>
        @break
        @default
        <option selected>-- Pilih kategori pemasukan --</option>
        <option {{ old('category') == 'iuran-anggota' ? "selected" : "" }} value="iuran-anggota">Iuran Anggota</option>
        <option {{ old('category') == 'pemasukan-lain' ? "selected" : "" }} value="pemasukan-lain">Pemasukan Lain</option>
        @endswitch
      </select>
      @error('category')
      <div class="invalid-feedback">
        Pilih kategori yang sesuai
      </div>
      @enderror
    </div>
    {{-- date --}}
    <div class="mb-3">
      <label for="tanggal-trx" class="form-label">Tanggal</label>
      <input type="date" max="{{ now()->toDateString('Y-m-d') }}" class="form-control @error('date') is-invalid @enderror" name="date" id="tanggal-trx" value="{{ old('date') }}" required>
      @error('date')
      <div class="invalid-feedback">
        Pilih tanggal yang benar
      </div>
      @enderror
    </div>
    {{-- note --}}
    <div class="mb-3">
      <label for="catatan-trx" class="form-label">Catatan</label>
      <input type="text" class="form-control" name="note" id="catatan-trx" placeholder="Masukkan Catatan" value="{{ old('note') }}">
    </div>
    {{-- attachment --}}
    <div class="mb-4">
      <label for="file-trx" class="form-label">Lampiran</label>
      <input class="form-control" type="file" name="attachment" id="file-trx" value="{{ old('attachment') }}">
    </div>
    {{-- submit --}}
    <button type="submit" class="btn btn-simpan float-end mb-4">Simpan</button>
  </form>
</div>
@endsection

@section('script')
<script>
  function formatRupiah(input) {
    // Menghapus semua karakter selain digit
    var rupiah = input.value.replace(/\D/g, "");

    // Menggunakan ekspresi reguler untuk menambahkan titik setiap 3 digit
    rupiah = rupiah.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    // Mengatur nilai input dengan format mata uang Rupiah
    input.value = rupiah;
  }

</script>
<script>
  $(document).ready(function() {
    $('input[type="radio"]').change(function() {
      var jenisTransaksi = $('input[name="type_fake"]:checked').val();
      if (jenisTransaksi == 'pengeluaran') {
        $('#select-kategori').html('<option selected>-- Pilih kategori pengeluaran --</option>' +
          '<option {{ old("category") == "belanja-kebutuhan" ? "selected" : "" }} value="belanja-kebutuhan">Belanja Kebutuhan</option>' +
          '<option {{ old("category") == "tagihan"? "selected" : "" }} value="tagihan">Tagihan</option>' +
          '<option {{ old("category") == "pengeluaran-lain" ? "selected" : "" }} value="pengeluaran-lain">Pengeluaran Lain</option>'
        );
        // $('.prepend').text('- Rp');
        $('.prepend').addClass('prepend-pengeluaran')
        $("#pengeluaran").prop("checked", true);
      } else {
        $('#select-kategori').html('<option selected>-- Pilih kategori pemasukan --</option>' +
          '<option {{ old("category") == "iuran-anggota" ? "selected" : "" }} value="iuran-anggota">Iuran Anggota</option>' +
          '<option {{ old("category") == "pemasukan-lain" ? "selected" : "" }} value="pemasukan-lain">Pemasukan Lain</option>'
        );
        // $('.prepend').text('+ Rp');
        $('.prepend').removeClass('prepend-pengeluaran')
        $("#pemasukan").prop("checked", true);
      }
    });
  });

</script>
@endsection
