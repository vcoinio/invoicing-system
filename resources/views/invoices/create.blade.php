<x-app-layout>
    <h1> This page show the invoices </h1>
    <div class="customer-container">
        <form id="invoiceForm" action="{{ route('invoices.store') }}" method="post">
            @csrf
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>
            <button id="submitButton" class="create-button" type="button" onclick="submitForm()">Submit Invoice</button>
        </form>
        <div id="total-amount"><input type="text" placeholder="Total Amount" disabled>
            <button class="small-button" type="button" onclick="checkAmount()">Check Amount</button>
        </div>
        <button class="create-button" type="button" onclick="addRow()">Add Fruit</button>
    </div>

    <table id="invoiceTable" class="invoice-table">
        <thead>
            <tr class="table-header">
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
            <tr class="table-data">

            </tr>
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


        function checkAmount() {
            const tableBody = document.querySelector("#invoiceTable tbody");
            const total = document.querySelector("#total-amount input");
            let totalAmount = 0;
            const allrow = tableBody.querySelectorAll("tr");
            for (const row of allrow) {
                // const price = row.querySelector("td:nth-child(6) input");
                // const quantity = row.querySelector("td:nth-child(7) input");
                const amountCell = row.querySelector("td:nth-child(8) input");
                if (amountCell) {
                    // const amount = (quantity.value*price.value);
                    console.log("amount cell:", amountCell.value);
                    totalAmount = parseInt(totalAmount) + parseInt(amountCell.value);
                }
                //     // const amount = parseFloat(amountCell.name);
                // }
            }
            console.log("Total Amount:", totalAmount);
            total.value = totalAmount;
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
