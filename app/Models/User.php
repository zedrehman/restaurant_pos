<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Outlet;
use App\Models\City;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_no',
        'user_type',
        'role_id',
        'outlet_id',
        'address',
        'city_id',
        'postal_code',
        'active'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getOutlet()
    {
        return $this->belongsTo(Outlet::class, 'outlet_id', 'id');
    }

    public function getCity()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function getRole()
    {
        return $this->belongsTo(UserRoleModel::class, 'role_id', 'id');
    }

}
