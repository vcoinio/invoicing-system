<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function InvoiceIndex()
    {
        return view('invoices.InvoiceIndex');
    }
}
