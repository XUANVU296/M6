@extends('admin')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            /* Slightly lighter background color */
        }

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

        .input-container input {
            flex: 1;
            margin-right: 95px;
            padding: 10px;
            border-radius: 5px;
            /* Rounded corners for the input fields */
            border: 1px solid #ccc;
            /* Add a border to input fields */
            justify-content: center;
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
                            <a href="{{ route('users.create') }}" class="card-title">Thêm mới</a>
                            <p class="card-description">
                            <form action="{{ route('users.index') }}" method="GET" id="form-search" class="d-flex">
                                <div class="col">
                                    <input name="search_name" class="form-control" type="text" placeholder="Tìm tên"
                                        value="{{ request('search_name') }}" />
                                </div>
                                <div class="col">
                                    <input name="search_email" class="form-control" type="text" placeholder="Tìm email"
                                        value="{{ request('search_email') }}" />
                                </div>
                                <div class="col">
                                    <input name="search_phone" class="form-control" type="text" placeholder="Tìm SĐT"
                                        value="{{ request('search_phone') }}" />
                                </div>
                                <div class="col">
                                    <button class="btn btn-secondary" type="submit">Tìm kiếm</button>
                                </div>
                            </form>
                            </p>
                            <table class="table table-striped table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>
                                            STT
                                        </th>
                                        <th>
                                            Ảnh
                                        </th>
                                        <th>
                                            Tên
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            SĐT
                                        </th>
                                        <th>
                                            Chức vụ
                                        </th>
                                        <th>
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <th>
                                                {{ $key + 1 }}
                                            </th>
                                            <td class="py-1">
                                                <img src="{{ asset($user->image) }}" alt="image" />
                                            </td>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                {{ $user->phone }}
                                            </td>
                                            <td>
                                                {{ $user->group->name }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('users.edit', $user->id) }}"><i
                                                                class="bx bx-edit-alt me-1"></i> Sửa</a>
                                                        <form method="POST"
                                                            action="{{ route('users.destroy', $user->id) }}">
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
                {{ $users->appends(request()->query())->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    </div>
@endsection
