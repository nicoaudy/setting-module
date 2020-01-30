<?php

namespace Modules\Setting\Http\Controllers;

use Modules\HR\Entities\Employee;
use Modules\HR\Entities\Division;
use Modules\HR\Entities\Department;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

use Modules\Setting\Entities\Workflow;
use Modules\Setting\Datatables\WorkflowDatatable;
use Modules\Setting\Http\Requests\Workflow\CreateRequest;
use Modules\Setting\Http\Requests\Workflow\UpdateRequest;

class WorkflowController extends Controller
{
    public function index(WorkflowDatatable $datatable)
    {
        $this->hasPermissionTo('view workflow');
        return $datatable->render('setting::workflow.index');
    }

    public function create()
    {
        $this->hasPermissionTo('add workflow');
        return view('setting::workflow.create', [
            'roles'         => Role::all(),
            'employees'     => Employee::all(),
            'divisions'     => Division::all(),
            'departments'   => Department::all(),
            'apps'          => config('codyway.menu')
        ]);
    }

    public function store(CreateRequest $request)
    {
        if ($request['type'] == 0) {
            $request['role'] = null;
        } else {
            $request['approver_id'] = null;
        }

        Workflow::create($request->all());
        flash('Your data has been saved successfully')->success();
        return redirect()->route('setting.workflow.index');
    }

    public function show($id)
    {
        $row = Workflow::findOrFail($id);
        return response()->json($row);
    }

    public function edit($id)
    {
        $this->hasPermissionTo('edit workflow');
        return view('setting::workflow.edit', [
            'row'           => Workflow::findOrFail($id),
            'roles'         => Role::all(),
            'employees'     => Employee::all(),
            'divisions'     => Division::all(),
            'departments'   => Department::all(),
            'apps'          => config('codyway.menu')
        ]);
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->hasPermissionTo('edit workflow');

        if ($request['type'] == 0) {
            $request['role'] = null;
        } else {
            $request['approver_id'] = null;
        }

        $row = Workflow::findOrFail($id);
        $row->update($request->all());

        flash('Your data has been updated successfuly')->success();
        return redirect()->route('setting.workflow.index');
    }

    public function destroy($id)
    {
        $this->hasPermissionTo('delete workflow');

        Workflow::destroy($id);

        flash('Your data has been deleted successfuly')->error();
        return redirect()->route('setting.workflow.index');
    }

    public function getData()
    {
        $rows = Workflow::with(['employee', 'department'])
            ->orderBy('application_name', 'ASC')
            ->orderBy('sequence', 'ASC')
            ->orderBy('department_id', 'ASC')
            ->whereNull('deleted_at')
            ->get();

        return Datatables::of($rows)
            ->addColumn('approve', function ($row) {
                $name = $row->employee_id ? $row->employee->name : $row->role;
                return $name;
            })
            ->editColumn('department_id', function ($row) {
                return optional($row->department)->name;
            })
            ->addColumn('action', function ($row) {
                $edit = '<a href="' . route('setting.workflows.edit', $row->id) . '" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a>';
                $delete = '<a data-href="' . route('setting.workflows.destroy', $row->id) . '" style="margin-left: 10px; color: white !important;" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-modal"><i class="fa fa-trash"></i></a>';
                return (userCan('edit workflow') ? $edit : '') . (userCan('delete workflow') ? $delete : '');
            })
            ->rawColumns(['active', 'action'])
            ->addIndexColumn()->make(true);
    }

    public function getDepartmentDivision()
    {
        $set = request()->id;
        $rows = Department::withoutGlobalScopes()->where('division_id', $set)->get();

        switch (request()->type) :
            case 'departments':
                $return = '<option value="">--Please Select--</option>';
        foreach ($rows as $temp) {
            $return .= "<option value='$temp->id'>$temp->name</option>";
        }
        return $return;
        break;
        endswitch;
    }
}
