<?php

namespace Webkul\Notify\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Notify\Contracts\Notify as NotifyContract;

class Notify extends Model implements NotifyContract
{
    protected $table = 'notify';

    protected $fillable = [
        'product_id',
        'customer_email'
    ];
}