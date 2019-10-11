<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    const ROLE_ADMIN = 1;
    const ROLE_MANAGER = 2;
    const ROLE_USER = 3;

    const ROLE_ADMIN_NAME = "admin";
    const ROLE_MANAGER_NAME = "manager";
    const ROLE_USER_NAME = "user";

    protected $table = 'roles';

    public $timestamps = true;

    public function users()
    {
      return $this->hasMany(User::class, 'role_id');
    }
}
