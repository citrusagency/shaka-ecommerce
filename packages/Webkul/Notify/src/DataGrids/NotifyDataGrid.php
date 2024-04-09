<?php

namespace Webkul\Notify\DataGrids;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class NotifyDataGrid extends DataGrid
{

    /**
     * Index.
     *
     * @var string
     */
    protected $index = 'id';

    /**
     * Sort order.
     *
     * @var string
     */
    protected $sortOrder = 'desc';

    /**
     * Prepare query builder.
     *
     * @return void
     */
    public function prepareQueryBuilder() : void
    {
        $tablePrefix = DB::getTablePrefix();

        $queryBuilder = DB::table('notify')
            ->join('product_flat', 'product_flat.product_id', 'notify.product_id')
            ->select(
                'notify.id',
                'notify.customer_email',
                'product_flat.name as product_name',
            );

        $this->setQueryBuilder($queryBuilder);
    }

    /**
     * Prepare columns.
     *
     * @return void
     */
    public function addColumns():void
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('notify::app.admin.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'product_name',
            'label'      => trans('notify::app.admin.product_name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => false,
        ]);

        $this->addColumn([
            'index'      => 'customer_email',
            'label'      => trans('notify::app.admin.customer_email'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => false,
        ]);

        $this->addColumn([
            'index'      => 'send_notification',
            'label'      => trans('notify::app.admin.send_notification'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => false,
            'closure'    => function ($value) {
                return '<a href="" class="secondary-button" data-product-id="' . $value->id . '" onclick="sendQuickMail(' . $value->id . ')">' . trans('notify::app.admin.send_notification') . '</a>';
            },
        ]);
    }
}