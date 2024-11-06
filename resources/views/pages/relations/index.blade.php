<x-app-layout title="Relations">

    <x-breadcrumb title="Relations">
        @can('relations-create')
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
                    <x-datatable :url="route('relations.index')" :index="['DT_RowIndex', 'title', 'language', 'status', 'action']">
                        <th>No</th>
                        <th>Title</th>
                        <th>Language</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->

    @include('pages.relations.create')

    <div id="result"></div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '.edit-btn', function() {
                    let id = $(this).data('id');
                    let url = "{{ route('relations.index') }}";
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
