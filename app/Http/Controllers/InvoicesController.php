<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Fruit;
use App\Models\Invoice;
use App\Models\Customer;
use Laravel\Prompts\Prompt;

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
        $fruits = Fruit::all();
        return view('invoices.edit', ['invoice' => $invoice,'fruits'=>$fruits],compact('invoice'));
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
        // $validator = Validator::make($request->all(), [
        //     'customer_name' => 'required|string',
        //     'fruit_details' => 'required|array|min:1',
        //     // 'fruit_details.*.fruit_id' => 'required|exists:fruits,id',
        //     // 'fruit_details.*.quantity' => 'required|integer|min:1',
        // ]);

        // if ($validator->fails()) {
        //     echo "back-end validator Fail";
        // }

        $customerName = $request->input('customer_name');
        $customer = Customer::where('Customer_Name', $customerName)->first();

        if (!$customer) {
            $customer = Customer::create([
                'Customer_Name' => $request->input('customer_name')
            ]);
        }

        $invoice = Invoice::create([
            'customerID' => $customer->id,
        ]);

        $fruitDetails = json_decode($request->input('fruit_details'), true);
        foreach ($fruitDetails as $detail) {
            $fruit_id = $detail['fruit_id'];
            $quantity = $detail['quantity'];

            $fruit = Fruit::find($fruit_id);

            if ($fruit) {
                $invoice->fruits()->attach($fruit, ['quantity' => $quantity]);
            }
        }

        return redirect('invoices')->with('success', 'Invoice created successfully.');
    }
    public function updateFruit(Request $request){

        $fruitDetails = json_decode($request->input('fruit_details'), true);
        foreach ($fruitDetails as $detail) {
            $fruit_id = $detail['fruit_id'];
            $quantity = $detail['quantity'];
            $invoice = Invoice::find($invoiceID);
            $fruit = Fruit::find($fruit_id);

            if ($fruit) {
                $invoice->fruits()->attach($fruit, ['quantity' => $quantity]);
            }
        }
    }
}
