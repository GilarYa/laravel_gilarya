@extends('layouts.app')

@section('title', 'Data Rumah Sakit')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Rumah Sakit</h1>
    <a href="{{ route('rumah-sakit.create') }}" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Rumah Sakit</span>
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Rumah Sakit</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Rumah Sakit</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rumahSakits as $index => $rs)
                    <tr id="row-{{ $rs->id }}">
                        <td>{{ $rumahSakits->firstItem() + $index }}</td>
                        <td>{{ $rs->nama }}</td>
                        <td>{{ $rs->alamat }}</td>
                        <td>{{ $rs->email ?? '-' }}</td>
                        <td>{{ $rs->telepon ?? '-' }}</td>
                        <td>
                            <a href="{{ route('rumah-sakit.edit', $rs->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $rs->id }}" data-nama="{{ $rs->nama }}">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center">
            {{ $rumahSakits->links() }}
        </div>
    </div>
</div>

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda yakin ingin menghapus data <strong id="deleteItemName"></strong>?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger" type="button" id="confirmDelete">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    var deleteId = null;
    
    // Handle delete button click
    $('.btn-delete').on('click', function() {
        deleteId = $(this).data('id');
        var nama = $(this).data('nama');
        $('#deleteItemName').text(nama);
        $('#deleteModal').modal('show');
    });
    
    // Handle confirm delete
    $('#confirmDelete').on('click', function() {
        if (deleteId) {
            $.ajax({
                url: '/rumah-sakit/' + deleteId,
                type: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        $('#row-' + deleteId).fadeOut(300, function() {
                            $(this).remove();
                        });
                        $('#deleteModal').modal('hide');
                        // Show success alert
                        $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                            response.message +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button></div>')
                            .insertAfter('.d-sm-flex');
                    }
                },
                error: function(xhr) {
                    var message = xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan';
                    alert(message);
                    $('#deleteModal').modal('hide');
                }
            });
        }
    });
});
</script>
@endpush
