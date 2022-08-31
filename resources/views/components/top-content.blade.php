<div class="card card-round p-2 mb-4">
    <div class="card-body">
        <div class="row d-flex my-auto">
            <div class="col-1">
                <button onclick="openNav()" class="btn btn-light"><i class="material-icons">menu</i></button>
            </div>
            <div class="col-2">
                @if($type=='dashboard')
                    <img class="d-none d-md-block m-auto" style="width:100%; object-fit: fit-width;" src="{{$img}}" alt="">
                @elseif($type=='myticket')
                    <img class="d-none d-md-block m-auto" style="width:100%; object-fit: fit-width;" src="{{$img}}" alt="">
                @elseif($type=='troubleshooting')
                    <img class="d-none d-md-block m-auto" style="width:100%; object-fit: fit-width;" src="{{$img}}" alt="">    
                @elseif($type=="pengadaan_barang")
                    <img class="d-none d-md-block" style="width:100%; object-fit: fit-width;" src="<?php echo asset('assets/illus1.png'); ?>" alt="">
                @elseif($type=="maintenance")
                    <img class="d-none d-md-block" style="width:100%; object-fit: fit-width;" src="<?php echo asset('assets/illus1.png'); ?>" alt="">
                @else
                    <img class="d-none d-md-block" style="width:100%; object-fit: fit-width;" src="<?php echo asset('assets/illus1.png'); ?>" alt="">
                @endif
            </div>
            <div class="col-9">
                <h3 class="pt-3"><strong>{{ $title }}</strong></h3>
                <p class="pt-2" style="font-size: 18px; font-weight:bold; color:grey;">
                    {{ $subtitle }}
                </p>
            </div>
        </div>
    </div>
</div>