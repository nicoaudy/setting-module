<?php

namespace Modules\Setting\Services;

class Approval
{
    public static function action($modelDefault, $modelApproval, $params, $check_default, $description = null)
    {
        dd('hello fellow friends');
        $default = $modelDefault::withoutGlobalScopes()->find($params);

        # 1. GET id current approver
        $curr = $modelApproval::withoutGlobalScopes()->where($check_default, $default->id)->where('employee_id', $default->approver_to_go)->whereNull('date')->orderBy('id', 'asc')->first();

        # 2. GET next approver
        $next = $modelApproval::withoutGlobalScope('owned')->where($check_default, $default->id)->where('id', '>', $curr->id)->orderBy('id', 'asc')->first();

        # 3. GET last sequence
        $last = $modelApproval::withoutGlobalScope('owned')->where($check_default, $default->id)->orderBy('id', 'desc')->first();

        # 4. Save record
        $data = $default;
        $data->latest_approver = auth()->user()->employee->id;

        if ($last->id == $curr->id) {
            $data->approver_to_go = null;
            $data->status = $this->approved;

            # Init
            $recepients     = $modelApproval::where($check_default, $default->id)->get();
            $code_number    = $default->code_number;
            $message        = 'This document ' . $code_number . ' has been approved.';
        } else {
            $data->approver_to_go = $next->employee_id ? $next->employee_id : null;
            $data->role_approval = $next->role ? $next->role : null;
        }

        $data->save();

        $approval = $modelApproval::find($curr->id);
        $approval->is_approved = true;
        $approval->date = now()->format('Y-m-d');
        $approval->employee_id = auth()->user()->employee->id;
        $approval->description = $description;
        $approval->save();

        return;
    }
}
