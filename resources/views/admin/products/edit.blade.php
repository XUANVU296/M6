@extends('admin')

@section('content')

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6 grid-margin stretch-card center-form">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Chỉnh sửa</h4>
                            <form action="{{ route('products.update', $item->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Ảnh</label>
                                    <input type="file" name="image" class="form-control" style="width: 1000px;"><br>
                                    @if ($item->image)
                                        <img src="{{ asset($item->image) }}" alt="Ảnh cũ" style="width:10%; height:50%;">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Tên</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                        placeholder="Nhập tên" name="name" value="{{ $item->name }}"
                                        style="width: 1000px;;">
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control" id="description" name="description" style="width: 1000px;">{{ $item->description }}</textarea>
                                    @error('description')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Giá</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                        placeholder="Nhập giá" name="price" value="{{ $item->price }}"
                                        style="width: 1000px;;">
                                    @error('price')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Số lượng</label>
                                    <input type="text" class="form-control" id="exampleInputUsername1"
                                        placeholder="Nhập sô lượng" name="quantity" value="{{ $item->quantity }}"
                                        style="width: 1000px;;">
                                    @error('quantity')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label class="form-label mb-1" for="status-org">Trạng thái</label>
                                    <select class="form-control" name="status" style="width: 1000px;;">
                                        <option value="Còn" {{ $item->status == 'Còn' ? 'selected' : '' }}>Còn</option>
                                        <option value="Hết" {{ $item->status == 'Hết' ? 'selected' : '' }}>Hết</option>
                                    </select>
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Thể loại</label>
                                        <select name="category_id" class="form-select" style="width: 1000px;;">
                                            <option value="">Vui lòng chọn</option>
                                            @foreach ($categories as $index => $categorie)
                                                <option value="{{ $categorie->id }}"
                                                    {{ $categorie->id == $item->category_id ? 'selected' : '' }}>
                                                    {{ $categorie->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-secondary me-2">Cập nhật</button>
                                <a href="{{ route('products.index') }}" class="btn btn-light">Trở về</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
