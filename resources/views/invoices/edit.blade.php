<x-app-layout>
    <h1> This page show the invoices </h1>
    <li class='list-categories'>
        <div class="customer-container">
            <form id="invoiceForm" action="{{ route('invoices.store') }}" method="post">
                @csrf
                <label for="customer_name">Customer Name:</label>
                <button id="submitButton" class="create-button" type="button" onclick="submitForm()">Submit
                    Invoice</button>
            </form>
            <button class="create-button" type="button" onclick="addRow()">Add Fruit</button>
        </div>
        <table id="invoiceTable" class="invoice-table">
            <p>Customer Name: </p>
            <div>{{ $invoice->customer->Customer_Name }}</div>
            <script>
                function updateSums() {
                    var rows = document.querySelectorAll(".data-row");

                    rows.forEach(function(row) {
                        var cells = row.querySelectorAll(".value-cell");
                        var sum = 1;

                        cells.forEach(function(cell) {
                            sum *= parseFloat(cell.textContent);
                        });

                        row.querySelector(".mul-cell").textContent = sum;
                    });
                }
            </script>

            <thead>

                <tr>
                    <th>No#</th>
                    <th>Fruit ID</th>
                    <th>FruitCategory</th>
                    <th>Fruit Name</th>
                    <th>Unit</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                @endphp
                @foreach ($invoice->fruits as $fruit)
                    <tr class="data-row">
                        <td>{{ $count }}</td>
                        <td>{{ $fruit->id }}</td>
                        <td>{{ $fruit->FruitCategory }}</td>
                        <td>{{ $fruit->FruitName }}</td>
                        <td>{{ $fruit->Unit }}</td>
                        <td class="value-cell">{{ $fruit->Price }}</td>
                        <td class="value-cell">{{ $fruit->pivot->quantity }}</td>
                        <td class="mul-cell"></td>
                        <td>
                            <form method="POST"
                                action="{{ route('invoices.fruits.remove', ['invoice' => $invoice->id, 'fruit' => $fruit->id]) }}"
                                style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @php
                        $count++; // Increment the count
                    @endphp
                @endforeach
            </tbody>
        </table>
    </li>
    <script>
        updateSums();
        let rowCount = 0;
        const fruitsData = @json($fruits);
    </script>
    <script>
        function addRow() {
            rowCount++;
            const tableBody = document.getElementById('invoiceTable').getElementsByTagName('tbody')[0];
            const newRow = tableBody.insertRow();
            console.log("tbody: ", tableBody)

            const cell0 = newRow.insertCell(0);
            cell0.textContent = rowCount;

            const cell1 = newRow.insertCell(1);

            cell1.innerHTML = `
                <select id="selected-fruit" name="fruits[${rowCount}][id]" required>
                    <option value="">Select Fruit ID</option>
                    @foreach ($fruits as $fruit)
                        <option value="{{ $fruit->id }}">{{ $fruit->id }}</option>
                    @endforeach
                </select>`;
            const cell2 = newRow.insertCell(2);
            cell2.innerHTML =
                `<input type="text" placeholder="Fruit Name ${rowCount}" name="fruits[${rowCount}][FruitName]" disabled>`;

            const cell3 = newRow.insertCell(3);
            cell3.innerHTML =
                `<input type="text" placeholder="Fruit Category ${rowCount}" name="fruits[${rowCount}][FruitCategory]" readonly>`;

            const cell4 = newRow.insertCell(4);
            cell4.innerHTML =
                `<input type="text" placeholder="Unit ${rowCount}" name="fruits[${rowCount}][unit]" readonly>`;

            const cell5 = newRow.insertCell(5);
            cell5.innerHTML =
                `<input type="text" placeholder="Price ${rowCount}" name="fruits[${rowCount}][price]" readonly>`;

            const cell6 = newRow.insertCell(6);
            cell6.innerHTML =
                `<input type="text" placeholder="Quantity ${rowCount}" name="fruits[${rowCount}][quantity]" >`;

            const cell7 = newRow.insertCell(7);
            cell7.innerHTML =
                `<input type="text" placeholder="Amount ${rowCount}" name="fruits[${rowCount}][amount]" readonly>`;

            const cell8 = newRow.insertCell(8);
            cell8.innerHTML =
                `<div class="customer-container"><button class="small-button" type="button" onclick="checkRow(${rowCount})">Check Row</button></div>`;

        }

        function checkRow(rowCount) {
            const tableBody = document.querySelector("#invoiceTable tbody");
            const rowIndex = rowCount;
            console.log("Row index:", rowIndex);
            const newRow = tableBody.rows[rowIndex];
            const selected = newRow.querySelector("td:nth-child(2) select");
            console.log("Select element:", selected);

            if (!selected) {
                console.error("Select element not found.");
                return;
            }

            const fruitId = selected.value;

            // Make an AJAX request to fetch the fruit data
            fetch(`/fruits/getFruit/${fruitId}`)
                .then(response => response.json())
                .then(data => {
                    const fruitName = newRow.querySelector("td:nth-child(3) input");
                    const fruitCategory = newRow.querySelector("td:nth-child(4) input");
                    const unit = newRow.querySelector("td:nth-child(5) input");
                    const price = newRow.querySelector("td:nth-child(6) input");
                    const quantity = newRow.querySelector("td:nth-child(7) input");
                    const amount = newRow.querySelector("td:nth-child(8) input");

                    fruitName.value = data.FruitName;
                    fruitCategory.value = data.FruitCategory;
                    unit.value = data.Unit;
                    price.value = data.Price;
                    amount.value = (quantity.value * price.value);

                })
                .catch(error => {
                    console.error('Error fetching fruit data:', error);
                });

        }

        function submitForm() {
            const tableBody = document.querySelector("#invoiceTable tbody");
            const rows = tableBody.querySelectorAll('tr');
            console.log("row length:", rows.length);
            const selectElements = document.querySelectorAll(
                'select[name^="fruits["]');
            console.log("selected Element", selectElements);

            const fruitDetails = [];

            for (let i = 1; i < rows.length; i++) {
                const rowInd = rows[i];
                const quantityElement = rowInd.querySelector('td:nth-child(7) input');
                const selectedOption = selectElements[i - 1].options[selectElements[i - 1].selectedIndex];
                console.log("Selected Option", i, selectedOption);
                console.log("Quantity Element", i, quantityElement);
                if (quantityElement && selectedOption) {
                    const quantity = quantityElement.value;
                    const fruit_id = selectedOption.value;
                    fruitDetails.push({
                        fruit_id,
                        quantity
                    });

                }
            }
            console.log('fruit_details:', fruitDetails);
            const form = document.getElementById("invoiceForm");
            const formData = new FormData(form);
            formData.append('fruit_details', JSON.stringify(fruitDetails));


            fetch(form.action, {
                    method: 'POST',
                    body: formData
                }).then(response => response.json())
                .then(data => {
                    // Handle response if needed
                })
                .catch(error => {
                    // Handle error
                });

        }
    </script>
</x-app-layout>
