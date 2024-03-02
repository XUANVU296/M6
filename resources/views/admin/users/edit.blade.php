@extends('admin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Chỉnh sửa</h4>
                        <form action="{{route('user.update' , $user->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Ảnh</label>
                                <input type="file" name="image" class="form-control" style="width: 340%;"><br>
                                @if ($user->image)
                                <img src="{{ asset($user->image) }}" alt="Ảnh cũ" style="width:10%; height:50%;">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Tên</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nhập tên" name="name" value="{{ $user->name }}" style="width: 1000px;">
                                @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email</label>
                                <input type="email" class="form-control" id="exampleInputUsername1" placeholder="Nhập email" name="email" value="{{ $user->email }}" style="width: 1000px;">
                                @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Password</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nhập password" name="password" value="{{ $user->password }}" style="width: 1000px;">
                                @error('password') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            </div>
                            <div class="form-group col-lg-4">
                                <label class="control-label" for="flatpickr01">Chức Vụ<abbr name="Trường bắt buộc">*</abbr></label>
                                <select name="group_id" id="" class="form-control">
                                    <option value="">--Vui lòng chọn--</option>
                                    @foreach ($groups as $group)
                                    <option <?= $group->id == $user->group_id ? 'selected' : '' ?> value="{{ $group->id }}">
                                        {{ $group->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ('group_id')
                                <p style="color:red">{{ $errors->first('group_id') }}</p>
                                @endif
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="control-label" for="flatpickr01">Giới Tính<abbr name="Trường bắt buộc">*</abbr></label>
                                <select name="gender" id="" value="{{ $user->gender }}" class="form-control">
                                    <option value="{{ $user->gender }}">{{ $user->gender }}</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                </select>
                                @if ('gender')
                                <p style="color:red">{{ $errors->first('gender') }}</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-secondary me-2">Cập nhật</button>
                            <a href="{{route('user.index')}}" class="btn btn-light">Trở về</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

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

   
@endsection
