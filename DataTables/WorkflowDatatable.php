<?php

namespace Modules\Setting\Datatables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Modules\Setting\Entities\Workflow;

use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WorkflowDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->of($query)
            ->editColumn('approver_id', function ($row) {
                return $row->approver_id ?
                    ($row->type ? 'Role' : 'Employee') . ' - ' . $row->approver->name :
                    ($row->type ? 'Role' : 'Employee') . ' - ' . $row->role;
            })
            ->editColumn('division_id', function ($row) {
                return $row->division->name ?? null;
            })
            ->editColumn('department_id', function ($row) {
                return $row->department->name ?? null;
            })
            ->addColumn('action', function ($row) {
                $edit = '<a href="' . route('setting.workflow.edit', $row->id) . '" class=\'btn btn-outline-primary\' style="margin-left: 5px;"><i class="fa fa-pencil-alt"></i></a>';
                $delete = '<a data-href="' . route('setting.workflow.destroy', $row->id) . '" class=\'btn btn-outline-danger\' data-toggle="modal" data-target="#confirm-delete-modal" style="margin-left: 5px;"><i class="fa fa-trash"></i></a>';
                return (userCan('edit workflow') ? $edit : '') . (userCan('delete workflow') ? $delete : '');
            });
    }

    public function query(Workflow $model)
    {
        return $model->all();
    }

    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->buttons([
                        ['extend' => 'print', 'className' => 'btn xs default mb-2', 'text' => '<i class="fa fa-print"></i>'],
                        ['extend' => 'excel', 'className' => 'btn xs default mb-2', 'text' => '<i class="fa fa-file-excel"></i>'],
                        ['extend' => 'reload', 'className' => 'btn xs default mb-2', 'text' => '<i class="fa fa-sync"></i>'],
                    ]);
    }

    protected function getColumns()
    {
        return [
            'id' => [
                'title' => '#',
                'orderable' => false,
                'searchable' => false,
                'render' => function () {
                    return 'function(data,type,fullData,meta){return meta.settings._iDisplayStart+meta.row+1;}';
                }
            ],
            Column::make('approver_id')->title('Approver'),
            Column::make('application_name'),
            Column::make('sequence'),
            Column::make('department_id')->title('Department'),
            Column::make('division_id')->title('Division'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'Workflow_' . date('YmdHis');
    }
}
