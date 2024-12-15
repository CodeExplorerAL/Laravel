<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// 21. 關聯
class Phone extends Model
{
    use HasFactory;
    protected $table = "Phone";
    protected $primaryKey = "tel";

    protected $keyType = "int";

    public $timestamps = false;
    public function house(): BelongsTo
    {
        return $this->belongsTo(
            House::class,
            'hid',        // Phone.hid
            'hid'           // House.hid
        );
    }
}
