<?php

namespace Modules\Setting\Entities;

use Modules\HR\Entities\Employee;
use Modules\HR\Entities\Division;
use Modules\HR\Entities\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workflow extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function approver()
    {
        return $this->belongsTo(Employee::class, 'approver_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
