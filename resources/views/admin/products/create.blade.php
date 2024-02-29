@extends('admin')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Thêm mới</h4>
                        <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Ảnh</label>
                                <input type="file" class="form-control" id="exampleInputUsername1" placeholder="Nhập tên" name="image" value="{{ old('image') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Tên</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nhập tên" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Mô tả</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nhập mô tả" name="description" value="{{ old('description') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Giá</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nhập giá" name="price" value="{{ old('price') }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputUsername1">Số lượng</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nhập sô lượng" name="quantity" value="{{ old('quantity') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="status-org">Trạng thái </label>
                                <select class="form-control" name="status" value="{{ old('status') }}">
                                    <option value="">Tất cả</option>
                                    <option value="Còn">Còn</option>
                                    <option value="Hết">Hết</option>
                                </select>
                                @error('status') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Thể loại</label>
                                <select name="category_id" class="form-select" value="{{ old('category_id') }}">
                                    <option value="">Vui lòng chọn</option>
                                    @foreach($categories as $index => $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="alert alert-danger">{{ $message }}</div> @enderror
                            </div>
                            <button type="submit" class="btn btn-secondary me-2">Thêm</button>
                            <a href="{{route('products.index')}}" class="btn btn-light">Trở về</a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection