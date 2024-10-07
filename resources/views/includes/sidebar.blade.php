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

                @can('dashboard-view')
                    <x-nav-item route="dashboard" icon="house" title="Dashboards" />
                @endcan

                @can('questions-list')
                    <x-nav-item route="questions.index" active='questions.*' icon="question" title="Question" />
                @endcan

                @can('plans-list')
                    <x-nav-item route="plans.index" active='plans.*' icon="clipboard-text" title="Plans" />
                @endcan

                @can('relations-list')
                    <x-nav-item route="relations.index" active='relations.*' icon="link" title="Relations" />
                @endcan

                {{--

                @can('users-list')
                    <x-nav-item route="users" icon="users" title="Users" />
                @endcan

                @can('users-list')
                    <x-nav-item route="users" icon="users" title="Users" />
                @endcan

                --}}

                @can('roles-list')
                    <x-nav-item route="roles.index" active='roles.*' icon="lock" title="Roles" />
                @endcan






                {{-- @canany(['shopSettings-create', 'templateSettings-create', 'adminSettings-create'])
                    <x-nav-item active="settings.*" icon="gear-six" title="Settings" :submenu="true">
                        @can('shopSettings-create')
                            <x-nav-item route="settings.shop" title="Shop" />
                        @endcan
                        @can('adminSettings-create')
                            <x-nav-item route="settings.admin" title="Admin" />
                        @endcan
                        @can('templateSettings-create')
                            <x-nav-item active="settings.template.*" route="settings.template.index" title="Template" />
                        @endcan
                        <x-nav-item active="settings.systemLogs.*" route="settings.system-logs.index" title="System Logs" />
                    </x-nav-item>
                @endcanany --}}

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
