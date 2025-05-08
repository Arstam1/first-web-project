@extends('dashboard.layouts.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Member Manager</h1>
</div>

<div class="table-responsive small col-md-20">
    @if ($members)
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No. KTP</th>
          <th scope="col">Nama</th>
          <th scope="col">Email</th>
          {{-- <th scope="col">Gender</th>
          <th scope="col">Date</th>
          <th scope="col">Tempat Lahir</th>
          <th scope="col">Tanggal Lahir</th>
          <th scope="col">Alamat</th>
          <th scope="col">No. RT</th>
          <th scope="col">No. RW</th>
          <th scope="col">Kelurahan</th>
          <th scope="col">Kecamatan</th>
          <th scope="col">Kota</th>
          <th scope="col">Provinsi</th>
          <th scope="col">No. Telpon</th>
          <th scope="col">Pendidikan Terakhir</th>
          <th scope="col">Pekerjaan</th>
          <th scope="col">Nama Keluarga</th>
          <th scope="col">Alamat Keluarga</th>
          <th scope="col">Kontak Darurat</th> --}}
          {{-- <th scope="col">No. Passport</th>
          <th scope="col">D. Issue</th>
          <th scope="col">D. Expiry</th>
          <th scope="col">Issuing Office</th> --}}
  
        </tr>
      <tbody>
        @foreach ($members as $member)
        <tr>
          @if ($member->ktp)
          <td scope="col"><a href="/dashboard/member/{{ $member->user->email }}">{{ $member->ktp }}</td></a>
          @else
          <td scope="col"><a href="/dashboard/member/{{ $member->user->email }}">null</td></a>
          @endif
          <td>{{ $member->user->name }}</td>
          <td>{{ $member->user->email }}</td>
          {{-- <td>{{ substr($member->jenis_kelamin, 0, 1) }}</td>
          <td>{{ $member->tempat_lahir}}</td>
          <td>{{ date('j F Y', strtotime($member->tgl_lahir)) }}</td>
          <td>{{ $member->alamat}}</td>
          <td>{{ $member->RT}}</td>
          <td>{{ $member->RW}}</td>
          <td>{{ $member->kelurahan}}</td>
          <td>{{ $member->kecamatan}}</td>
          <td>{{ $member->kota}}</td>
          <td>{{ $member->proponsi}}</td>
          <td>{{ $member->hp}}</td>
          <td>{{ $member->last_edu}}</td>
          <td>{{ $member->pekerjaan}}</td>
          <td>{{ $member->nama_darurat}}</td>
          <td>{{ $member->alamat_darurat}}</td>
          <td>{{ $member->kontak_darurat}}</td> --}}
          {{-- <td><a href="/dashboard/pakets/{{ $paket->slug }}" class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
            <a href="/dashboard/pakets/{{ $paket->slug }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>
            <form action="/dashboard/pakets/{{ $paket->slug }}" method="post" class="d-inline">  
            @method('delete')
            @csrf
            <button class="btn btn-danger border-0" onclick="return confirm('Hapus paket?')"><i class="bi bi-trash-fill"></i></button>                    
            </form></td> --}}
          {{-- <p>edited by {{ $member->edited_by}}</p> --}}
        </tr>
        @endforeach
      </tbody>
    </table>    
    @else
    belum ada member
    @endif
  </div>


@endsection