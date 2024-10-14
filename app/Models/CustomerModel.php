<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Outlet;

class CustomerModel extends Model
{
    use HasFactory;
    protected $table = 'customer_master';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getOutlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id', 'id');
    }
}
