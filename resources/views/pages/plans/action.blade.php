@canany(['plans-edit', 'plans-delete'])
    <x-actions :deleteRoute="route('plans.destroy', $row->id)" :editRoute="route('plans.edit', $row->id)" canEdit="plans-edit" canDelete="plans-delete">
    </x-actions>
@endcanany
