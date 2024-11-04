<x-modal id="modal_default" title="Add Language" :route="route('language.store')">
    <x-input name="name" :value="$language->name ?? null" :required="true" />
    <x-input name="locale" :value="$language->locale ?? null" :required="true" />
    <x-input name="status" type="select" :required="true">
        <option value="1" @selected(isset($language->status) && $language->status == 1)>Active</option>
        <option value="0" @selected(isset($language->status) && $language->status == 0)>InActive</option>
    </x-input>
</x-modal>
