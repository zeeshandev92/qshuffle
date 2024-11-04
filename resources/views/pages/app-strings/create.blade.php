<x-modal id="modal_default" title="Add String" :route="route('app-strings.store')">
    <x-input name="key" :value="$string->key ?? null" :required="true" />
    <x-input name="text" type="textarea" :value="$string->text ?? null" :required="true" />
</x-modal>
