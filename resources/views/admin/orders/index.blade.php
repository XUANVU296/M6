@extends('admin')

@section('content')
    <style>
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            /* Add some padding inside the card */
        }

        .card-title {
            color: #333;
            font-size: 18px;
            /* Increase font size for card title */
            font-weight: bold;
            /* Make card title bold */
            margin-bottom: 20px;
            /* Add some space below the card title */
        }

        .table {
            background-color: #fff;
            border-radius: 10px;
            /* Rounded corners for the table */
            overflow: hidden;
            /* Hide overflow for the table */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border-color: #ddd;
            padding: 12px;
            /* Increase padding for table cells */
        }

        .input-container {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .input-container input:focus {
            outline: none;
            /* Remove focus outline */
            border-color: #007bff;
            /* Change border color when focused */
        }

        .dropdown-menu {
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Add shadow to dropdown menu */
            z-index: 1000;
        }

        .dropdown-menu a {
            color: #333;
            text-decoration: none;
            /* Remove underline from dropdown links */
            display: block;
            padding: 10px 15px;
            /* Add padding to dropdown links */
        }

        .dropdown-menu a:hover {
            background-color: #f8f9fa;
            /* Change background color on hover */
        }

        .col {
            padding: 50px;
        }

        .form-control {
            border-radius: 5px;
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
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="panel-heading">
                                <h2 class="offset-4">Danh Sách đơn hàng</h2>
                            </div>
                            <a href="{{ route('orders.create') }}" class="card-title">Thêm mới</a>
                            <p class="card-description">
                            <form action="{{ route('orders.index') }}" method="GET" id="form-search">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="search_name">Tìm tên khách hàng:</label>
                                            <input type="text" name="search_name" class="form-control" id="search_name"
                                                placeholder="Nhập tên khách hàng" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="start_date">Từ ngày:</label>
                                            <input name="start_date" class="form-control" type="date"
                                                value="{{ request('start_date') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="end_date">Đến ngày:</label>
                                            <input name="end_date" class="form-control" type="date"
                                                value="{{ request('end_date') }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="search_total">Tìm theo tổng giá trị đơn hàng:</label>
                                            <select name="search_total" class="form-control" id="search_total"
                                                style="height:45px;">
                                                <option value="">Chọn khoảng giá trị đơn hàng</option>
                                                <option value="0-10"
                                                    {{ old('search_total') == '0-10' ? 'selected' : '' }}>Từ 0 VNĐ đến
                                                    10 000 VNĐ</option>
                                                <option value="10-50"
                                                    {{ old('search_total') == '11-50' ? 'selected' : '' }}>Từ 11 000 VNĐ đến
                                                    50 000 VNĐ</option>
                                                <option value="51-100"
                                                    {{ old('search_total') == '51-100' ? 'selected' : '' }}>Từ 51 000 VNĐ
                                                    đến 100 000 VNĐ</option>
                                                <option value="101" {{ old('search_total') == '101' ? 'selected' : '' }}>
                                                    Trên 100 000 VNĐ</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <button class="btn btn-secondary form-control" type="submit"
                                                style="width:120px;margin-top:30px;height:45px;">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </p>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            STT
                                        </th>
                                        <th>
                                            Tên khách hàng
                                        </th>
                                        <th>
                                            Ngày tạo đơn
                                        </th>
                                        <th>
                                            Tổng đơn
                                        </th>
                                        <th>
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <th>
                                                {{ $key + 1 }}
                                            </th>
                                            <td>
                                                {{ $order->customers->name }}
                                            </td>
                                            <td>
                                                {{ $order->date }}
                                            </td>
                                            <td>
                                                {{ $order->total_amount }} 000 VNĐ
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('orders.show', $order->id) }}"><i
                                                                class="bx bx-edit-alt me-1"></i> Xem</a>
                                                        <form method="POST"
                                                            action="{{ route('orders.destroy', $order->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="dropdown-item"><i class="bx bx-trash me-1"></i>
                                                                Xóa</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <nav class="float-right">
                {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Khởi tạo Select2 cho ô input
            $('.select2').select2({
                placeholder: 'Tìm kiếm',
                allowClear: true, // Cho phép xóa lựa chọn
                minimumInputLength: 1, // Số ký tự tối thiểu cần nhập trước khi tìm kiếm
                ajax: {
                    url: 'path/to/your/ajax/endpoint', // Đường link của endpoint AJAX
                    dataType: 'json',
                    delay: 250, // Độ trễ trước khi gửi request AJAX (ms)
                    processResults: function(data) {
                        return {
                            results: data // Dữ liệu trả về từ endpoint AJAX
                        };
                    },
                    cache: true // Lưu cache dữ liệu trả về từ endpoint AJAX
                }
            });
        });
    </script>
@endsection
