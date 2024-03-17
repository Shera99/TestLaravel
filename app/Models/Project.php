<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'uuid',
        'description',
        'status',
        'creator_id'
    ];

    public function members(): HasMany
    {
        return $this->hasMany(ProjectUserRole::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function isMember(User $user): bool
    {
        return $this->members()->where('user_id', $user->id)->exists();
    }

    public function getRole(User $user)
    {
        return $this->members()->where('user_id', $user->id)->value('role');
    }

    public function pluckMembers()
    {
        return $this->members()->pluck('user_id');
    }
}
