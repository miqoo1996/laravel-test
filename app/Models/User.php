<?php

namespace App\Models;

 use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * @param Builder $builder
     * @param string $role
     * @return Builder
     */
    public function scopeCheckRole(Builder $builder, string $role) : Builder
    {
        return $builder->whereHas('roles', function (Builder $builder) use ($role) {
            return $builder->where('name', $role);
        });
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
       return $this->belongsToMany(Role::class,'role_users');
    }

    /**
     * @return BelongsToMany
     */
    public function policies(): BelongsToMany
    {
        return $this->belongsToMany(Policies::class,'policies_users','user_id','policy_id');
    }
}
