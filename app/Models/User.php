<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasFactory;

    protected $connection = 'adkulan_dev';
    
    protected $table = '1c_users';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $attributes = [ 
        'menuroles' => 'user',
    ];

    /**
     * Пароль пользователя
     */
    public function password()
    {
        return $this->hasOne(Password::class, 'client', 'GUID');
    }

    /**
     * Получаем пароль для авторизации из таблицы b2b_client_password
     *
     * @return string
     */
    public function getAuthPassword(): string
    {
        return $this
            ->password()
            ->first()
            ->getAttribute('password');
    }
}
