<?php

namespace Modules\Setting\Datatables;

use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->of($query)
            ->editColumn('active', function ($row) {
                return $row->active ? 'Active' : 'Not Active';
            })
            ->addColumn('action', function ($row) {
                $edit = '<a href="' . route('setting.users.edit', $row->id) . '" class=\'btn btn-outline-primary\' style="margin-left: 5px;"><i class="fa fa-pencil-alt"></i></a>';
                $delete = '<a data-href="' . route('setting.users.destroy', $row->id) . '" class=\'btn btn-outline-danger\' data-toggle="modal" data-target="#confirm-delete-modal" style="margin-left: 5px;"><i class="fa fa-trash"></i></a>';
                return (userCan('edit user') ? $edit : '') . (userCan('delete user') ? $delete : '');
            });
    }

    public function query(User $model)
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
            Column::make('username'),
            Column::make('email'),
            Column::make('active'),
            Column::make('last_login'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
