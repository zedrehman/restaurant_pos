<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseTypeModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'expense_type';
    
    protected $guarded = ['id', 'created_at', 'updated_at'];
}