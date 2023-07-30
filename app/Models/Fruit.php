<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    use HasFactory;
    protected $table = 'fruits';
    protected $primaryKey = 'id';
    protected $fillable = ['Categoryid', 'FruitName', 'Unit', 'Price'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
