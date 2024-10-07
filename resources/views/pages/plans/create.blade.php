<x-app-layout title="Add Plan">

    <x-breadcrumb title="Add Plan" :backButton="route('plans.index')">
    </x-breadcrumb>

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Add Plan</h5>
                    </div>
                    <div class="card-body">
                        <x-form :route="route('plans.store')">
                            @include('pages.plans.form')
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->

</x-app-layout>
