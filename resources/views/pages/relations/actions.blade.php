@canany(['relations-edit', 'relations-delete'])
    <x-actions :deleteRoute="route('relations.destroy', $row->id)" :showRoute="route('relations.show', $row->id)" canShow="relations-edit" canDelete="relations-delete">
        @can('relations-edit')
            <button class="dropdown-item edit-btn" data-id="{{ $row->id ?? '' }}">
                <i class="ph-note-pencil  me-2"></i> Edit
            </button>
        @endcan

    </x-actions>
@endcanany
