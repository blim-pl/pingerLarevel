<?php

namespace CMS\Role\Models;

use CMS\User\Models\User;
use App\Model;

class Role extends Model
{
    public function users()
    {

        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
