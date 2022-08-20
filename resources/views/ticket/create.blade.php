<div class="row">
    <div class="col-12 bg-light p-5 rounded">
        <div class="row">
            <div class="col-10">
                <h1>Buat Tiket</h1>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('ticket.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-10">
                        <label>User</label>
                        <input type="text" class="form-control" name="id_user" required>
                    </div>
                    <div class="col-5">
                        <label>Tipe Tiket</label>
                        <select class="form-control" name="type_ticket" required>
                            <option value="">-- Pilih Tipe Tiket --</option>
                            <option value="0">Troubleshooting</option>
                            <option value="1">Pengadaan Barang</option>
                            <option value="2">Maintenance</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <label>Label</label>
                        <select class="form-control" name="label" required>
                            <option value="">-- Pilih Label --</option>
                            <option value="0">Tidak Butuh Cepat</option>
                            <option value="1">Biasa</option>
                            <option value="2">Butuh Cepat</option>
                        </select>
                    </div>
                    <div class="col-10">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="judul" required>
                    </div>
                    <div class="col-10">
                        <label>deskripsi</label>
                        <textarea class="form-control" name="deskripsi" required></textarea>
                    </div>
                    <div class="col-10">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                    <div class="col-10">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>