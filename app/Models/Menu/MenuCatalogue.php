<?php

namespace App\Models\Menu;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Menu\MenuCategory;
use App\Models\FoodType;
use App\Models\Outlet;

class MenuCatalogue extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menu_catalogues';

    protected $dates = ['deleted_at'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getMenuCategory()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_categories_id', 'id');
    }
    public function getFoodType()
    {
        return $this->belongsTo(FoodType::class, 'food_type', 'id');
    }

    public function getOutlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id', 'id');
    }
}
