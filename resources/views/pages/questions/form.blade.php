<div class="row g-2">

    <x-input name="language" type="select" id="language" :required="true">
        <option value="en" @selected(isset($question->language) && $question->language == 'en')>English</option>
        <option value="ar" @selected(isset($question->language) && $question->language == 'ar')>Arabic</option>
    </x-input>

    <x-input col="6" name="relation_id" id="relation" title="Relation" type="select" class="select"
        :required="true">
        {{-- @foreach ($relations as $relation)
            <option value="{{ $relation->id }}"
                {{ isset($question) && $relation->id == $question->relation_id ? 'selected' : '' }}>
                {{ $relation->title }}
            </option>
        @endforeach --}}
    </x-input>

    <x-input col="6" name="gender" type="select" :required="true">
        <option value="male" @selected(isset($question->gender) && $question->gender == 'male')>Male</option>
        <option value="female" @selected(isset($question->gender) && $question->gender == 'female')>Female</option>
    </x-input>


    <x-input col="12" type="textarea" name="question" :value="$question->question ?? null" :required="true" />

</div>



<div class="row mt-2">
    <x-input col="3" name="type" title="Get it in a form of:" type="select" class="question-type"
        :required="true">
        <option value="free_text" @selected(!isset($question->type) || (isset($question->type) && $question->type == 'free_text'))>Free Text</option>
        <option value="multiple_choice" @selected(isset($question->type) && $question->type == 'multiple_choice')>Multiple Choice</option>
    </x-input>
</div>

<div class="form-repeater">
    @if (isset($question->choices) && count($question->choices) > 0 && $question->type == 'multiple_choice')
        @foreach ($question->choices as $option)
            <div class="row repeat mt-2">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="choices[]" placeholder="Add Option"
                        value="{{ $option }}">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary btn-add w-100">Add more</button>
                </div>
            </div>
        @endforeach
    @endif
</div>


@push('scripts')
    <script>
        $(function() {

            let relationsData = @json($relations);
            let selectedRelationId = "{{ $question->relation_id ?? '' }}";
            // console.log(selectedRelationId);

            // Function to update Select2 options based on selected language
            function updateOptions(language) {
                // Clear existing options
                $('#relation').empty();

                // Filter options based on the selected language
                const filteredOptions = relationsData.filter(item => item.language === language);

                const defaultOption = new Option('--select option--', '', false, false);
                $('#relation').append(defaultOption);

                // Append filtered options to the Select2 dropdown
                filteredOptions.forEach(option => {
                    const newOption = new Option(option.title, option.id, false, option.id ==
                        selectedRelationId);
                    // console.log(option.id, selectedRelationId, newOption, option.id == selectedRelationId);

                    $('#relation').append(newOption);
                });

                // $('#relation').select2();
                // if (selectedRelationId) {
                //     console.log(selectedRelationId);
                //     $('#relation').val(selectedRelationId).trigger('change');
                // } else {
                //     // $('#relation').val('').trigger('change');
                //     // $('#relation').trigger('change');
                // }

                // Reinitialize Select2 to ensure options are refreshed
                // $('#relation').select2();

                // Set the selected option in Select2 after a short delay
                setTimeout(() => {
                    $('#relation').val(selectedRelationId).trigger('change.select2');
                }, 50); // Short delay to ensure Select2 can process the selected value
            }

            // Initial load with default language
            updateOptions($('#language').val());

            // Event listener for language change
            $('#language').on('change', function() {
                const selectedLanguage = $(this).val();
                updateOptions(selectedLanguage);
            });

            var formHTML = `<div class="row repeat mt-2">
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="choices[]" placeholder="Add Option">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary btn-add w-100">Add more</button>
                    </div>
                </div>`;

            const checkType = (value) => {
                let $formRepeater = $(".form-repeater");
                $formRepeater.toggleClass('d-none', value === 'free_text');
                if (type === 'free_text') {
                    $formRepeater.html('');
                } else {
                    $formRepeater.html(formHTML); // Clear the HTML or use default content if needed
                }

            }

            let type = $('.question-type').val();
            // checkType(type);

            $(document).on('change', '.question-type', function() {
                type = $(this).val();
                checkType(type);
                // if (type == 'free-text') {
                //     $(".form-repeater").addClass('d-none');
                // } else {
                //     $(".form-repeater").removeClass('d-none');
                // }
            });

            $(document).on('click', '.btn-add', function(e) {
                e.preventDefault();
                var controlForm = $(this).closest('.form-repeater'),
                    currentEntry = $(this).parents('.repeat:first'),
                    newEntry = $(currentEntry.clone()).appendTo(controlForm);

                newEntry.find('input').val('');

                controlForm.find('.repeat:last .form-control').removeClass('is-valid');

                controlForm.find('.repeat:last .btn-add')
                    .removeClass('btn-add').addClass('btn-remove')
                    .removeClass('btn-success').addClass('btn-danger')
                    .text('Remove Option');
            }).on('click', '.btn-remove', function(e) {
                $(this).closest('.repeat').remove();
                return false;
            });


        });
    </script>
@endpush
