<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMenuRightsModel extends Model
{
    use HasFactory;
    protected $table = 'user_menu_rights';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
