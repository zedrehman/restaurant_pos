<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Brand;


class Outlet extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'outlets';

    protected $dates = ['deleted_at'];
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getBrand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}
