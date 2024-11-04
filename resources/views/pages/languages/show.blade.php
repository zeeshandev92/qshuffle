<x-app-layout title="Languages">

    <x-breadcrumb :title="$language->name . ' Language '" :backButton="route('language.index')">
        <a href="{{ route('language.translate-strings', $language->id) }}"
            class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
            <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                <i class="ph-globe"></i>
            </span>
            Translate All
        </a>
    </x-breadcrumb>

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">List</h5>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Key</th>
                                <th>Text</th>
                                <th>Translation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($strings as $i => $string)
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" value="{{ $string->key }}" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="{{ $string->text }}" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control translated-text"
                                            value="{{ $string->translations->value('translated_text') }}"
                                            data-index="{{ $i }}" data-text="{{ $string->text }}"
                                            data-translationid="{{ $string->translations->value('id') }}"
                                            data-stringid="{{ $string->id }}">
                                    </td>
                                    <td>
                                        <button type="button"
                                            class="btn btn-outline-primary btn-icon rounded-pill update-translation
                                                {{ $string->translations->count() > 0 ? '' : 'd-none' }}"
                                            data-index="{{ $i }}">
                                            <i class="ph-note-pencil"></i>
                                        </button>

                                        <button type="button"
                                            class="btn btn-outline-success btn-icon rounded-pill translate-string
                                                {{ $string->translations->count() > 0 ? 'd-none' : '' }}"
                                            data-index="{{ $i }}">
                                            <i class="ph-translate"></i>
                                        </button>

                                    </td>
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
        <script>
            $(document).ready(function() {
                $('.translated-text').on('input', function() {
                    let index = $(this).data('index');
                    let display = $(this).val() === '';
                    console.log(display);
                    $(`.update-translation[data-index="${index}"]`).toggleClass('d-none', display);
                    $(`.translate-string[data-index="${index}"]`).toggleClass('d-none', !display);
                });


                $('.update-translation, .translate-string').on('click', function() {
                    $(this).addClass('disabled');
                    let index = $(this).data('index');


                    let translatedText = $(`.translated-text[data-index="${index}"]`);
                    var formData = {
                        '_token': '{{ csrf_token() }}',
                        'locale': "{{ $language->locale }}",
                        'language_id': "{{ $language->id }}",
                        'app_string_id': translatedText.data('stringid'),
                        'text': translatedText.data('text'),
                        'id': translatedText.data('translationid'),
                        'translated_text': translatedText.val(),
                    };

                    $.ajax({
                        url: "{{ route('language.update-translation') }}",
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json',
                        data: JSON.stringify(formData),
                        success: function(res) {
                            if (res.success) {
                                translatedText.val(res.data.translated_text);
                                translatedText.data('translationid', res.data.id);

                            }
                            new Noty({
                                text: res.message,
                                type: res.success ? 'success' : 'error',
                            }).show();
                            $('.update-translation, .translate-string').removeClass('disabled');
                        },
                        error: function(error) {
                            new Noty({
                                text: error.message,
                                type: 'error'
                            }).show();
                            // Handle error
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
