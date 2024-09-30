@canany(['roles-edit', 'roles-delete', 'roles-show'])
    <x-actions :showRoute="route('roles.show', $id)" canShow="roles-show" :editRoute="route('roles.edit', $id)" canEdit="roles-edit" :deleteRoute="route('roles.destroy', $id)"
        canDelete="roles-delete" />
@endcan
