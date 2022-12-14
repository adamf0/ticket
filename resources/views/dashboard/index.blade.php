@component('components.top-content', [
    'title' => 'Selamat Datang di Aplikasi Help Desk IT',
    'subtitle'=>'Aplikasi pelayanan untuk mempermudah dalam penanganan troubleshooting, pengadaan barang dan maintenance',
    'img'=>asset('assets/illus1.png'),
    'type'=>'dashboard'
]) 
@endcomponent
<!-- <x-top-content title="Selamat Datang di Aplikasi Help Desk IT" subtitle="Aplikasi pelayanan untuk mempermudah dalam penanganan troubleshooting, pengadaan barang dan maintenance" img="<?php echo asset('assets/illus1.png'); ?>" type="dashboard"></x-top-content> -->

<!-- Tiket Aktif -->
<div class="card card-round mb-4">
    <div class="card-body mx-2">
        <div class="row my-4">
            <div class="col-6 mb-4">
                @component('components.short-menu-item', [
                    'title' => 'Troubleshooting',
                    'img'=>'assets/ic1.png',
                    'link'=>route('form-ticket.index',['type'=>'troubleshooting']),
                    "color"=>"red"
                ]) 
                @endcomponent
                <!-- <x-short-menu-item title="Troubleshooting" img="assets/ic1.png" color="red" link=></x-short-menu-item> -->
            </div>
            <div class="col-6 mb-4">
                @component('components.short-menu-item', [
                    'title' => 'Permintaan Barang',
                    'img'=>'assets/ic2.png',
                    'link'=>route('form-ticket.index',['type'=>'permintaan_barang']),
                    "color"=>"blue"
                ]) 
                @endcomponent
                <!-- <x-short-menu-item title="Permintaan Barang" img="assets/ic2.png" color="blue" link=></x-short-menu-item> -->
            </div>
            <div class="col-6">
                @component('components.short-menu-item', [
                    'title' => 'Maintenance',
                    'img'=>'assets/ic3.png',
                    'link'=>route('form-ticket.index',['type'=>'maintenance']),
                    "color"=>"navy"
                ]) 
                @endcomponent
                <!-- <x-short-menu-item title="Maintenance" img="assets/ic3.png" color="navy" link=></x-short-menu-item> -->
            </div>
            <div class="col-6">
                @component('components.short-menu-item', [
                    'title' => 'Request Personil',
                    'img'=>'assets/ic4.png',
                    'link'=>route('form-ticket.index',['type'=>'request_personil']),
                    "color"=>"green"
                ]) 
                @endcomponent
                <!-- <x-short-menu-item title="Request Personil" img="assets/ic4.png" color="green" link=></x-short-menu-item> -->
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
                        <th scope="col">File</th>
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
                          userPic='{{ (count($ticket->userPic)==0? "Belum ada PIC":$ticket->userPic[0]->nama_singkat) }}' 
                          memberPic='<?php echo json_encode($ticket->pic_member->toArray()); ?>'
                          status='{{ $ticket->status }}'>
                        </x-dashboard-item-ticket-active>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>