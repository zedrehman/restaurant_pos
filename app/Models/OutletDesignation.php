<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletDesignation extends Model
{
    use HasFactory;
    protected $table = 'outlets_designation';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
