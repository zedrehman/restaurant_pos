<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutletMenu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'outlets_menu';

    protected $dates = ['deleted_at'];
    
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
