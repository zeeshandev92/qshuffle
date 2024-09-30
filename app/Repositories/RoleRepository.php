<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    /**
     * Roles List.
     */
    public function list(): array|Collection
    {
        return $this->model->get();
    }

    /**
     * Web Roles List.
     */
    public function webList(): Collection
    {
        return $this->model->where('guard_name', 'web')->whereNot('name', 'Super Admin')->get();
    }

    /**
     * API Roles List.
     */
    public function apiList(): Collection
    {
        return $this->model->where('guard_name', 'api')->get();
    }

    /**
     * Store or Update role.
     */
    public function storeOrUpdate(string $name, array $permissions, int $id = null, string $guard = 'web'): Role
    {
        $role = Role::updateOrCreate(
            ['id' => $id],
            ['name' => $name, 'guard_name' => $guard]
        );
        $role->syncPermissions($permissions);
        return $role;
    }

    /**
     * FInd role by id.
     */
    public function findById(int $id): array|Collection|Role|null
    {
        return $this->model->find($id);
    }
}
