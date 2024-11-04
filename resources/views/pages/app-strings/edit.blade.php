<x-modal id="modal_update" title="Update String" :route="route('app-strings.update', $string->id)">
    @method('PATCH')
    <x-input name="key" :value="$string->key ?? null" :required="true" />
    <x-input name="text" type="textarea" :value="$string->text ?? null" :required="true" />
</x-modal>
