<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class UnitMasterModel extends Model
{
    use HasFactory;

    protected $table = 'unit_master';    
    protected $guarded = ['id', 'created_at', 'updated_at'];
}