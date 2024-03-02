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
                            <h4 class="card-title">Thêm mới khách hàng</h4>
                            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Ảnh</label>
                                    <input type="file" class="form-control" id="exampleInputUsername1"
                                        placeholder="Vui lòng tải ảnh lên" name="image" value="{{ old('image') }}"
                                        style="width: 665px;">
                                    @error('image')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Tên người dùng</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                        placeholder="Nhập tên" name="name">
                                </div>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Email</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                        placeholder="Nhập email" name="email">
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Số điện thoại</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                        placeholder="Nhập số điện thoại" name="phone">
                                </div>
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Mật khẩu</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                        placeholder="Nhập mật khẩu" name="password">
                                </div>
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Chức vụ</label>
                                    <select class="form-control" id="exampleInputUsername1" name="group_id">
                                        <option value="">Chọn chức vụ</option>
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('group_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <button type="submit" class="btn btn-secondary me-2">Thêm</button>
                                <a href="{{ route('users.index') }}" class="btn btn-light">Trở về</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
