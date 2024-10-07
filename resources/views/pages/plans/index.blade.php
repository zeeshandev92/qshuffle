<x-app-layout title="Plans">

    <x-breadcrumb title="Plans">
        @can('plans-create')
        <a href="{{ route('plans.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
            <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                <i class="ph-plus"></i>
            </span>
            Create New
        </a>
        @endcan
    </x-breadcrumb>

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">List</h5>
                    </div>
                    <x-datatable :url="route('plans.index')" :index="['DT_RowIndex', 'title', 'type', 'charges', 'action']">
                        <th>No</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->

</x-app-layout>
