<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fruit;
use App\Models\Invoice;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        $fruits = Fruit::all();
        return view('invoices.index', ['fruits' => $fruits, 'invoice' => $invoices]);
    }
}
