<x-app-layout>
    <h1> This page show the invoices </h1>
        <table id="invoiceTable">
            <thead>
            <p>Customer Name</p>
            <form id="createCustomerForm" method="POST" action="{{ route('customers.store') }}">
                @csrf
                <div class="customer-container">
                <label for="customer_name">Customer Name:</label>
                <input type="text" id="customer_name" name="Customer_Name" required>
                <button class="create-button" type="submit" id="createButton"> Create customer</button>
                </div>
            </form>
                <tr>
                    <th>No#</th>
                    <th>Fruit ID</th>
                    <th>Fruit Name</th>
                    <th>Fruit Category</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <div class="button-container">
                    <button class="create-button" type="button" onclick="addRow()">Add Fruit</button>
                    <button class="create-button" type="button" onclick="checkRows()">Check Fruit</button>
                    <button class="create-button" type="button" onclick="submit()()">Submit</button>
                </div>
                {{-- @foreach ($invoice->fruits as $fruit) --}}
                <tr>

                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let rowCount = 0;
        const fruitsData = @json($fruits);
    
        function addRow() {
            rowCount++;
            const tableBody = document.getElementById('invoiceTable').getElementsByTagName('tbody')[0];
            const newRow = tableBody.insertRow();
    
            const cell0 = newRow.insertCell(0);
            cell0.textContent = rowCount;
    
            const cell1 = newRow.insertCell(1);
            // Add a dropdown for the user to select the fruit ID
            cell1.innerHTML = `<div class="customer-container">
                <select name="fruits[${rowCount}][id]" required>
                    <option value="">Select Fruit ID</option>
                    @foreach ($fruits as $fruit)
                        <option value="{{ $fruit->id }}">{{ $fruit->id }}</option>
                    @endforeach
                </select>
                <button class="create-button" type="button" onclick="checkRows(${rowCount})">Check Fruit</button>
                </div>`;
            const cell2 = newRow.insertCell(2);
            cell2.innerHTML = `<input type="text" placeholder="Fruit Name ${rowCount}" name="fruits[${rowCount}][FruitName]" disabled>`;
    
            const cell3 = newRow.insertCell(3);
            cell3.innerHTML = `<input type="text" placeholder="Fruit Category ${rowCount}" name="fruits[${rowCount}][FruitCategory]" readonly>`;
    
            const cell4 = newRow.insertCell(4);
            cell4.innerHTML = `<input type="text" placeholder="Unit ${rowCount}" name="fruits[${rowCount}][unit]" readonly>`;
    
            const cell5 = newRow.insertCell(5);
            cell5.innerHTML = `<input type="text" placeholder="Price ${rowCount}" name="fruits[${rowCount}][price]" readonly>`;
    
            const cell6 = newRow.insertCell(6);
            cell6.innerHTML = `<input type="text" placeholder="Quantity ${rowCount}" name="fruits[${rowCount}][quantity]" >`;
                
            const cell7 = newRow.insertCell(7);
            cell7.innerHTML = `<input type="text" placeholder="Amount ${rowCount}" name="fruits[${rowCount}][amount]" readonly>`;
    
            // Add more cells with placeholders for additional columns as needed
        }
    

        function checkRows() {
            const rowIndex = rowCount; // Use the global rowCount variable as the rowIndex
            console.log("Row index:", rowIndex);

            const select = document.querySelector(`#invoiceTable tbody tr:nth-child(${rowIndex}) td:nth-child(1) select`);
            console.log("Select element:", select);

            if (!select) {
                console.error("Select element not found.");
                return;
            }

            const fruitId = select.value;

            // Make an AJAX request to fetch the fruit data
            fetch(`/fruits/getFruit/${fruitId}`)
                .then(response => response.json())
                .then(data => {
                const fruitNameInput = document.querySelector(`#invoiceTable tbody tr:nth-child(${rowIndex}) td:nth-child(2) input`);
                const fruitCategoryInput = document.querySelector(`#invoiceTable tbody tr:nth-child(${rowIndex}) td:nth-child(3) input`);

                if (data && data.FruitName && data.FruitCategory) {
                    fruitNameInput.value = data.FruitName;
                    fruitCategoryInput.value = data.FruitCategory;
                } else {
                    fruitNameInput.value = 'Fruit data not found';
                    fruitCategoryInput.value = 'Fruit data not found';
                    console.error("Fruit data not found.");
                }
                })
                .catch(error => {
                console.error('Error fetching fruit data:', error);
                });
            }
    </script>
</x-app-layout>

