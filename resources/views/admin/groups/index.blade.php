@extends('admin')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <script>
                            @if(session('successMessage'))
                            Swal.fire({
                                icon: 'success',
                                text: '{{ session('
                                successMessage ') }}',
                                confirmButtonText: 'Đóng'
                            });
                            @endif
                        </script>
                        <script>
                            @if(session('errorMessage'))
                            Swal.fire({
                                icon: 'error',
                                text: '{{ session('
                                errorMessage ') }}',
                                confirmButtonText: 'Đóng'
                            });
                            @endif
                        </script>
                        <div class="panel-heading">
                            <h2 class="offset-4">Danh Sách Nhóm Nhân Viên</h2>
                        </div>
                        <a href="{{route('groups.create')}}" class="card-title">Tạo mới nhóm nhân viên</a>
                        <p class="card-description">
                        </p>
                        <div class="table-responsive">

                            <table class="table table-striped table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>
                                            STT
                                        </th>
                                        <th>
                                            Tên
                                        </th>
                                        <th>
                                            Người đảm nhận
                                        </th>
                                        <th>
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groups as $key => $group)
                                    <tr>
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td>
                                            {{ $group->name }}
                                        </td>
                                        <td>Hiện có {{ count($group->users) }} người</td>

                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route('group.detail', $group->id)}}">Trao Quyền</a>
                                                    <a class="dropdown-item" href="{{route('groups.edit' , $group->id)}}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>

                                                    <form method="POST" action="{{route('groups.destroy' ,$group->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" onclick="return confirm('Bạn có muốn xóa ?')"><i class="bx bx-trash me-1"></i> Xóa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                @php
                                if (Session::has('addgroup')) {
                                    @endphp
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Tạo quyền xong rồi nhé!',
                                        text: "Cấp quyền ngay nhé",
                                        showClass: {
                                            popup: 'swal2-show'
                                        }
                                    })
                                    @php
                                }
                                @endphp
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
