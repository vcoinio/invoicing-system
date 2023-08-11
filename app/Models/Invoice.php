<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $fillable = [
        'customerID'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID');
    }
    public function fruits()
    {
        return $this->belongsToMany(Fruit::class)->withPivot('quantity');
    }
}
