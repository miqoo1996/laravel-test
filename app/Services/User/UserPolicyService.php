<?php

namespace App\Services\User;

use App\Models\Policies;
use App\Models\PoliciesUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserPolicyService
{
    /**
     * @return Builder[]|Collection
     */
    public function policiesWithoutUsers(): Collection|array
    {
        return Policies::query()->whereDoesntHave('users')->get();
    }

    public function syncPolicies(int $userId, int $policyId): void
    {
        PoliciesUser::query()->create(['user_id' => $userId, 'policy_id' => $policyId]);
    }

    public function userPolicy(int $userId, int $policyId): Policies|Model|null
    {
        return Policies::query()->where('id', $policyId)->whereHas('users', function (Builder $builder) use ($userId) {
            $builder->where('user_id', $userId);
        })->first();
    }

    public function userWithPolicies(int $userId): Model|Builder|null
    {
        return User::query()->where('id', $userId)->with('policies')->first();
    }

    public function removePolicy(int $userId, int $policyId): bool
    {
        return PoliciesUser::query()->where('user_id', $userId)->where('policy_id', $policyId)->delete();
    }

    public function detachPolicies(int $userId): void
    {
        User::query()->where('id', $userId)->first()->policies()->detach();
    }

}
