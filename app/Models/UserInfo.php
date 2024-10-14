<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// 11. ELOQUENT
class UserInfo extends Model
{
    use HasFactory;

    protected $table = "UserInfo";
    protected $primaryKey = "uid";
    protected $keyType = "string";

    public $timestamps  = false;
}
