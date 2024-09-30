@canany(['questions-edit', 'questions-delete'])
    <x-actions :deleteRoute="route('questions.destroy', $row->id)" :editRoute="route('questions.edit', $row->id)" canEdit="questions-edit" canDelete="questions-delete">
    </x-actions>
@endcanany
