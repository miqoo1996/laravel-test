<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Policies extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'plan_reference',
        'first_name',
        'last_name',
        'investment_house',
        'last_operation'
    ];


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'policies_users','policy_id','user_id');
    }
}
