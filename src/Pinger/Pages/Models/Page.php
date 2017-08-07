<?php

namespace Pinger\Pages\Models;

use App\Model;

class Page extends Model
{
    public function menuTop()
    {
        return $this->where('in_menu', 1)->get();
    }

    public function getByAlias(string $alias)
    {
        return $this->where('alias', $alias)->first();
    }
}
