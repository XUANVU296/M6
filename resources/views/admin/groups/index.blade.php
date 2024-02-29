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
                                        <!-- <td class="py-1">
                                            <img src="../../images/faces/face1.jpg" alt="image" />
                                        </td> -->
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
                                                    <a class="dropdown-item" href="{{route('categories.edit' , $category->id)}}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                                                    </form>

                                                    <form method="POST" action="{{route('categories.destroy' ,$category->id)}}">
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
                                </ <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js">
                                </script>
                                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                                <script>
                                    $(document).on('click', '.deleteIcon', function(e) {
                                        // e.preventDefault();
                                        let id = $(this).attr('id');
                                        let href = $(this).data('href');
                                        let csrf = '{{ csrf_token() }}';
                                        console.log(id);
                                        Swal.fire({
                                            title: 'Bạn có chắc không?',
                                            text: "Bạn sẽ không thể hoàn nguyên điều này!",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Có, xóa!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                $.ajax({
                                                    url: href,
                                                    method: 'delete',
                                                    data: {
                                                        _token: csrf
                                                    },
                                                    success: function(res) {
                                                        Swal.fire(
                                                            'Deleted!',
                                                            'Tệp của bạn đã bị xóa!',
                                                            'success'
                                                        )
                                                        $('.item-' + id).remove();
                                                    }

                                                });
                                            }
                                        })
                                    });
                                </script>table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
