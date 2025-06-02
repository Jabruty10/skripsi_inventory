@extends('layouts.app')

@section('title', 'Data Supplier')

@section('content')
<div class="container-fluid px-4">
    <p class="breadcrumb-custom">
        <span class="fs-4"><a>Data Supplier</a></span>
    </p>
    <div class="card mb-4">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                Tambah Supplier
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
                        <th>NAMA SUPPLIER</th>
                        <th>ALAMAT</th>
                        <th>NO TELEPON</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $i => $supplier)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $supplier->namasupplier }}</td>
                        <td>{{ $supplier->alamat }}</td>
                        <td>{{ $supplier->notelp }}</td>
                        <td>
                            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#detail{{ $supplier->idsupplier }}">
                                Detail
                            </button>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit{{ $supplier->idsupplier }}">
                                Edit
                            </button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $supplier->idsupplier }}">
                                Delete
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Detail -->
                    <div class="modal fade" id="detail{{ $supplier->idsupplier }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $supplier->idsupplier }}" aria-labelledby="detailModalLabel{{ $supplier->idsupplier }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $supplier->idsupplier }}">Detail Supplier</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <strong>Nama Supplier:</strong>
                                        <span class="float-end">{{ $supplier->namasupplier }}</span>
                                    </div>
                                    <div class="list-group-item">
                                        <strong>Alamat:</strong>
                                        <span class="float-end">{{ $supplier->alamat }}</span>
                                    </div>
                                    <div class="list-group-item">
                                        <strong>No Telepon:</strong>
                                        <span class="float-end">{{ $supplier->notelp }}</span>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>


                    {{-- Edit Modal --}}
                    <div class="modal fade" id="edit{{ $supplier->idsupplier }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('supplier.update', $supplier->idsupplier) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Supplier</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label>Nama Supplier</label>
                                        <input type="text" name="namasupplier" value="{{ $supplier->namasupplier }}" class="form-control" required>
                                        <br>
                                        <label>Alamat</label>
                                        <input type="text" name="alamat" value="{{ $supplier->alamat }}" class="form-control" required>
                                        <br>
                                        <label>No Telepon</label>
                                        <input type="text" name="notelp" value="{{ $supplier->notelp }}" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Delete Modal --}}
                    <div class="modal fade" id="delete{{ $supplier->idsupplier }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('supplier.destroy', $supplier->idsupplier) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h4 class="modal-title">Hapus Supplier</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus {{ $supplier->namasupplier }}?
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
            <form method="POST" action="{{ route('supplier.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Supplier</h4>
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <label for="namasupplier">Nama Supplier</label>
                    <input type="text" id="namasupplier" name="namasupplier" class="form-control" required>
                    <br>

                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" required>
                    <br>

                    <label for="notelp">No Telpon</label>
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
