<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B2bClients extends Model
{
    use HasFactory;

   protected $connection = 'adkulan_dev';

    protected $table = 'b2b_clients';

    protected $primaryKey = 'GUID';

    protected $keyType = 'string';

    public $incrementing = false;

    public const UPDATED_AT = NULL;

}
