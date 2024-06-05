<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- ! Hide app brand if navbar-full -->
  <div class="app-brand demo">
    <a href="{{route('dashboard')}}" class="app-brand-link">
      <span class="app-brand-logo demo me-1">
        <!-- @include('_partials.macros',["height"=>20]) -->
      </span>
      <img src="{{ asset('logo.png') }}" width="30px" height="20px;" />
      <span class="app-brand-text demo menu-text fw-semibold ms-2">{{config('variables.templateName')}}</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    <!-- <li class="menu-header fw-medium mt-4">
      <span class="menu-header-text">testse</span>
    </li> -->
    <!-- {{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }} -->
    <li class="menu-item {{ request()->is('dashboard*') ? 'active' : '' }}">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
        <div>Dashboards</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('customer*') ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
        <div>Customer</div>
        <div class="badge bg-danger rounded-pill ms-auto">3</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->is('customers*') ? 'active' : '' }}">
          <a href="{{ route('customer.index') }}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
            <div>Register Customer</div>
          </a>
        </li>
        <li class="menu-item {{ request()->is('customerlogin') ? 'active' : '' }}">
          <a href="{{ route('customerlogin') }}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
            <div>Customer Login Location</div>
          </a>
        </li>
        <li class="menu-item {{ request()->is('roles*') ? 'active' : '' }}">
          <a href="{{ route('customerAccess') }}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
            <div>User Request for grant request</div>
          </a>
        </li>
      </ul>
    </li>
    <li class="menu-item {{ request()->is('roles*') ? 'active' : '' }}">
      <a href="{{ route('roles.index') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-flip-to-front"></i>
        <div>Roles</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('user') ? 'active' : '' }}">
      <a href="{{ route('user.index') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
        <div>User</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('sliders*') ? 'active' : '' }}">
      <a href="{{ route('sliders.index') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
        <div>Slider</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('category*') ? 'active' : '' }}">
      <a href="{{ route('categorys.index') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
        <div>Category</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('karat*') ? 'active' : '' }}">
      <a href="{{ route('karat.index') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-flip-to-front"></i>
        <div>Karat</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('sizes*') ? 'active' : '' }}">
      <a href="{{ route('sizes.index') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-flip-to-front"></i>
        <div>Size</div>
      </a>
    </li>


    <li class="menu-item {{ (request()->is('products*') || request()->is('gridview*')) ? 'active open' : '' }}">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
        <div>Product List</div>
        <div class="badge bg-danger rounded-pill ms-auto">2</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item {{ request()->is('products*') ? 'active' : '' }}">
          <a href="{{ route('products.index') }}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
            <div>Products</div>
          </a>
        </li>
        <li class="menu-item {{ request()->is('gridview') ? 'active' : '' }}">
          <a href="{{ route('gridview') }}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
            <div>Tiles Wise</div>
          </a>
        </li>
        <li class="menu-item {{ request()->is('groups') ? 'active' : '' }}">
          <a href="{{ route('groups.index') }}" class="menu-link">
            <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
            <div>Groups</div>
          </a>
        </li>
      </ul>
    </li>

    <!-- <li class="menu-item {{ request()->is('products*') ? 'active' : '' }}">
      <a href="{{ route('products.index') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
        <div>Products</div>
      </a>
    </li> -->
    <li class="menu-item {{ request()->is('order*') ? 'active' : '' }}">
      <a href="{{ route('order.index') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
        <div>Order</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('date_wise*') ? 'active' : '' }}">
      <a href="{{ route('datewise.index') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-table"></i>
        <div>Date wise</div>
      </a>
    </li>
    <li class="menu-item {{ request()->is('holiday*') ? 'active' : '' }}">
      <a href="{{ route('holiday.index') }}" class="menu-link">
        <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
        <div>Holidays</div>
      </a>
    </li>

    <!-- 
    @foreach ($menuData[0]->menu as $menu)


    @if (isset($menu->menuHeader))
    <li class="menu-header fw-medium mt-4">
      <span class="menu-header-text">{{ __($menu->menuHeader) }}</span>
    </li>

    @else

    @php
    $activeClass = null;
    $currentRouteName = Route::currentRouteName();

    if ($currentRouteName === $menu->slug) {
    $activeClass = 'active';
    }
    elseif (isset($menu->submenu)) {
    if (gettype($menu->slug) === 'array') {
    foreach($menu->slug as $slug){
    if (str_contains($currentRouteName,$slug) and strpos($currentRouteName,$slug) === 0) {
    $activeClass = 'active open';
    }
    }
    }
    else{
    if (str_contains($currentRouteName,$menu->slug) and strpos($currentRouteName,$menu->slug) === 0) {
    $activeClass = 'active open';
    }
    }

    }
    @endphp

    <li class="menu-item {{$activeClass}}">
      <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}" class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
        @isset($menu->icon)
        <i class="{{ $menu->icon }}"></i>
        @endisset
        <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
        @isset($menu->badge)
        <div class="badge bg-{{ $menu->badge[0] }} rounded-pill ms-auto">{{ $menu->badge[1] }}</div>

        @endisset
      </a>


    </li>
    @endif
    @endforeach
  </ul> -->

</aside>