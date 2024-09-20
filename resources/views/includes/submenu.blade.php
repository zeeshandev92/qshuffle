<ul class="nav-group-sub collapse">
    @if (isset($menu))
        @foreach ($menu as $submenu)
            {{-- active menu method --}}
            @php
                $activeClass = null;
                $active = 'active';
                $currentRouteName = Route::currentRouteName();

                if (str_contains($currentRouteName, $submenu->slug)) {
                    $activeClass = 'active';
                } elseif (isset($submenu->submenu)) {
                    if (gettype($submenu->slug) === 'array') {
                        foreach ($submenu->slug as $slug) {
                            if (str_contains($currentRouteName, $slug) and strpos($currentRouteName, $slug) === 0) {
                                $activeClass = $active;
                            }
                        }
                    } else {
                        if (str_contains($currentRouteName, $submenu->slug) and strpos($currentRouteName, $submenu->slug) === 0) {
                            $activeClass = $active;
                        }
                    }
                }
            @endphp

            {{-- <li class="menu-item {{ $activeClass }}">
                <a href="{{ isset($submenu->url) ? url('admin/' . $submenu->url) : 'javascript:void(0)' }}"
                    class="{{ isset($submenu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}"
                    @if (isset($submenu->target) and !empty($submenu->target)) target="_blank" @endif>
                    @if (isset($submenu->icon))
                        <i class="{{ $submenu->icon }}"></i>
                    @endif
                    <div>{{ isset($submenu->name) ? __($submenu->name) : '' }}</div>
                </a>

                @if (isset($submenu->submenu))
                    @include('admin.includes.submenu', ['menu' => $submenu->submenu])
                @endif
            </li> --}}


            <li class="nav-item">
                <a href="{{ $submenu->url ?? 'javascript:void(0);' }}" class="nav-link {{ $activeClass }}"
                    @if (isset($submenu->target) and !empty($submenu->target)) target="_blank" @endif>

                    @isset($submenu->icon)
                        <i class="{{ $submenu->icon }}"></i>
                    @endisset

                    <span>
                        {{ $submenu->name ?? '' }}
                        @isset($submenu->subtitle)
                            <span class="d-block fw-normal opacity-50">{{ $submenu->subtitle }}</span>
                        @endisset
                    </span>

                    @isset($submenu->badge)
                        <span class="badge bg-{{ $submenu->badge[0] }} align-self-center rounded-pill ms-auto">
                            {{ $submenu->badge[1] }}
                        </span>
                    @endisset
                </a>

                {{-- submenu --}}
                @isset($submenu->submenu)
                    @include('includes.submenu', ['menu' => $submenu->submenu])
                @endisset

            </li>
        @endforeach
    @endif
</ul>
