<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->route()->getName() == 'dashboard.index' ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Главная
                </p>
            </a>
        </li>
        <li class="nav-header">Контент</li>
        <li class="nav-item">
            <a href="{{ route('dashboard.slider.index') }}" class="nav-link {{ in_array(request()->route()->getName(), [
                'dashboard.slider.index',
                'dashboard.slider.create',
                'dashboard.slider.edit',
            ]) ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>Слайдер</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard.ourwork.index') }}" class="nav-link {{ in_array(request()->route()->getName(), [
                'dashboard.ourwork.index',
                'dashboard.ourwork.create',
                'dashboard.ourwork.edit',
            ]) ? 'active' : '' }}">
                <i class="nav-icon far fa-image"></i>
                <p>Наши работы</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard.page.index') }}" class="nav-link {{ in_array(request()->route()->getName(), [
                'dashboard.page.index',
                'dashboard.page.create',
                'dashboard.page.edit',
            ]) ? 'active' : '' }}">
                <i class="nav-icon fas fa-copy"></i>
                <p>Страницы</p>
            </a>
        </li>
        <li class="nav-header">Настройки</li>
        <li class="nav-item">
            <a href="{{ route('dashboard.language.index') }}" class="nav-link {{ in_array(request()->route()->getName(), [
                'dashboard.language.index',
                'dashboard.language.create',
                'dashboard.language.edit',
            ]) ? 'active' : '' }}">
                <i class="nav-icon fas fa-globe"></i>
                <p>Язык</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard.user.index') }}" class="nav-link {{ in_array(request()->route()->getName(), [
                'dashboard.user.index',
                'dashboard.user.create',
                'dashboard.user.edit',
            ]) ? 'active' : '' }}">
                <i class="nav-icon fas fa-users"></i>
                <p>Пользователи</p>
            </a>
        </li>

    </ul>
</nav>
<!-- /.sidebar-menu -->
