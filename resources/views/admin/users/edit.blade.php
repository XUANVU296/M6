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
                            <h4 class="card-title">Chỉnh sửa thông tin khách hàng</h4>
                            <form action="{{ route('users.update', $item->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label class="form-label">Ảnh</label>
                                    <input type="file" name="image" class="form-control" style="width: 665px;"><br>
                                    @if ($item->image)
                                    <img src="{{ asset($item->image) }}" alt="Ảnh cũ" style="width:10%; height:50%;">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Tên người dùng</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1" name="name"
                                        value="{{ $item->name }}">
                                </div>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                        value="{{ $item->email }}">
                                </div>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPhone1">Số điện thoại</label>
                                    <input type="text" class="form-control" id="exampleInputPhone1" name="phone"
                                        value="{{ $item->phone }}">
                                </div>
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPhone1">Chức vụ</label>
                                    <select class="form-control" id="exampleInputUsername1" name="group_id">
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}" {{ $group->id == $item->group_id ? 'selected' : '' }}>{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-secondary me-2">Cập nhật</button>
                                <a href="{{ route('users.index') }}" class="btn btn-light">Trở về</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
