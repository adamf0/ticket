<!-- Tiket Aktif -->
<div class="card card-round mb-4">
    <div class="card-body mx-2">
        <div class="row my-4">
            <div class="col-6 mb-4">
                <x-short-menu-item title="Troubleshooting" img="assets/ic1.png" color="red" link="{{ route('form-ticket.index',['type'=>'troubleshooting']) }}"></x-short-menu-item>
            </div>
            <div class="col-6 mb-4">
                <x-short-menu-item title="Permintaan Barang" img="assets/ic2.png" color="blue" link="{{ route('form-ticket.index',['type'=>'permintaan_barang']) }}"></x-short-menu-item>
            </div>
            <div class="col-6">
                <x-short-menu-item title="Mainteance" img="assets/ic3.png" color="navy" link="{{ route('form-ticket.index',['type'=>'maintenance']) }}"></x-short-menu-item>
            </div>
            <div class="col-6">
                <x-short-menu-item title="Request Personil" img="assets/ic3.png" color="green" link="{{ route('form-ticket.index',['type'=>'request_personil']) }}"></x-short-menu-item>
            </div>
        </div>
        <h4 class="py-4"><strong>Tiket Aktif</strong></h4>
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
                        <th scope="col">Foto</th>
                        <th scope="col">PIC</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets->datas as $index => $ticket)
                        <x-dashboard-item-ticket-active 
                          index='{{ $index+1 }}' 
                          createdat='{{ $ticket->created_at->format("l, j F Y") }}' 
                          noticket='{{ $ticket->no_ticket }}' 
                          label='{{ $ticket->label }}' 
                          judul='{{ $ticket->judul }}' 
                          deskripsi='{{ $ticket->deskripsi }}' 
                          foto='{{ $ticket->foto }}' 
                          userPic='{{ (count($ticket->userPic)==0? "Belum ada PIC":$ticket->userPic[0]->nama_karyawan) }}' 
                          memberPic='<?php echo json_encode($ticket->pic_member->toArray()); ?>'
                          status='{{ $ticket->status }}'>
                        </x-dashboard-item-ticket-active>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>