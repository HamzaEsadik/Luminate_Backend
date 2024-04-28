<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
