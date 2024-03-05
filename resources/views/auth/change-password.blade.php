@extends('admin')

@section('content')
<script>
                            @if(session('successMessage'))
                            Swal.fire({
                                icon: 'success',
                                text: '{{ session('successMessage') }}',
                                confirmButtonText: 'Đóng'
                            });
                            @endif
                        </script>
                        <script>
                            @if(session('errorMessage'))
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
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Đổi mật khẩu</h4>
                        <form action="{{route('changePassword.submit')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Mật khẩu hiện tại</label>
                                <input id="current_password" type="password" class="form-control" id="exampleInputUsername1" placeholder="Vui lòng nhập mật khẩu" name="current_password" >
                                @error('current_password') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Mật khẩu mới</label>
                                <input id="new_password" type="password" class="form-control" id="exampleInputUsername1" placeholder="Vui lòng nhập mật khẩu" name="new_password">
                                @error('new_password') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Xác nhận mật khẩu</label>
                                <input id="new_password_confirmation" type="password" class="form-control" id="exampleInputUsername1" placeholder="Vui lòng nhập mật khẩu" name="new_password_confirmation" >
                                @error('new_password_confirmation') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <button type="submit" class="btn btn-secondary me-2">Đổi mật khẩu</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
