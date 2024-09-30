<x-app-layout title="Edit Questions">

    <x-breadcrumb title="Edit Question" :backButton="route('questions.index')">
    </x-breadcrumb>

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Edit Question</h5>
                    </div>
                    <div class="card-body">
                        <x-form :route="route('questions.update', $question->id)">
                            @method('patch')
                            @include('pages.questions.form')
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->

</x-app-layout>
