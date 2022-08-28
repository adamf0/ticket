<!-- Tiket Troubleshooting -->
<div class="card card-round mb-4">
    <div class="card-body">
        <form action="{{ route('form-ticket.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <label for="exampleInputEmail1" class="form-label">Label (*)</label>
                    <select class="form-select" name="type_ticket" required>
                        <option value="">-- Pilih Tipe Tiket --</option>
                        <option value="0" <?php if($type=="troubleshooting"){ echo "selected"; } else{ echo "disabled"; } ?>>Troubleshooting</option>
                        <option value="1" <?php if($type=="permintaan_barang"){ echo "selected"; } else{ echo "disabled"; } ?>>Permintaan Barang</option>
                        <option value="2" <?php if($type=="maintenance"){ echo "selected"; } else{ echo "disabled"; } ?>>Maintenance</option>
                        <option value="3" <?php if($type=="request_personil"){ echo "selected"; } else{ echo "disabled"; } ?>>Request Personil</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="exampleInputEmail1" class="form-label">Label (*)</label>
                    <select class="form-select" name="label" required>
                        <option value="">-- Pilih Label --</option>
                        <option value="0">Tidak Butuh Cepat</option>
                        <option value="1">Biasa</option>
                        <option value="2">Butuh Cepat</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="exampleInputEmail1" class="form-label">Judul (*)</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="judul" required/>
                </div>
                <div class="col-6">
                    <label for="formFile" class="form-label">Foto</label>
                    <input class="form-control" type="file" id="formFile" name="foto"/>
                </div>
                <div class="col-12">
                    <label for="exampleFormControlTextarea1" class="form-label" >Deskripsi (*)</label>
                    <textarea style="resize: none" class="form-control" id="exampleFormControlTextarea1" rows="5" name="deskripsi" required></textarea>
                </div>
            </div>
            <button type="submit" style="float: right" class="btn btn-primary mt-4 w-25">Submit</button>
        </form>
    </div>
</div>