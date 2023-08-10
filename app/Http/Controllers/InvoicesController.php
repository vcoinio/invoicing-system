<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fruit;
use App\Models\Invoice;
use App\Models\Customer;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('fruits')->orderByDesc('id')->get();
        return view('invoices.index', ['invoices' => $invoices]);
    }

    public function edit($invoiceID)
    {
        $invoice = Invoice::findOrFail($invoiceID);
        return view('invoices.edit', ['invoice' => $invoice]);
    }

    public function delete($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $invoice->delete();
        return redirect()->route('invoices.index');
    }
    public function fruitDelete(Invoice $invoice, Fruit $fruit)
    {
        $invoice->fruits()->detach($fruit->id);
        return redirect()->back()->with('success');
    }
    public function create()
    {
        $fruits = Fruit::all();
        return view('invoices.create', ['fruits' => $fruits]);
    }

    public function select()
    {
        $fruits = Fruit::all();
        return view('invoices.select', ['fruits' => $fruits]);
    }
    public function store(Request $request)
    {
        $customerName = $request->input('customer_name');
        $customer = Customer::where('Customer_Name', $customerName)->first();

        if (!$customer) {
            $customer = Customer::create([
                'Customer_Name' => $request->input('customer_name')
            ]);
            $customer->save();}

        $invoice = Invoice::create([
            'customerID'=>$customer->id,
        ]);
        $invoice->save(); 

        $selectedFruitIds = $request->input('fruit_ids',[]);

        foreach ($selectedFruitIds as $fruitId) {
            $fruit = Fruit::find($fruitId);
    
            if ($fruit) {
                $invoice->fruits()->attach($fruit);
            }
        }
        return redirect()->route('invoices.index')->with('success');
    }
    
}
