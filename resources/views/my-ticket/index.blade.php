<style>
    .select2-container{
        width: 100% !important;
    }
</style>

@component('components.top-content', [
    'title' => 'MyTiket',
    'subtitle'=>'Seluruh tiket anda ada di list bawah, tambahkan tiket untuk memulai permintaan penanganan troubleshooting, pengadaan barang dan maintenance',
    'img'=>asset('assets/illus3.png'),
    'type'=>'myticket'
]) 
@endcomponent

<!-- <x-top-content 
title="" 
subtitle="" 
img="<?php echo asset('assets/illus3.png'); ?>" 
type="myticket">
</x-top-content> -->

<!-- My Tiket -->
<div class="card card-round p-2 mb-4">
                <div class="card-body">
                    <h5><strong>My Tiket</strong></h5>
                    <hr>
                    <div class="d-flex my-4 justify-content-end">
                            <a href="
                            @if ($tickets->total_waiting <= 3)
                                {{ route('form-ticket.index',['type'=>'all']) }}
                            @else
                                #
                            @endif
                            " class="btn btn-primary">Tambah Tiket</a>
                    </div>                  
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="brd text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nomor Tiket</th>
                                    <th scope="col">label</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">File</th>
                                    <th scope="col">PIC</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets->pribadi as $index => $ticket)
                                @php
                                    $disabletutup = ($ticket->status==2? true:false);
                                @endphp
                                    @component('components.my-ticket-item-ticket', [
                                        'index' => $index+1,
                                        'id'=>$ticket->id,
                                        'created_at'=>$ticket->created_at->format("l, j F Y"),
                                        'no_ticket'=>$ticket->no_ticket,
                                        'label'=>$ticket->label,
                                        'judul'=>$ticket->judul,
                                        'deskripsi'=>$ticket->deskripsi,
                                        'foto'=>$ticket->foto,
                                        'userPic'=>(count($ticket->userPic)==0? "Belum ada PIC":$ticket->userPic[0]->nama_singkat),
                                        'memberPic'=>$ticket->pic_member->toArray(),
                                        'status'=>$ticket->status,
                                        'disabledetail'=>false,
                                        'disabletutup'=>$disabletutup,
                                        'ismyticket'=>true
                                    ])  
                                    @endcomponent
                                    <!-- <x-my-ticket-item-ticket 
                                        index='{{ $index+1 }}' 
                                        id='{{ $ticket->id }}' 
                                        createdat='{{ $ticket->created_at->format("l, j F Y") }}' 
                                        noticket='{{ $ticket->no_ticket }}' 
                                        label='{{ $ticket->label }}' 
                                        judul='{{ $ticket->judul }}' 
                                        deskripsi='{{ $ticket->deskripsi }}' 
                                        foto='{{ $ticket->foto }}' 
                                        userPic='{{ (count($ticket->userPic)==0? "Belum ada PIC":$ticket->userPic[0]->nama_singkat) }}' 
                                        memberPic='<?php //echo json_encode($ticket->pic_member->toArray()); ?>'
                                        status='{{ $ticket->status }}' 
                                        disabletutup='{{ $disabletutup }}'
                                        ismyticket=true>
                                    </x-my-ticket-item-ticket> -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

@if( Session::get('level_user')==2 || Session::get('level_user')==3 ) 
<!-- My Task-->
<div class="card card-round p-2 mb-4">
    <div class="card-body">
        <div class="row justify-content-center py-4">
            <div class="col-12">
                <h4><strong>My Task</strong></h4>
            </div>
        </div>                    
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="brd text-center">
                        <th scope="col">No</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nomor Tiket</th>
                        <th scope="col">label</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">File</th>
                        <th scope="col">PIC</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets->tugas as $index => $ticket)
                        @php
                            $disabledetail = false;
                            $disabletutup  = ( 
                                                Session::get('level_user')==2 || 
                                                count($ticket->userPic)==0 || 
                                                (
                                                    count($ticket->userPic)>0 && 
                                                    Session::get('id_user')!=$ticket->id_user_pic
                                                ) ||
                                                $ticket->status==2
                                            ) ? true:false;
                        @endphp
                            @component('components.my-ticket-item-ticket', [
                                'index' => $index+1,
                                'id'=>$ticket->id,
                                'created_at'=>$ticket->created_at->format("l, j F Y"),
                                'no_ticket'=>$ticket->no_ticket,
                                'label'=>$ticket->label,
                                'judul'=>$ticket->judul,
                                'deskripsi'=>$ticket->deskripsi,
                                'foto'=>$ticket->foto,
                                'userPic'=>(count($ticket->userPic)==0? "Belum ada PIC":$ticket->userPic[0]->nama_singkat),
                                'memberPic'=>$ticket->pic_member->toArray(),
                                'status'=>$ticket->status,
                                'disabledetail'=>$disabledetail,
                                'disabletutup'=>$disabletutup,
                                'ismyticket'=>$disabletutup
                            ])  
                            @endcomponent
                            <!-- <x-my-ticket-item-ticket 
                                index='{{ $index+1 }}' 
                                id='{{ $ticket->id }}' 
                                createdat='{{ $ticket->created_at->format("l, j F Y") }}' 
                                noticket='{{ $ticket->no_ticket }}' 
                                label='{{ $ticket->label }}' 
                                judul='{{ $ticket->judul }}' 
                                deskripsi='{{ $ticket->deskripsi }}' 
                                foto='{{ $ticket->foto }}' 
                                userPic='{{ (count($ticket->userPic)==0? "Belum ada PIC":$ticket->userPic[0]->nama_singkat) }}' 
                                memberPic='<?php //echo json_encode($ticket->pic_member->toArray()); ?>'
                                status='{{ $ticket->status }}' 
                                disabledetail='{{ $disabledetail }}'
                                disabletutup='{{ $disabletutup }}'>
                            </x-my-ticket-item-ticket> -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

<!-- Modal -->
<div class="modal fade modalPIC">
    <div class="modal-dialog">
        <form action="" method="post" id="FormPicMember">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah PIC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <label>PIC</label>
                            <select name="pic" class="form-control MainPIC" required>
                                <option value="">-- Pilih PIC --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->nik }}">{{ $user->nama_karyawan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label>PIC Member</label>
                            <select name="pic_member[]" class="form-control MemberPIC" multiple>
                                <option value="">-- Pilih PIC Member --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->nik }}">{{ $user->nama_karyawan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade modalDelete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <p>Apakah anda yakin ingin menghapus tiket <span id="nomor_tiket"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" id="btn_delete" data-bs-dismiss="modal" href="#">Ya</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>

<script>
window.onload = function() {
    var modal = bootstrap.Modal.getInstance($('.modalPIC'));
    var modalDelete = bootstrap.Modal.getInstance($('.modalDelete'));

    $('.MainPIC').select2({
        dropdownParent: $('.modalPIC')
    });
    $('.MemberPIC').select2({
        dropdownParent: $('.modalPIC')
    });
    $('.AddMember').on('click', function (e) {
        var url = $(this).attr('data-url');
        $("#FormPicMember").attr("action", url);
        console.log(url)                    
    });
    $('.delete_item').on('click', function (e) {
        var url = $(this).attr('data-url');
        var nomor_tiket = $(this).attr('data-notiket');
        $("#nomor_tiket").text(nomor_tiket);
        $("#btn_delete").attr('href',url);
        console.log(url)
        console.log(nomor_tiket)                    
    });
    $('#btn_delete').on('click', function (e) {
        var url = $('#btn_delete').attr('href');
        console.log(url)          
        window.location = url;          
    });
}
</script>