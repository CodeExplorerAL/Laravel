<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
// 21. 關聯
class House extends Model
{
    use HasFactory;

    protected $table = "House";
    protected $primaryKey = "hid";

    protected $keyType = "int";

    public function own(): HasMany
    {
        return $this->hasMany(
            Phone::class,
            'hid',      // Phone.hid
            'hid'       // House.hid
        );
    }

    public function bills(): HasManyThrough     // 此種沒有 save()，不可用他來儲存資料到 Phone
    {
        return $this->hasManyThrough(
            Bill::class,        // 目標模型 Bill
            Phone::class,       // 經過模型 Phone
            'hid',              // Phone 中的外鍵 (指向 House 的主鍵)
            'tel',             // Bill 中的外鍵 (指向 Phone 的主鍵)
            'hid',              // House 中的主鍵 (作為關聯起點)
            'tel'         // Phone 中的主鍵 (作為關聯中介)
        );
    }
}
