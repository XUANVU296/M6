<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdi/css/materialdesignicons.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/typeahead.bundle.js')}}"></script>
<script src="{{ asset('js/select2.js')}}"></script>
<link rel="stylesheet" href="{{ asset('css/typeahead.css')}}">
<link rel="stylesheet" href="{{ asset('css/select2.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('products.index')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Trang chủ</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('products.index')}}">
                <i class="mdi mdi-shopping menu-icon"></i>
                <span class="menu-title">Mặt hàng</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('categories.index')}}">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span class="menu-title">Danh mục</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('groups.index')}}">
                <i class="mdi mdi-account  menu-icon"></i>
                <span class="menu-title">Nhân viên</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('users.index')}}">
                <i class="mdi mdi-account-group menu-icon"></i>
                <span class="menu-title">Nhân sự</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('customers.index')}}">
                <i class="mdi mdi-account-outline menu-icon"></i>
                <span class="menu-title">Khách hàng</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('orders.index')}}">
                <i class="mdi mdi-cart menu-icon"></i>
                <span class="menu-title">Đơn hàng</span>
            </a>
        </li>
    </ul>
</nav>
