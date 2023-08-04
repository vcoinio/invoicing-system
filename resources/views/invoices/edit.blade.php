<x-app-layout>
    <h1> This page show the invoices </h1>
    <li class='list-categories'>
        <table>
            <p>Customer Name</p>
            <thead>
                <th>Customer Name</th>
                <td>{{ $invoice->customer->Customer_Name }}</td>
                <tr>
                    <th>FruitCategory</th>
                    <th>Fruit Name</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>        </th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($invoice->fruits as $fruit)
                    <tr>
                        <td>{{ $fruit->FruitCategory }}</td>
                        <td>{{ $fruit->FruitName }}</td>
                        <td>{{ $fruit->Unit }}</td>
                        <td>{{ $fruit->Price }}</td>
                        <td>{{ $fruit->pivot->quantity }}</td>
                        <td>calculation</td>
                        <td><form method="POST" action="{{ route('invoices.delete', ['invoice' => $invoice->id]) }}" style="display: inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </li>
</x-app-layout>