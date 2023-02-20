<?php

namespace App\DataTables;

use App\Models\Activity;
use App\Models\Note;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ActivitiesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                return '<div>
                            <a href=""><button class="btn btn-sm btn-warning"><span class="zdmi zdmi-edit"></span></button></a>
                            <a href=""><button class="btn btn-sm btn-warning"><i class="zmdi zmdi-hc-fw"></i></button></a>
                            </div>';
            })
            ->editColumn('user_id', function ($query){
                return $query->user->name ?? 'N/A';
            })
            ->editColumn('created_at', function ($query) {
                return date('l M d, Y', strtotime($query->created_at));
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Activity $model
     * @return QueryBuilder
     */
    public function query(Activity $model): QueryBuilder
    {
        return $model->newQuery()->orderBy('id', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('dataTable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('title'),
            Column::make('user_id')->title('Created By'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Notes_' . date('YmdHis');
    }
}
