<div class="row g-2">

    <x-input col="6" name="title" :required="true" :value="$plan->title ?? null" />

    <x-input col="6" name="charges" type="number" min="0" :required="true" :value="$plan->charges ?? null" />

    <x-input col=6 name="type" type="select" :required="true">
        <option value="annual" @selected(isset($plan->type) && $plan->type == 'annual')>Annual</option>
        <option value="monthly" @selected(isset($plan->type) && $plan->type == 'monthly')>Monthly</option>
    </x-input>

    <x-input col=6 name="status" type="select" :required="true">
        <option value="1" @selected(isset($category->status) && $plan->status == 1)>Active</option>
        <option value="0" @selected(isset($plan->status) && $plan->status == 0)>InActive</option>
    </x-input>


    <x-input col="12" type="textarea" name="description" :value="$plan->description ?? null" :required="true" />

</div>

<div class="form-repeater">
    @if (isset($plan->bullets) && count($plan->bullets) > 0)
        @foreach ($plan->bullets as $option)
            <div class="row repeat mt-2">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="bullets[]" placeholder="Add Bullets"
                        value="{{ $option }}">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary {{$loop->}} btn-add w-100">Add more</button>
                </div>
            </div>
        @endforeach
    @else
        <div class="row repeat mt-2">
            <div class="col-md-10">
                <input type="text" class="form-control" name="bullets[]" placeholder="Add Bullets">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary btn-add w-100">Add more</button>
            </div>
        </div>
    @endif
</div>


@push('scripts')
    <script>
        $(function() {


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
