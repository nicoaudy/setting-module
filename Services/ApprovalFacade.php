<?php

namespace Modules\Setting\Services;

use Illuminate\Support\Facades\Facade;

class ApprovalFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'approval';
    }
}
