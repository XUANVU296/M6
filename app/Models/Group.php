<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = [
        'name',
        'delete_at',
    ];
    public function users() {
        $this->hasMany(User::class, 'group_id', 'id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'group_roles', 'group_id', 'role_id');
    }
}
