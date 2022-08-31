<tr>
    <td>{{ $index }}</td>
    <td>{{ $created_at }}</td>
    <td>{{ $no_ticket }}</td>
    <td>
        @if ($label=='0')
            <span class="badge bg-secondary">Tidak Butuh Cepat</span>
        @elseif ($label=='1')
            <span class="badge bg-success">Biasa</span>
        @else
            <span class="badge bg-danger">Butuh Cepat</span>
        @endif
    </td>
    <td>{{ $judul }}</td>
    <td>{{ $deskripsi }}</td>
    <td>
        @if ($foto != null && file_exists(public_path()."/ticket/$foto"))
            <a href="<?php echo asset("/ticket/$foto") ?>" target="_blank">{{ $foto }} </a>
        @elseif ($foto != null && !file_exists(public_path()."/ticket/$foto"))
            {{ $foto }}
        @endif
    </td>
    <td>
        @if( Session::get('level_user')==3)
            @if ($userPic=="Belum ada PIC" && !$ismyticket)
                <button type="button" class="btn btn-primary AddMember" data-url="{{ route('pic-member.create',['id'=>$id]) }}" data-bs-toggle="modal" data-bs-target=".modalPIC">Tambah PIC</button>
            @else
                {{ $userPic }}
                @if($memberPic != '' && count($memberPic)>0)
                    <ul>
                        @foreach ($memberPic as $member)
                            @php $member = (object) $member; @endphp
                            @if(count($member->user)>0)
                                @php $user = (object) $member->user[0]; @endphp
                                <li>
                                    {{ $user->nama_singkat }}
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            @endif
        @else
            {{ $userPic }}
            @if($memberPic != '' && count($memberPic)>0)
            <ul>
                @foreach ($memberPic as $member)
                    @php $member = (object) $member; @endphp
                    @if(count($member->user)>0)
                        @php $user = (object) $member->user[0]; @endphp
                        <li>
                            {{ $user->nama_singkat }}
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
        @endif
    </td>
    <td>
        @if ($status=='0')
            <span class="badge bg-warning">Menunggu Sesi</span>
        @elseif ($status=='1')
            <span class="badge bg-success">Memulai Sesi</span>
        @else
            <span class="badge bg-danger">Menutup Sesi</span> <!-- error -->
        @endif
    </td>
    <td>
        @if(!$disabledetail)
        <a class="btn btn-sm btn-primary" href="{{ route('my-ticket.detail', ['id'=> $id]) }}" >Detail</a>
        @endif
        @if(!$disabletutup)
        <a class="btn btn-sm btn-danger delete_item" href="#" data-url="{{ route('my-ticket.destroy', ['id'=> $id]) }}" data-notiket="{{ $no_ticket }}" data-bs-toggle="modal" data-bs-target=".modalDelete">Tutup</a>
        @endif
    </td>
</tr>