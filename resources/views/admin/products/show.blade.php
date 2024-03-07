@extends('admin')

@section('content')

<div class="row">
    <div class="col-12 col-lg-12">
        <!-- Product Information -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="ecommerce-customer-name">Giá</label>
                            <input type="text" class="form-control" placeholder="Mô tả" name="price" value="{{ number_format($item->price) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ảnh</label>
                        <input name="image" class="form-control" style="width: 340%;"><br>
                        @if ($item->image)
                        <img src="{{ asset($item->image) }}" alt="Ảnh cũ" style="width:30%; height:70%;">
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="ecommerce-customer-name">Mô tả</label>
                            <p>{!!$item->description !!}</p>
                            <small id="" class="form-text text-muted"></small>

                        </div>
                    </div>

                    <div class="d-flex align-content-center flex-wrap gap-3">
                    </div>
                </div>
            </div>
        </div>
        <a href="{{route('products.index')}}" class="btn btn-secondary">Trở Về</a>
    </div>
    </body>

    </html>

    @endsection
