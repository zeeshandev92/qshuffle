<x-app-layout title="App Strings">

    <x-breadcrumb title="App Strings">
        @can('languages-create')
        <a href="{{route('language.index')}}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill me-2">
            <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                <i class="ph-translate"></i>
            </span>
            Add Languages
        </a>
        @endcan
        @can('appString-create')
        <button class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill" data-bs-toggle="modal"
            data-bs-target="#modal_default">
            <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                <i class="ph-plus"></i>
            </span>
            Create New
        </button>
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
                    <x-datatable :url="route('app-strings.index')" :index="['DT_RowIndex', 'key', 'text', 'action']">
                        <th>No</th>
                        <th>Key</th>
                        <th>Text</th>
                        <th>Actions</th>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->

    @include('pages.app-strings.create')

    <div id="result"></div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '.edit-btn', function() {
                    let id = $(this).data('id');
                    let url = "{{ route('app-strings.index') }}";
                    // Perform Ajax request
                    $.ajax({
                        type: 'GET',
                        url: `${url}/${id}/edit`,
                        success: function(data, status) {
                            $('#result').html(data);
                            $('#modal_update').modal('show');
                            // Handle the response
                        },
                        error: function(error) {
                            console.log(error);
                            // Handle errors
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
