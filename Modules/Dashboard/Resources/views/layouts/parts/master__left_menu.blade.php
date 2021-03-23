<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Главная
                </p>
            </a>
        </li>
        <li class="nav-header">Контент</li>
        <li class="nav-item">
            <a href="{{ route('dashboard.slider.index') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>Слайдер</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard.ourwork.index') }}" class="nav-link">
                <i class="nav-icon far fa-image"></i>
                <p>Наши работы</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard.page.index') }}" class="nav-link">
                <i class="nav-icon fas fa-copy"></i>
                <p>Страницы</p>
            </a>
        </li>
        <li class="nav-header">Настройки</li>
        <li class="nav-item">
            <a href="{{ route('dashboard.language.index') }}" class="nav-link">
                <i class="nav-icon fas fa-globe"></i>
                <p>Язык</p>
            </a>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
