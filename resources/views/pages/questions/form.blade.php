<div class="row g-2">

    <x-input col="6" name="relation_id" title="Relation" type="select" class="select" :required="true">
        @foreach ($relations as $relation)
            <option value="{{ $relation->id }}"
                {{ isset($question) && $relation->id == $question->relation_id ? 'selected' : '' }}>
                {{ $relation->title }}
            </option>
        @endforeach
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
