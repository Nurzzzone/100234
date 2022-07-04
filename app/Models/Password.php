<?php

namespace App\Models;

use App\Models\Outside\Outside;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Password extends Outside
{
    use HasFactory;

    protected $table = 'b2b_client_password';

    protected $primaryKey = null;

    protected $keyType = null;

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'password'
    ];
}
