<?php 
    $type_ = '';
    $img = '';
    if($type=='troubleshooting'){ 
        $type_= 'Troubleshooting';
        $img = asset('assets/illus4.png');
    }
    elseif($type=='permintaan_barang') {
        $type_= 'Permintaan Barang';
        $img = asset('assets/illus6.png');
    }
    elseif($type=='maintenance') {
        $type_= 'Maintenance'; 
        $img = asset('assets/illus8.png');
    }
    elseif($type=='request_personil') {
        $type_= 'Request Personel'; 
        $img = asset('assets/illus7.png');
    }
    else{
        $type_= 'Permintaan Tiket';
        $img = asset('assets/illus2.png');
    }
?>
@component('components.top-content', [
    'title' => $type_,
    'subtitle'=>'Tambahkan tiket untuk memulai permintaan penanganan {{strtolower($type)}}',
    'img'=>$img,
    'type'=>'troubleshooting'
]) 
@endcomponent
<!-- <x-top-content 
    title="{{$type_}}" 
    subtitle="Tambahkan tiket untuk memulai permintaan penanganan {{strtolower($type)}}" 
    img="{{$img}}" 
    type="troubleshooting">
</x-top-content> -->

<!-- Tiket Troubleshooting -->
<div class="card card-round mb-4">
    <div class="card-body">
        <form action="{{ route('form-ticket.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6 mb-2">
                    <label for="exampleInputEmail1" class="form-label">Permintaan <i style="font-size:12px; color:red;" class="material-icons">emergency</i></label>
                    @if($type=="all")
                        <select class="form-select" name="type_ticket" required>
                            <option value="">-- Pilih Tipe Tiket --</option>
                            <option value="0">Troubleshooting</option>
                            <option value="1">Permintaan Barang</option>
                            <option value="2">Maintenance</option>
                            <option value="3">Request Personil</option>
                        </select>
                    @else
                        <select class="form-select" disabled>
                            <option value="" disabled>-- Pilih Tipe Tiket --</option>
                            <option value="0" <?php if($type=="troubleshooting"){ echo "selected"; } else{ echo "disabled"; } ?>>Troubleshooting</option>
                            <option value="1" <?php if($type=="permintaan_barang"){ echo "selected"; } else{ echo "disabled"; } ?>>Permintaan Barang</option>
                            <option value="2" <?php if($type=="maintenance"){ echo "selected"; } else{ echo "disabled"; } ?>>Maintenance</option>
                            <option value="3" <?php if($type=="request_personil"){ echo "selected"; } else{ echo "disabled"; } ?>>Request Personil</option>
                        </select>
                        <input type="hidden" name="type_ticket" value="<?php if($type=="troubleshooting"){echo "0";}else if($type=="permintaan_barang"){echo "1";}else if($type=="permintaan_barang"){echo "2";}else{echo "3";} ?>">
                    @endif
                </div>
                <div class="col-6 mb-2">
                    <label for="exampleInputEmail1" class="form-label">Label <i style="font-size:12px; color:red;" class="material-icons">emergency</i></label>
                    <select class="form-select" name="label" required>
                        <option value="">-- Pilih Label --</option>
                        <option value="0">Tidak Butuh Cepat</option>
                        <option value="1">Biasa</option>
                        <option value="2">Butuh Cepat</option>
                    </select>
                </div>
                <div class="col-6 mb-2">
                    <label for="exampleInputEmail1" class="form-label">Judul <i style="font-size:12px; color:red;" class="material-icons">emergency</i></label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="judul" required/>
                </div>
                <div class="col-6 mb-2">
                    <label for="formFile" class="form-label">Attachment <span style="font-size:12px; color:grey;">optional</span></label>
                    <input class="form-control" type="file" id="formFile" name="foto"/>
                </div>
                <div class="col-12">
                    <label for="exampleFormControlTextarea1" class="form-label" >Deskripsi <i style="font-size:12px; color:red;" class="material-icons">emergency</i></label>
                    <textarea style="resize: none" class="form-control" id="exampleFormControlTextarea1" rows="5" name="deskripsi" required></textarea>
                </div>
            </div>
            <button type="submit" style="float: right" class="btn btn-primary mt-4 w-25">Submit</button>
        </form>
    </div>
</div>