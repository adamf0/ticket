<!-- Tiket Aktif -->
<div class="card card-round mb-4">
                <div class="card-body mx-2">

                    <div class="row my-4">
                        <div class="col-6 mb-4">
                          <x-short-menu-item title="Troubleshooting" img="assets/ic1.png" color="red"></x-short-menu-item>
                        </div>
                        <div class="col-6 mb-4">
                          <x-short-menu-item title="Pengadaan Barang" img="assets/ic2.png" color="blue"></x-short-menu-item>
                        </div>
                        <div class="col-6">
                          <x-short-menu-item title="Mainteance" img="assets/ic3.png" color="navy"></x-short-menu-item>
                        </div>
                        <div class="col-6">
                          <x-short-menu-item title="Request Personil" img="assets/ic3.png" color="navy"></x-short-menu-item>
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
                                  <x-dashboard-item-ticket-active index='{{ $index+1 }}' created_at="{{ $ticket->created_at }}" no_ticket='{{ $ticket->no_ticket }}' label='{{ $ticket->label }}' judul='{{ $ticket->judul }}' deskripsi='{{ $ticket->deskripsi }}' foto='{{ $ticket->foto }}' userPic='{{ (count($ticket->userPic)==0? "Belum ada PIC":$ticket->userPic[0]->nama_karyawan) }}' status='{{ $ticket->status }}'></x-dashboard-item-ticket-active>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>