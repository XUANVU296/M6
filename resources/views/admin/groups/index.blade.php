@extends('admin')
@section('content')
<main class="page-content">
    <div class="container">
        <section class="wrapper">
            <div class="table-agile-info">
                <div class="panel-panel-default">
                    <header class="page-title-bar">

                    </header>
                    <hr>
                    <div class="panel-heading">
                        <h2 class="offset-4">Danh Sách Nhóm Nhân Viên</h2>
                    </div>
                    <nav aria-label="breadcrumb">

                        <a href="{{route('groups.create')}}" class="btn btn-success">Tạo nhóm nhân viên</a>
                        @if (session('success') || session('error'))
                        <div class="card-header pt-2 pb-0">
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif
                        </div>
                        <script>
                            setTimeout(function() {
                                document.querySelectorAll('.alert').forEach(function(alert) {
                                    alert.style.display = 'none';
                                });
                            }, 2000); // Thời gian trễ 2 giây (2000ms)
                        </script>
                        @endif
                    </nav>
                    <div>
                        <table class="table" ui-jq="footable" ui-options='{
    "paging": {
      "enabled": true
    },
    "filtering": {
      "enabled": true
    },
    "sorting": {
      "enabled": true
    }}'>
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Người đảm nhận</th>
                                    <th data-breakpoints="xs">Tùy Chỉnh</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @foreach ($groups as $key => $group)
                                <tr data-expanded="true" class="item-{{ $group->id }}">
                                    <td>{{ $key + 1 }}</td>

                                    <td>{{ $group->name }} </td>
                                    <td>Hiện có {{ $group->users()->count() }} người</td>
                                    <td>
                                        <form action="" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <a class="btn btn-primary " href="{{route('group.detail', $group->id)}}">Trao Quyền</a>


                                            <a href="{{route('groups.edit', $group->id)}}" class="btn btn-warning">Sửa</a>

                                            <a data-href="{{route('groups.destroy' , $group->id)}}" id="{{ $group->id }}" class="btn btn-danger sm deleteIcon">Xóa</a>


                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $groups->appends(request()->query()) }}
                    </div>
                </div>
        </section>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
        {{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script> --}}
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
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
        </script>
    </div>
</main>
@endsection
