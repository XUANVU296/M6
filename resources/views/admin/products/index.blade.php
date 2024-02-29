@extends('admin')

@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
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
                        <a href="{{route('products.create')}}" class="card-title">Thêm mới</a>
                        <p class="card-description">
                        </p>
                        <div class="table-responsive">
                            <form action="{{ route('products.index') }}" method="GET" id="form-search" class="d-flex">
                                <div class="col">
                                    <input name="keyword" class="form-control" type="text" placeholder="Tìm tên" value="{{ request('keyword') }}" />
                                </div>
                                <div class="col-lg-3 flex-grow-4">
                                    <select name="keyword11" class="form-control">
                                        <option value="">Trạng thái</option>
                                        <option value="Còn" {{ request('keyword11') === 'Còn' ? 'selected' : '' }}>Còn</option>
                                        <option value="Hết" {{ request('keyword11') === 'Hết' ? 'selected' : '' }}>Hết</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 flex-grow-4">
                                    <button class="btn btn-secondary" type="submit">Tìm kiếm</button>
                                </div>
                            </form>
                            <table class="table table-striped table-responsive-lg">
                                <thead>
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Trạng thái</th>
                                        <th>Thể loại</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{ asset($product->image) }}" alt="image" />
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>{{ $product->category_name }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route('products.edit' , $product->id)}}"><i class="bx bx-edit-alt me-1"></i> Sửa</a>
                                                    </form>
                                                    <a class="dropdown-item" href="{{route('products.show' , $product->id)}}"><i class="bx bx-show me-1"></i> Xem</a>

                                                    <form method="POST" action="{{route('products.destroy' ,$product->id)}}">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <nav class="float-right">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
        </nav>
    </div>
</div>

@endsection
