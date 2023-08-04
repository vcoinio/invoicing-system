<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'Customer_Name' => 'required|max:255',
        ]);
        $customer = Customer::create([
            'Customer_Name' => $request->input('Customer_Name')
        ]);
        $customer->save();

        return 'success';
    }
}
