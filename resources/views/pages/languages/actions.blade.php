

@canany(['languages-edit','languages-delete'])

    <x-actions :deleteRoute="route('language.destroy', $row->id)" canDelete="languages-delete">
        @can('languages-edit')
        <button class="dropdown-item edit-btn" data-id="{{ $row->id ?? '' }}">
            <i class="ph-note-pencil  me-2"></i> Edit
        </button>
        @endcan
    </x-actions>
@endcanany
