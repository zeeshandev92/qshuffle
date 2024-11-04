@canany(['appString-edit','appString-delete'])
<x-actions   :deleteRoute="route('app-strings.destroy', $row->id)" canDelete="appString-delete">
    @can('appString-edit')
    <button class="dropdown-item edit-btn" data-id="{{ $row->id ?? '' }}">
        <i class="ph-note-pencil  me-2"></i> Edit
    </button>
    @endcan
</x-actions>
@endcanany
