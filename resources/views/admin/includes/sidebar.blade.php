<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdi/css/materialdesignicons.min.css">
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
            <a class="nav-link" href="{{route('user.index')}}">
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
    </ul>
</nav>
