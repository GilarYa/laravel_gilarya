@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Pasien</h1>
    <a href="{{ route('pasien.create') }}" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
        </span>
        <span class="text">Tambah Pasien</span>
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

<!-- Filter by Rumah Sakit -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
    </div>
    <div class="card-body">
        <div class="form-group row mb-0">
            <label for="filterRumahSakit" class="col-sm-2 col-form-label">Rumah Sakit:</label>
            <div class="col-sm-4">
                <select class="form-control" id="filterRumahSakit">
                    <option value="">-- Semua Rumah Sakit --</option>
                    @foreach($rumahSakits as $rs)
                        <option value="{{ $rs->id }}" {{ request('rumah_sakit_id') == $rs->id ? 'selected' : '' }}>{{ $rs->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pasien</h6>
    </div>
    <div class="card-body">
        <div id="tableContainer">
            @include('pasien.partials.table', ['pasiens' => $pasiens])
        </div>
        <div class="d-flex justify-content-center" id="paginationContainer">
            {{ $pasiens->appends(request()->query())->links() }}
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
            <div class="modal-body">Apakah Anda yakin ingin menghapus data pasien <strong id="deleteItemName"></strong>?</div>
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
    
    // Handle filter change with AJAX
    $('#filterRumahSakit').on('change', function() {
        var rumahSakitId = $(this).val();
        
        $.ajax({
            url: '{{ route("pasien.index") }}',
            type: 'GET',
            data: { rumah_sakit_id: rumahSakitId },
            success: function(response) {
                $('#tableContainer').html(response.html);
                $('#paginationContainer').html(response.pagination);
                // Re-bind delete buttons
                bindDeleteButtons();
            },
            error: function(xhr) {
                console.error('Error filtering data');
            }
        });
    });
    
    // Bind delete buttons function
    function bindDeleteButtons() {
        $('.btn-delete').off('click').on('click', function() {
            deleteId = $(this).data('id');
            var nama = $(this).data('nama');
            $('#deleteItemName').text(nama);
            $('#deleteModal').modal('show');
        });
    }
    
    // Initial bind
    bindDeleteButtons();
    
    // Handle confirm delete
    $('#confirmDelete').on('click', function() {
        if (deleteId) {
            $.ajax({
                url: '/pasien/' + deleteId,
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
