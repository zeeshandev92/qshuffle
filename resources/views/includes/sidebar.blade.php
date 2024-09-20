@php
    $url = url()->full();
@endphp

<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

                <div>
                    <button type="button"
                        class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button"
                        class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                @foreach ($menuData->menu as $menu)
                    {{-- adding active and open class if child is active --}}

                    {{-- menu headers --}}
                    @if (isset($menu->menuHeader))
                        <li class="nav-item-header pt-0">
                            <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">
                                {{ $menu->menuHeader }}</div>
                            <i class="ph-dots-three sidebar-resize-show"></i>
                        </li>
                    @else
                        {{-- active menu method --}}
                        @php
                            $activeClass = null;
                            $currentRouteName = Route::currentRouteName();

                            if (str_contains($currentRouteName, $menu->slug) and strpos($currentRouteName, $menu->slug) === 0 && !isset($menu->submenu)) {
                                $activeClass = 'active';
                            } elseif (isset($menu->submenu)) {
                                if (gettype($menu->slug) === 'array') {
                                    foreach ($menu->slug as $slug) {
                                        if (str_contains($currentRouteName, $slug) and strpos($currentRouteName, $slug) === 0) {
                                            $activeClass = 'nav-item-expanded nav-item-open';
                                        }
                                    }
                                } else {
                                    if (str_contains($currentRouteName, $menu->slug) and strpos($currentRouteName, $menu->slug) === 0) {
                                        $activeClass = 'nav-item-expanded nav-item-open';
                                    }
                                }
                            }
                        @endphp

                        {{-- main menu --}}
                        <li class="nav-item {{ isset($menu->submenu) ? 'nav-item-submenu' : '' }}">
                            <a href="{{ $menu->url ?? 'javascript:void(0);' }}" class="nav-link {{ $activeClass }}"
                                @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>

                                @isset($menu->icon)
                                    <i class="{{ $menu->icon }}"></i>
                                @endisset

                                <span>
                                    {{ $menu->name ?? '' }}
                                    @isset($menu->subtitle)
                                        <span class="d-block fw-normal opacity-50">{{ $menu->subtitle }}</span>
                                    @endisset
                                </span>

                                @isset($menu->badge)
                                    <span class="badge bg-{{ $menu->badge[0] }} align-self-center rounded-pill ms-auto">
                                        {{ $menu->badge[1] }}
                                    </span>
                                @endisset
                            </a>

                            {{-- submenu --}}
                            @isset($menu->submenu)
                                @include('includes.submenu', ['menu' => $menu->submenu])
                            @endisset

                        </li>
                    @endif
                @endforeach


                <!-- Main -->
                {{-- <li class="nav-item-header pt-0">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>

                <li class="nav-item">
                    <a href="index.html" class="nav-link active">
                        <i class="ph-house"></i>
                        <span>
                            Dashboard
                            <span class="d-block fw-normal opacity-50">No pending orders</span>
                        </span>
                    </a>
                </li> --}}

                {{-- <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link">
                        <i class="ph-layout"></i>
                        <span>Layouts</span>
                    </a>
                    <ul class="nav-group-sub collapse">
                        <li class="nav-item"><a href="index.html" class="nav-link active">Default layout</a>
                        </li>
                        <li class="nav-item"><a href="../../layout_2/full/index.html" class="nav-link">Layout
                                2</a></li>
                        <li class="nav-item"><a href="../../layout_3/full/index.html" class="nav-link">Layout
                                3</a></li>
                        <li class="nav-item"><a href="../../layout_4/full/index.html" class="nav-link">Layout
                                4</a></li>
                        <li class="nav-item"><a href="../../layout_5/full/index.html" class="nav-link">Layout
                                5</a></li>
                        <li class="nav-item"><a href="../../layout_6/full/index.html" class="nav-link">Layout
                                6</a></li>
                        <li class="nav-item"><a href="../../layout_7/full/index.html" class="nav-link disabled">Layout 7
                                <span class="badge align-self-center ms-auto">Coming soon</span></a></li>
                    </ul>
                </li> --}}


            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
