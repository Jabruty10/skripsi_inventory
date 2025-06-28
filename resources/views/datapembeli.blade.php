@extends('layouts.app') 

@section('title', 'Data Pembeli')

@section('content')

<div class="container-fluid px-4">
    <p class="breadcrumb-custom">
        <span class="fs-4 fw-bold">Data Pembeli</span>
    </p>
    <div class="card mb-4">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                Tambah Pembeli
            </button>
        </div>
        <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif

            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA PEMBELI</th>
                        <th>ALAMAT</th>
                        <th>NO TELEPON</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembelis as $i => $pembeli)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $pembeli->namapembeli }}</td>
                        <td>{{ $pembeli->alamat }}</td>
                        <td>{{ $pembeli->notelp }}</td>
                        <td>
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detail{{ $pembeli->idpembeli }}">
                                Detail
                            </button>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit{{ $pembeli->idpembeli }}">
                                Edit
                            </button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $pembeli->idpembeli }}">
                                Hapus
                            </button>
                        </td>
                    </tr>

                     <!-- Modal Detail -->
                     <div class="modal fade" id="detail{{ $pembeli->idpembeli }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $pembeli->idpembeli }}" aria-labelledby="detailModalLabel{{ $pembeli->idpembeli }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $pembeli->idpembeli }}">Detail Pembeli</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <strong>Nama Pembeli:</strong>
                                        <span class="float-end">{{ $pembeli->namapembeli }}</span>
                                    </div>
                                    <div class="list-group-item">
                                        <strong>Alamat:</strong>
                                        <span class="float-end">{{ $pembeli->alamat }}</span>
                                    </div>
                                    <div class="list-group-item">
                                        <strong>No Telepon:</strong>
                                        <span class="float-end">{{ $pembeli->notelp }}</span>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    {{-- Edit Modal --}}
                    <div class="modal fade" id="edit{{ $pembeli->idpembeli }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('pembeli.update', $pembeli->idpembeli) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Pembeli</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label>Nama Pembeli</label>
                                        <input type="text" name="namapembeli" value="{{ $pembeli->namapembeli }}" class="form-control" required>
                                        <br>
                                        <label>Alamat</label>
                                        <input type="text" name="alamat" value="{{ $pembeli->alamat }}" class="form-control" required>
                                        <br>
                                        <label>No Telepon</label>
                                        <input type="text" name="notelp" value="{{ $pembeli->notelp }}" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Delete Modal --}}
                    <div class="modal fade" id="delete{{ $pembeli->idpembeli }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('pembeli.destroy', $pembeli->idpembeli) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Pembeli</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus <strong>{{ $pembeli->namapembeli }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Supplier -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('pembeli.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pembeli</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label for="namasupplier">Nama Pembeli</label>
                    <input type="text" id="namapembeli" name="namapembeli" class="form-control" required>
                    <br>

                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" required>
                    <br>

                    <label for="notelp">No Telepon</label>
                    <input type="text" id="notelp" name="notelp" class="form-control" required>
                    <br>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
