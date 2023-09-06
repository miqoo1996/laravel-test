<?php

namespace App\Services\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserService
{
    public function hasRole(int $id, string $role): bool
    {
        return User::query()->where('id', $id)->checkRole($role)->exists();
    }

    public function assignRole(User $user, string $role): bool
    {
        $roleByName = $this->getRoleByName($role);

        if ($roleByName) {
            $user->roles()->attach($roleByName->id, ['created_at' => now(), 'updated_at' => now()]);

            return true;
        }

        return false;
    }

    public function getRoleByName(string $role): Role|Model|null
    {
        return Role::query()->where('name', $role)->first();
    }

    public function createUser(string $role, array $attributes, bool $sendInvitation = false): User|Model
    {
        /**
         * @var User $user
         */
        $user = User::query()->create($attributes);

        $this->assignRole($user, $role);

        if ($sendInvitation) {
            try {
                $user->sendEmailVerificationNotification();
            } catch (\Throwable) {
               // Oops! Couldn't send email...
            }
        }

        return $user;
    }

    public function destroy(int|array $id, array $unlinkingRelations = [], bool $force = false): void
    {
        if ($force) {
            User::forceDeleted($id);

            return;
        }

        if (empty($unlinkingRelations)) {
            User::destroy($id);

            return;
        }

        $user = User::query()->find($id);

        foreach ($unlinkingRelations as $unlinkingRelation) {
            $user->$unlinkingRelation()->delete();
        }

        $user->delete();
    }

    public function staffUsers(): Collection|array
    {
        return User::query()->orderBy('created_at', 'desc')->whereHas('roles', function ($q) {
            $q->where('name', Role::STAFF);
        })->get();
    }
}
