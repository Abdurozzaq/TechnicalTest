<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    use HasFactory;

    protected $table = "goods";

    protected $fillable = [
        'category_id',
        'goods_name',
        'goods_qty',
        'goods_description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
