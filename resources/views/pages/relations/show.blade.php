<x-app-layout title="Relations">

    <x-breadcrumb title="Relations" :backButton="route('relations.index')">
    </x-breadcrumb>

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ $relation->title }}</h5>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Language</th>
                                <th>Text</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($relation->languages as $lang)
                                <tr>
                                    <th>{{ $lang->name }}</th>
                                    <td>{{ $lang->pivot->translated_relation }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->



    @push('scripts')
        <script></script>
    @endpush
</x-app-layout>
