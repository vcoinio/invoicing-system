<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    use HasFactory;
    protected $table = 'fruits';
    protected $primaryKey = 'id';
    protected $fillable = ['FruitCategory', 'FruitName', 'Unit', 'Price'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'fruit_invoice')->withPivot('quantity');
    }
}
