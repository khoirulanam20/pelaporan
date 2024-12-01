@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">  
            <div class="container">
                <h2>Tambah No RM</h2>
                <form action="{{ route('no_rm.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="no_rm">No RM</label>
                        <input type="text" name="no_rm" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" name="keterangan" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
