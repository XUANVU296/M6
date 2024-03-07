@extends('admin')

@section('content')
    <style>
        .center-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .form-group input[type="text"],
        .form-group select {
            width: 100%;
        }

        /* Canh giữa form */
        .center-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            /* Đảm bảo form giữa trang */
        }

        /* Khoảng cách giữa các thành phần trong form */
        .form-group:not(:last-child) {
            margin-bottom: 20px;
        }

        .button-group {
            display: flex;
            align-items: center;
            margin-top: 20px;
            /* Thêm khoảng cách giữa nút và các trường form */
        }

        .button-group button {
            margin-right: 15px;
            /* Khoảng cách giữa các nút */
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
                            <h4 class="card-title">Xem chi tiết đơn hàng</h4>
                            <div class="form-group">
                                <label for="total_amount">Tên sản phẩm:</label>
                                <input type="text" class="form-control" id="total_amount"
                                    value="{{ $item->products->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="order_status">Số lượng sản phẩm:</label>
                                <input type="text" class="form-control" id="order_status"
                                    value="{{ $item->quantity }} cái" readonly>
                            </div>
                            <div class="form-group">
                                <label for="order_status">Tổng giá đơn hàng:</label>
                                <input type="text" class="form-control" id="order_status"
                                    value="{{ $item->total_amount }} 000 VNĐ" readonly>
                            </div>
                            <form id="update-status-form" action="{{ route('orders.update.status', $item->id) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="order_status">Trạng thái đơn hàng:</label>
                                    <select class="form-control" id="order_status" name="order_status">
                                        <option value="Đang xử lý" @if ($item->order_status == 'Đang xử lý') selected @endif>Đang xử
                                            lý</option>
                                        <option value="Đã xác nhận" @if ($item->order_status == 'Đã xác nhận') selected @endif>Đã xác
                                            nhận</option>
                                        <option value="Đang vận chuyển" @if ($item->order_status == 'Đang vận chuyển') selected @endif>
                                            Đang vận chuyển</option>
                                        <option value="Đã giao hàng" @if ($item->order_status == 'Đã giao hàng') selected @endif>Đã
                                            giao hàng</option>
                                        <option value="Hủy" @if ($item->order_status == 'Hủy') selected @endif>Huỷ
                                        </option>
                                    </select>
                                </div>
                                <div class="button-group">
                                    <a href="{{ route('orders.index') }}" class="btn btn-light">Trở về</a>
                                    <!-- Nút "Lưu thay đổi" được đặt trong form -->
                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    <a href="{{ route('orders.trash', $item->id) }}" class="btn btn-danger"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')">Xóa</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
