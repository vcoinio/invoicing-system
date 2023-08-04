<x-app-layout>
    <h1> This page show the invoices </h1>
    <li class='list-categories'>
        <table>
            <thead>
                <tr>
                    <th>Invoice ID</th>
                    <th>Customer Name</th>
                    <th>Fruits</th>
                    <th>Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
                <a href="invoices/create" class="create-button" role="button">Create new invoice</a>
                @foreach ($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->customer->Customer_Name }}</td>
                        <td>
                            @if ($invoice->fruits->isEmpty())
                            No fruits associated.
                            @else
                                <ul>
                                    @foreach ($invoice->fruits as $fruit)
                                        <li>{{ $fruit->FruitName }} (Quantity: {{ $fruit->pivot->quantity }})</li>
                                    @endforeach
                                </ul>
                            @endif            
                        </td>
                        <td>
                            <a href="{{ route('invoices.edit', ['invoice' => $invoice->id]) }}">  (Details)</a>
                            <form method="POST" action="{{ route('invoices.delete', ['invoice' => $invoice->id]) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </li>
</x-app-layout>