@extends('admin')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
<script>
    @if(session('successMessage'))
    Swal.fire({
        icon: 'success',
        text: '{{ session('successMessage') }}',
        confirmButtonText: 'Đóng'
    });
    @endif
</script>
<script>
    @if(session('errorMessage'))
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
                            <h2 class="offset-4">Danh Sách Danh mục</h2>
                        </div>

                        <a href="{{route('categories.create')}}" class="card-title">Thêm mới</a>
                        <p class="card-description">
                        </p>
                        <div class="table-responsive">
                            <form action="{{ route('categories.index') }}" method="GET" id="form-search" class="d-flex">
                                <div class="col">
                                    <input name="keyword" class="form-control" type="text" placeholder="Tìm tên" value="{{ request('keyword') }}" />
                                </div>
                                <div class="col-lg-3 flex-grow-4">
                                    <button class="btn btn-secondary" type="submit">Tìm kiếm</button>
                                </div>
                            </form>
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
                                            Thao tác
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $category)
                                    <tr>
                                        <!-- <td class="py-1">
                                            <img src="../../images/faces/face1.jpg" alt="image" />
                                        </td> -->
                                        <td>
                                            {{ $key + 1 }}
                                        </td>
                                        <td>
                                            {{ $category->name }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route('categories.edit' , $category->id)}}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                                                    </form>
                                                    @if (Auth::user()->hasPermission('Category_delete'))

                                                    <form method="POST" action="{{route('categories.destroy' ,$category->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" onclick="return confirm('Bạn có muốn xóa ?')"><i class="bx bx-trash me-1"></i> Xóa</button>
                                                    </form>
                                                    @endif

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
            {{ $categories->appends(request()->query())->links('pagination::bootstrap-5') }}
        </nav>
    </div>
    </div>
</div>
@endsection
