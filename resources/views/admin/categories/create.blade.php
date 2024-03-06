@extends('admin')

@section('content')
<style>
    .center-form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
<div class="main-panel">
    <div class="content-wrapper d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card center-form">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thêm mới</h4>
                        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Tên</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nhập tên" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-secondary me-2">Thêm</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-light">Trở về</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
