@extends('admin')

@section('content')
    <style>
        .search-input {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-input input[type="search"] {
            flex: 1;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
            margin-right: 5px;
        }

        .search-input button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-input button[type="submit"]:hover {
            background-color: #0056b3;
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
                            <a href="{{ route('groups.create') }}" class="card-title">Thêm quyền</a>
                            <table class="table table-striped table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>
                                            STT
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
                                    @foreach ($groups as $key => $group)
                                        <tr>
                                            <th>
                                                {{ $key + 1 }}
                                            </th>
                                            <td>
                                                {{ $group->name }}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown"><i
                                                            class="bx bx-dots-vertical-rounded"></i></button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item"
                                                            href="{{ route('groups.edit', $group->id) }}"><i
                                                                class="bx bx-edit-alt me-1"></i> Sửa</a>
                                                        <form method="POST"
                                                            action="{{ route('groups.destroy', $group->id) }}">
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
                {{ $groups->appends(request()->query())->links('pagination::bootstrap-5') }}
            </nav>
        </div>
    </div>
@endsection
