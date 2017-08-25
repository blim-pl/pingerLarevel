<?php

namespace CMS\User\Models;

use CMS\Role\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Pinger\Services\Models\Service;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function servicesCnt()
    {
        return $this->services()->count();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withTimestamps();
    }

    /**
     * Update user roles
     *
     * @param array|null $data
     * @return bool
     */
    public function saveRoles(array $data = null)
    {
        if (is_numeric($this->roles()->detach())) {

            $result = true;

            if ($data) {
                foreach ($data as $role) {
                    if ($this->roles()->attach($role)) {
                        $result = false;
                        break;
                    }
                }
            }
        } else {
            $result = false;
        }

        return $result;
    }

    /**
     * Get user available actions
     *
     * @return array
     */
    public function access()
    {
        $actions = [];

        $roles = $this->roles()->pluck('access');

        foreach($roles as $access){
            $accesses = explode(',', $access);

            array_map('trim', $accesses);

            $actions = array_merge($actions, $accesses);
        }

        return array_unique($actions);
    }

    /**
     * Check access to specify action
     *
     * @param string $action
     * @return bool
     */
    public function hasAccess(string $action)
    {
        return in_array($action, $this->access());
    }
}
