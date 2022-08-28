    <!-- Detail -->
    <div class="card card-round mb-4">
        <div class="card-body mx-2 mb-4">
            <h4 class="py-4"><strong>Detail</strong></h4>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <img 
                                class="img-round" 
                                src='@if (file_exists(public_path()."/ticket/$ticket->foto")) {{ asset("ticket/$ticket->foto"); }} @else {{ asset("dummyimg.png"); }} @endif' 
                                alt=""
                                style="width: 100%; height: 100%">
                        </div>
                        <div class="col-2">
                            <p class="title">Tiket :</p>
                            <p class="title">Tanggal :</p>
                            <p class="title">Judul :</p>
                            <p class="title">Deskripsi :</p>
                            <p class="title">Status :</p>
                            <p class="title">Label :</p>
                            <p class="title">PIC :</p>
                        </div>
                        <div class="col-6">
                            <p class="isi">
                                <b>{{ $ticket->no_ticket }}</b>
                                @if ($ticket->type_ticket==0)
                                    (Troubleshooting)
                                @elseif ($ticket->type_ticket==1)
                                    (Permintaan Barang)
                                @elseif ($ticket->type_ticket==2)
                                    (Maintenance)
                                @else
                                    (Request Personil)
                                @endif
                            </p>
                            <p class="isi">{{ \Carbon\Carbon::parse($ticket->created_at)->format("l, j F Y") }}</p>
                            <p class="isi">{{ $ticket->judul }}</p>
                            <p class="isi">{{ $ticket->deskripsi }}</p>
                            <p class="isi">
                                @if ($ticket->status==0)
                                    <span class="badge bg-warning">Menunggu Sesi</span>
                                @elseif ($ticket->status==1)
                                    <span class="badge bg-success">Memulai Sesi</span>
                                @else
                                    <span class="badge bg-danger">Menutup Sesi</span>
                                @endif
                            </p>
                            <p class="isi">
                                @if ($ticket->label==0)
                                    <span class="badge bg-secondary">Tidak Butuh Cepat</span>
                                @elseif ($ticket->label==1)
                                    <span class="badge bg-success">Biasa</span>
                                @else
                                    <span class="badge bg-danger">Butuh Secepatnya</span>
                                @endif
                            </p>
                            <p class="isi">
                                @if (count($ticket->userPic)==0)
                                    Belum ditunjuk oleh admin
                                @else
                                    {{ $ticket->userPic[0]->nama_karyawan }}
                                @endif

                                @if (count($ticket->pic_member)>0)
                                    <ul>
                                        @foreach ($ticket->pic_member as $member)
                                            @if (count($member->user)>0)
                                                <li>{{ $member->user[0]->nama_karyawan }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
                    
        </div>
    </div>

    @if (Session::get('level_user')=='3' || Session::get('level_user')=='2')
    <!-- Perkembangan Tugas -->
    <div class="card card-round mb-4">
        <div class="card-body mx-2 mb-4">
            <h4 class="py-4"><strong>Perkembangan Tugas</strong></h4>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('progress.create',['id'=>$ticket->id]) }}" method="post">
                        @csrf
                        <label for="" class="form-label">Perkembangan Terakhir</label>
                        <input type="text" name="progress" class="form-control" id="" aria-describedby="perkembanganHelp">
                        <div id="perkembanganHelp" class="form-text">Keterangan perkembangan tiket.</div>
                        <button type="submit" style="float: right;" class="btn btn-primary mt-2 w-25">Submit</button>
                    </form>
                </div>
            </div>    
        </div>
    </div>
    @endif

    <!-- Pelacakan -->
    <div class="card card-round mb-4">
        <div class="card-body mx-2 mb-4">
            <h4 class="py-4"><strong>Pelacakan</strong></h4>
            <div class="card">
                <div class="card-body pb-0">
                    @if (count($ticket->progress)==0)
                        <span>Upss belum diproses oleh PIC</span>
                    @else
                        @foreach ($ticket->progress as $index => $progress)
                            <p class="isi">{{ $index+1 }}. {{ $progress->deskripsi }}</p>
                        @endforeach
                    @endif
                </div>
            </div>    
        </div>
    </div>

    <!-- Pesan -->
    <div class="card card-round mb-4">
        <div class="card-body mx-2 mb-4">
            <h4 class="py-4"><strong>Pesan</strong></h4>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('chat.create',['id'=>$ticket->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="" class="form-label">Pesan</label>
                                <input type="text" name="pesan" class="form-control" id="" aria-describedby="" required @if(
                                    $ticket->status==0 || 
                                    count($ticket->userPic) == 0 || 
                                    $ticket->status==2
                                ) {{ "disabled" }} @endif>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="formFile" class="form-label">Attachment</label>
                                <input type="file" name="foto" class="form-control" id="formFile" @if(
                                    $ticket->status==0 || 
                                    count($ticket->userPic) == 0 || 
                                    $ticket->status==2
                                ) {{ "disabled" }} @endif>
                            </div>
                        </div>
                        <button type="submit" style="float: right;" class="btn btn-primary mt-2 w-25" @if(
                            $ticket->status==0 || 
                            count($ticket->userPic) == 0 || 
                            $ticket->status==2
                        ) {{ "disabled" }} @endif>Submit</button>
                    </form>
                </div>
            </div>    
        </div>
    </div>

    <!-- Percakapan -->
    <div class="card card-round mb-4">
        <div class="card-body mx-2 mb-4">
            <h4 class="py-4"><strong>Percakapan</strong></h4>
            <div class="card">
                <div class="card-body">
                    @if (count($chats)==0)
                        Upss belum ada percakapan dengan PIC
                    @else
                        @foreach ($chats as $chat)
                                @if (count($chat->from_user)==0)
                                    <div class="pesanmasuk">
                                        <p class="title-pesan">
                                            <i class="material-icons">account_circle</i>
                                            &nbsp;&nbsp;
                                            N/A
                                        </p>
                                @elseif ($chat->from_user[0]->nik==Session::get('id_user'))
                                    <div class="pesanmasuk">
                                        <p class="title-pesan">
                                            <i class="material-icons">account_circle</i>
                                            &nbsp;&nbsp;
                                            {{ $chat->from_user[0]->nama_karyawan }}
                                        </p>
                                @else
                                    <div class="pesansaya">
                                        <p class="title-pesan">
                                            {{ $chat->from_user[0]->nama_karyawan }}
                                            &nbsp;&nbsp;
                                            <i class="material-icons">
                                            account_circle</i>
                                        </p>
                                @endif
                                        <p class="isi-pesan">{{ $chat->deskripsi }}</p>
                                        <p class="waktu-pesan">{{ \Carbon\Carbon::parse($chat->created_at)->format("j F Y H:i") }}</p>
                                    </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>