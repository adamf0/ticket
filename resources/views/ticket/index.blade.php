<div class="row">
    <div class="col-12 bg-light p-5 rounded">
        <div class="row">
            <div class="col-10">
                <h1>Tiket</h1>
            </div>
            <div class="col-2">
                @if (Session::has('level_user') && Session::get('level_user')=="1" )
                    <a class="btn btn-lg btn-primary pull-right" href="{{ route('ticket.add') }}" role="button">Tambah Tiket</a>
                @endif
            </div>
            @if( Session::has('type_modal') && Session::has('message') )
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                    <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header <?php echo (Session::get('type_modal')=="success" ? "bg-success":"bg-danger")?>">
                            <strong class="me-auto text-white">Notifikasi</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            {{ Session::get('message') }}
                        </div>
                    </div>
                </div>
                @php
                    Session::forget('type_modal');
                    Session::forget('message');
                @endphp
            @endif
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Tanggal</td>
                            <td>Nomor Tiket</td>
                            <td>Judul</td>
                            <td>Deskripsi</td>
                            <td>Foto</td>
                            <td>PIC</td>
                            <td>Status</td>
                            @if ( Session::has('level_user') && (Session::get('level_user')=="1" || Session::get('level_user')=="2")  )
                                <td>Aksi</td>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $index => $ticket)
                        <tr>
                            <td><?php echo $index+1; ?></td>
                            <td><?php echo \Carbon\Carbon::parse($ticket->createdAt)->format("l, j F Y"); ?></td>
                            <td>
                                <?php echo $ticket->no_ticket; ?>
                                <br>
                                <?php
                                    if($ticket->type_ticket == 0){
                                ?>
                                    <span class="badge bg-warning">Troubleshooting</span>
                                <?php
                                    }
                                    else if($ticket->type_ticket == 1){
                                ?>
                                    <span class="badge bg-success">Pengadaan Barang</span>
                                <?php
                                    }
                                    else{
                                ?>
                                    <span class="badge bg-danger">Maintenance</span>
                                <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo $ticket->judul; ?></td>
                            <td><?php echo $ticket->deskripsi; ?></td>
                            <td><?php echo $ticket->foto; ?></td>
                            <td>
                                @if ( Session::has('level_user') && Session::get('level_user')=="1" )
                                    <?php echo ($ticket->pic==null? "Belum ada PIC":$ticket->pic->nama); ?>
                                @elseif (Session::has('level_user') && Session::get('level_user')=="2")
                                    @if ($ticket->pic==null)
                                        <a href="#" class="btn btn-primary">Tambah PIC</a>
                                    @else
                                        {{ $ticket->pic->nama }}
                                    @endif
                                @endif
                            </td>
                            <td>
                                <?php
                                    if($ticket->status == 0){
                                ?>
                                    <span class="badge bg-warning">Menunggu Sesi</span>
                                <?php
                                    }
                                    else if($ticket->status == 1){
                                ?>
                                    <span class="badge bg-success">Memulai Sesi</span>
                                <?php
                                    }
                                    else{
                                ?>
                                    <span class="badge bg-danger">Menutup Sesi</span>
                                <?php
                                    }
                                ?>
                            </td>
                            @if ( Session::has('level_user') && Session::get('level_user')=="1" )
                                <td>
                                    <a href="{{ route('ticket.detail', ['id'=> $ticket->id]) }}" class="btn btn-primary">detail</a>
                                    @if ($ticket->status != 2)
                                        <a href="{{ route('ticket.destroy', ['id'=> $ticket->id]) }}" class="btn btn-secondary">tutup tiket</a>        
                                    @endif
                                </td>
                            @endif
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>