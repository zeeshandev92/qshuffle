<x-app-layout title="Questions">

    <x-breadcrumb title="Questions">
        {{-- @can('questions-create') --}}
        <a href="{{ route('questions.create') }}"
            class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
            <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                <i class="ph-plus"></i>
            </span>
            Create New
        </a>
        {{-- @endcan --}}
    </x-breadcrumb>

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">List</h5>
                    </div>
                    <x-datatable :url="route('questions.index')" :index="['DT_RowIndex', 'question', 'relation', 'language', 'gender', 'action']">
                        <th>No</th>
                        <th>Question</th>
                        <th>Relation</th>
                        <th>Language</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->

</x-app-layout>
