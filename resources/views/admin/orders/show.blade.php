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
                            <form>
                                <div class="form-group">
                                    <label for="total_amount">Tên sản phẩm:</label>
                                    <input type="text" class="form-control" id="total_amount"
                                        value="{{ $item->product->name }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="order_status">Số lượng sản phẩm:</label>
                                    <input type="text" class="form-control" id="order_status"
                                        value="{{ $item->quantity }} cái" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="order_status">Tổng giá đơn hàng:</label>
                                    <input type="text" class="form-control" id="order_status"
                                        value="{{ $item->order->total_amount }} 000 VNĐ" readonly>
                                </div>
                                <div class="form-group">
                                    <a href="{{ route('orders.index') }}" class="btn btn-light me-2">Trở về</a>
                                    <form method="POST" action="{{ route('orders.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" style="height:40px;"><i class="bx bx-trash me-1"></i>Xóa</button>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
