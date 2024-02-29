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
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card center-form">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Chỉnh sửa</h4>
                            <form action="{{ route('customers.update', $item->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Tên khách hàng</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1" name="name"
                                        value="{{ $item->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                        value="{{ $item->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPhone1">Số điện thoại</label>
                                    <input type="text" class="form-control" id="exampleInputPhone1" name="phone"
                                        value="{{ $item->phone }}">
                                </div>
                                <button type="submit" class="btn btn-secondary me-2">Cập nhật</button>
                                <a href="{{ route('customers.index') }}" class="btn btn-light">Trở về</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection