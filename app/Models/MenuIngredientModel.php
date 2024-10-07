<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuIngredientModel extends Model
{
    use HasFactory;
    protected $table = 'menu_catalogues_ingredient';
    protected $guarded = ['id'];
}
