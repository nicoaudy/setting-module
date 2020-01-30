<?php

namespace Modules\Setting\Datatables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Modules\Setting\Entities\UserType;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserTypeDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->of($query)
            ->addColumn('action', function ($row) {
                $edit = '<a href="' . route('setting.user-type.edit', $row->id) . '" class=\'btn btn-outline-primary\' style="margin-left: 5px;"><i class="fa fa-pencil-alt"></i></a>';
                $delete = '<a data-href="' . route('setting.user-type.destroy', $row->id) . '" class=\'btn btn-outline-danger\' data-toggle="modal" data-target="#confirm-delete-modal" style="margin-left: 5px;"><i class="fa fa-trash"></i></a>';
                return (userCan('edit user type') ? $edit : '') . (userCan('delete user type') ? $delete : '');
            });
    }

    public function query(UserType $model)
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
            Column::make('name'),
            Column::make('description'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'UserType_' . date('YmdHis');
    }
}
