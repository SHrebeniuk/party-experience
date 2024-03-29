<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Role;
use App\Team;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    const USER_TEAM_OWNER = 0;
    const USER_TEAM_OFFICER = 1;
    const USER_TEAM_SOLDER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'email', 'description', 'password', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $with = [ "role", "team" ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function team()
    {
      return $this->belongsTo(Team::class, 'team_id');
    }

    public function teams()
    {
      return $this->belongsToMany(Team::class, 'team_users', 'user_id', 'team_id');
    }
}
