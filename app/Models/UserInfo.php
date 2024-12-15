<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\House;

// 11. ELOQUENT
class UserInfo extends Model
{
    use HasFactory;

    protected $table = "UserInfo";
    protected $primaryKey = "uid";
    protected $keyType = "string";

    public $timestamps  = false;

    // 21. 關聯
    public function lives(): BelongsToMany
    {
        return $this->belongsToMany(
            House::class,
            'Live',               // 多對多關連所衍生出來的資料表名稱
            'uid',      // Live.uid
            'hid'       // Live.hid
        );
    }
}
