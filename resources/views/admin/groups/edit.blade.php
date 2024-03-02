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
     <script>
        @if (session('successMessage'))
            Swal.fire({
                icon: 'success',
                text: '{{ session('successMessage') }}',
                confirmButtonText: 'Đóng'
            });
        @endif
    </script>
    <script>
        @if (session('errorMessage'))
            Swal.fire({
                icon: 'error',
                text: '{{ session('errorMessage') }}',
                confirmButtonText: 'Đóng'
            });
        @endif
    </script>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card center-form">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Chỉnh sửa chức vụ</h4>
                            <form action="{{ route('groups.update', $userGroup->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Tên chức vụ</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1" name="name"
                                        value="{{ $userGroup->name }}">
                                </div>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-secondary me-2">Cập nhật</button>
                                <a href="{{ route('groups.index') }}" class="btn btn-light">Trở về</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
