<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderTableMenuItems extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_table_menu_items';
    protected $dates = ['deleted_at'];
}
