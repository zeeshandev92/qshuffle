<x-app-layout title="Add Questions">

    <x-breadcrumb title="Add Questions" :backButton="route('questions.index')">
    </x-breadcrumb>

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Add Questions</h5>
                    </div>
                    <div class="card-body">
                        <x-form :route="route('questions.store')">
                            @include('pages.questions.form')
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->

</x-app-layout>
