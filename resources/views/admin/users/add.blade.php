@extends('admin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thêm mới tài khoản nhân sự</h4>
                        <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Ảnh</label>
                                <input type="file" class="form-control" id="exampleInputUsername1" placeholder="Nhập tên" name="image" value="{{ old('image') }}" style="width: 1000px;">
                                @error('image') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Tên</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nhập tên" name="name" value="{{ old('name') }}" style="width: 1000px;">
                                @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Email</label>
                                <input type="email" class="form-control" id="exampleInputUsername1" placeholder="Nhập email" name="email" value="{{ old('email') }}" style="width: 1000px;">
                                @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Password</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nhập password" name="password" value="{{ old('password') }}" style="width: 1000px;">
                                @error('password') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">STT</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nhập sđt" name="phone" value="{{ old('phone') }}" style="width: 1000px;">
                                @error('phone') <div class="alert alert-danger">{{ $message }}</div> @enderror

                            </div>
                            <div class="form-group col-lg-4">
                                <label class="control-label" for="flatpickr01">Chức Vụ<abbr name="Trường bắt buộc">*</abbr></label>
                                <select name="group_id" id="" class="form-control">
                                    <option value="">--Vui lòng chọn--</option>
                                    @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if ('group_id')
                                <p style="color:red">{{ $errors->first('group_id') }}</p>
                                @endif
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="control-label" for="flatpickr01">Giới Tính<abbr name="Trường bắt buộc">*</abbr></label>
                                <select name="sex" id="" class="form-control">
                                    <option value="">--Vui lòng chọn--</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                    {{-- @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach --}}
                                </select>
                                @if ('gender')
                                <p style="color:red">{{ $errors->first('sex') }}</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-secondary me-2">Thêm</button>
                            <a href="{{route('user.index')}}" class="btn btn-light">Trở về</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
