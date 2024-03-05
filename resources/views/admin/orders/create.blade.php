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
                            <h4 class="card-title">Thêm mới đơn hàng</h4>
                            <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="customer_id">Tên khách hàng</label>
                                    <select class="form-control" id="customer_id" name="customer_id">
                                        <option value="">-- Chọn khách hàng --</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Tổng đơn hàng</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                        placeholder="Vui lòng nhập tổng giá trị đơn hàng" name="total_amount">
                                </div>
                                @error('total_amount')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="form-group">
                                    <label for="order_status">Trạng thái đơn hàng</label>
                                    <select class="form-control" id="order_status" name="order_status">
                                        <option value="">-- Chọn trạng thái --</option>
                                        <option value="Đang xử lý" {{ old('order_status') == 'Đang xử lý' ? 'selected' : '' }}>Đang xử lý</option>
                                        <option value="Đã xác nhận" {{ old('order_status') == 'Đã xác nhận' ? 'selected' : '' }}>Đã xác nhận</option>
                                        <option value="Đang vận chuyển" {{ old('order_status') == 'Đang vận chuyển' ? 'selected' : '' }}>Đang vận chuyển</option>
                                        <option value="Đã giao hàng" {{ old('order_status') == 'Đã giao hàng' ? 'selected' : '' }}>Đã giao hàng</option>
                                        <option value="Hủy" {{ old('order_status') == 'Hủy' ? 'selected' : '' }}>Hủy</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-secondary me-2">Thêm</button>
                                <a href="{{ route('orders.index') }}" class="btn btn-light">Trở về</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
