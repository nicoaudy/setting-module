<?php

namespace Modules\Setting\Datatables;

use Modules\Setting\Entities\Calendar;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CalendarDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->of($query)
            ->editColumn('user_type_id', function ($row) {
                return $row->userType->name ?? null;
            })
            ->editColumn('is_working_day', function ($row) {
                return $row->is_working_day ? 'Working Day' : 'Off Day';
            })
            ->addColumn('action', function ($row) {
                $edit = '<a href="' . route('setting.calendar.edit', $row->id) . '" class=\'btn btn-outline-primary\' style="margin-left: 5px;"><i class="fa fa-pencil-alt"></i></a>';
                $delete = '<a data-href="' . route('setting.calendar.destroy', $row->id) . '" class=\'btn btn-outline-danger\' data-toggle="modal" data-target="#confirm-delete-modal" style="margin-left: 5px;"><i class="fa fa-trash"></i></a>';
                return (userCan('edit calendar') ? $edit : '') . (userCan('delete calendar') ? $delete : '');
            });
    }

    public function query(Calendar $model)
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
            Column::make('user_type_id')->title('User Type'),
            Column::make('date'),
            Column::make('days_of_week'),
            Column::make('year'),
            Column::make('month_name'),
            Column::make('is_working_day'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'Calendar' . date('YmdHis');
    }
}
