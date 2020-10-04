<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserProduct extends Model
{
    use HasFactory;
    use Uuids;

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'name', 'created', 'modified', 'product_id', 'user_id'
    ];

    static function tableName(){
        return 'user_products';
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
