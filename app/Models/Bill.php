<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 21. 關聯
class Bill extends Model
{
    use HasFactory;
    protected $table = "Bill";
    protected $primaryKey = "tel";

    protected $keyType = "int";
}
