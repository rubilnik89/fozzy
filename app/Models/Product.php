<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'cpu', 'ram', 'disk_size'
    ];

    static function tableName(){
        return 'products';
    }

    public function userProducts()
    {
        return $this->hasMany(UserProduct::class);
    }
}
