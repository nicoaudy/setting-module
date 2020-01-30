<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calendar extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }
}
