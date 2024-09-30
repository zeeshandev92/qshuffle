<x-modal id="modal_default" title="Add Record" :route="route('relations.store')">
    <x-input name="title" :value="$category->title ?? null" :required="true" />
    <x-input name="status" type="select" :required="true">
        <option value="1" @selected(isset($category->status) && $category->status == 1)>Active</option>
        <option value="0" @selected(isset($category->status) && $category->status == 0)>InActive</option>
    </x-input>
</x-modal>
