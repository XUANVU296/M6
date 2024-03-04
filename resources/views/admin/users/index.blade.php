




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
                        <a href="{{ route('user.create') }}" class="card-title">Đăng ký tài khoản nhân sự</a>

                        <p class="card-description">
                        </p>
                        <div class="table-responsive">

                            <table class="table table-striped table-responsive-lg">
                                <thead>
                                    <tr>
                                    <th data-breakpoints="xs">Stt</th>
                                    <th>Ảnh</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Chức vụ</th>
                                    <th data-breakpoints="xs">Tùy Chỉnh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $key => $user)
                                    <tr data-expanded="true" class="item-{{ $user->id }}">
                                        <td>{{  ++$key }}</td>
                                        <td><img width="90px" height="90px" src="{{ asset($user->image) }}" alt=""></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->group->name }}</td>

                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route('user.edit' , $user->id)}}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>

                                                    <form method="POST" action="{{route('user.destroy' ,$user->id)}}">
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
                            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
           $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
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
                        },
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Tuổi...?',
                        text: ' Supper Admin không thể xóa!',
                    })
                }
            })
        });
        </script>

        <script>
            Swal.bindClickHandler()
            Swal.mixin({
            toast: true,
            icon: 'error',
            text: "Ngu!",
            }).bindClickHandler('data-swal-toast-template')
        </script>


    </div>
@endsection
