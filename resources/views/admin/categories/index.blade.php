@extends('admin')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('categories.create')}}" class="card-title">Thêm mới</a>
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

                                                    <form method="POST" action="{{route('categories.destroy' ,$category->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item"><i class="bx bx-trash me-1"></i> Xóa</button>
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
    </div>
</div>
@endsection
