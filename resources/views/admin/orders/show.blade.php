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
                            <h4 class="card-title">Xem chi tiết đơn hàng</h4>
                            <form id="delete-form" action="{{ route('orders.trash', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
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
                                <div class="form-group">
                                    <label for="order_status">Trạng thái đơn hàng:</label>
                                    <input type="text" class="form-control" id="order_status"
                                        value="{{ $item->order_status }}" readonly>
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('orders.index') }}" class="btn btn-light me-2">Trở về</a>
                                    <button type="submit" class="btn btn-danger" style="height:40px;"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')">
                                        <i class="bx bx-trash me-1"></i>Xóa
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteOrder() {
            if (confirm('Bạn có chắc chắn muốn xóa đơn hàng này không?')) {
                // Lấy đường dẫn xóa từ action của form
                var deleteUrl = document.getElementById('delete-form').getAttribute('action');
                // Gửi yêu cầu DELETE bằng JavaScript
                fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => {
                    // Kiểm tra xem yêu cầu xóa đã thành công hay không
                    if (response.ok) {
                        // Nếu thành công, chuyển hướng người dùng hoặc làm bất kỳ điều gì khác bạn muốn ở đây
                        window.location.reload(); // Chẳng hạn, làm mới trang
                    }
                }).catch(error => {
                    console.error('Có lỗi xảy ra:', error);
                });
            }
        }
    </script>
@endsection
