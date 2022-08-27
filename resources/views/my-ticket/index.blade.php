<!-- My Tiket -->
<div class="card card-round p-2 mb-4">
                <div class="card-body">
                    <div class="row justify-content-center py-4">
                        <div class="col-6">
                            <h4><strong>My Tiket</strong></h4>
                        </div>
                        <div class="col-6">
                            <a href="
                            @if ($tickets->total_waiting<=3)
                                {{ route('form-ticket.index',['type'=>'troubleshooting']) }}
                            @else
                                #
                            @endif
                            " class="btn btn-primary" style="float: right;">Tambah Tiket</a>
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
                                    <th scope="col">Foto</th>
                                    <th scope="col">PIC</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tickets->aktif as $index => $ticket)
                                    <?php
                                        $no_ticket = $ticket->no_ticket;
                                        $created_at = $ticket->created_at->format("l, j F Y");
                                    ?>
                                  <x-my-ticket-item-ticket index='{{ $index+1 }}' id='{{ $ticket->id }}' created_at='{{ $created_at }}' no_ticket='{{ $no_ticket }}' label='{{ $ticket->label }}' judul='{{ $ticket->judul }}' deskripsi='{{ $ticket->deskripsi }}' foto='{{ $ticket->foto }}' userPic='{{ (count($ticket->userPic)==0? "Belum ada PIC":$ticket->userPic[0]->nama_karyawan) }}' status='{{ $ticket->status }}'></x-dashboard-item-ticket-active>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>