    @component('components.top-content', [
        'title' => 'Selamat Datang di Aplikasi Help Desk IT',
        'subtitle'=>'Aplikasi pelayanan untuk mempermudah dalam penanganan troubleshooting, pengadaan barang dan maintenance',
        'img'=>asset('assets/illus1.png'),
        'type'=>'dashboard'
    ]) 
    @endcomponent
    <!-- <x-top-content title="Selamat Datang di Aplikasi Help Desk IT" subtitle="Aplikasi pelayanan untuk mempermudah dalam penanganan troubleshooting, pengadaan barang dan maintenance" img="<?php echo asset('assets/illus1.png'); ?>" type="dashboard"></x-top-content> -->
    <!-- Detail -->
    <div class="card card-round mb-4">
        <div class="card-body mx-2 mb-4">
            <h4 class="py-4"><strong>Detail</strong></h4>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            @if ($ticket->foto != null && file_exists(public_path()."/ticket/$ticket->foto"))
                                <a href="<?php echo asset("/ticket/$ticket->foto") ?>" target="_blank">
                            @endif
                                    <img 
                                        class="img-round" 
                                        src='@if($ticket->foto!="" && file_exists(public_path()."/ticket/$ticket->foto")) {{ asset("ticket/$ticket->foto") }} @else {{ asset("assets/no-image.jpg") }} @endif' 
                                        alt=""
                                        style="width: 100%; height: 100%">
                            @if ($ticket->foto != null && file_exists(public_path()."/ticket/$ticket->foto"))
                                </a>
                            @endif
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
                                    {{ $ticket->userPic[0]->nama_singkat }}
                                @endif

                                @if (count($ticket->pic_member)>0)
                                    <ul>
                                        @foreach ($ticket->pic_member as $member)
                                            @if (count($member->user)>0)
                                                <li>{{ $member->user[0]->nama_singkat }}</li>
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

    @if ( 
            ( 
                Session::get('level_user')!='1' && 
                (count($ticket->userPic)>0 && Session::get('id_user')==$ticket->id_user_pic) 
            ) ||
            $ticket->is_member==true
        )
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
                <div class="card-body">
                    @if (count($ticket->progress)==0)
                        <!-- <span>Upss belum diproses oleh PIC</span> -->
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

    <!-- Percakapan --> <!-- pic_member error -->
    <div class="card card-round mb-4">
        <div class="card-body mx-2 mb-4">
            <h4 class="py-4"><strong>Percakapan</strong></h4>
            <div class="card">
                <div class="card-body">
                    @if (count($chats)==0)
                        <!-- Upss belum ada percakapan dengan PIC -->
                    @else
                        @foreach ($chats as $chat)
                            @if (count($chat->from_user_)==0 && $ticket->id_user==$chat->from_user)
                                <div class="pesanmasuk">
                                    <p class="title-pesan">
                                        <i class="material-icons">account_circle</i>
                                        &nbsp;&nbsp;
                                        N/A
                                    </p>
                                @elseif (count($chat->from_user_)>0 && $ticket->id_user==$chat->from_user)
                                    <div class="pesanmasuk">
                                        <p class="title-pesan">
                                            <i class="material-icons">account_circle</i>
                                            &nbsp;&nbsp;
                                            {{ $chat->from_user_[0]->nama_singkat }}
                                        </p>
                                @else
                                    <div class="pesansaya">
                                        <p class="title-pesan">
                                            {{ $chat->from_user_[0]->nama_singkat }}
                                            &nbsp;&nbsp;
                                            <i class="material-icons">
                                            account_circle</i>
                                        </p>
                                @endif
                                        <p class="isi-pesan">
                                            {{ $chat->deskripsi }}
                                            <br/>
                                            @if ($chat->foto != null && file_exists(public_path()."/ticket/$chat->foto"))
                                                <a href="<?php echo asset("/ticket/$chat->foto") ?>" target="_blank">{{ $chat->foto }} </a>
                                            @elseif ($chat->foto != null && !file_exists(public_path()."/ticket/$chat->foto"))
                                                {{ $chat->foto }}
                                            @endif
                                        </p>
                                        <p class="waktu-pesan">{{ \Carbon\Carbon::parse($chat->created_at)->format("j F Y H:i") }}</p>
                                    </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>