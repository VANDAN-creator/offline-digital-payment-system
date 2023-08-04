<!DOCTYPE html>
<html>
<head>
    <title>USER TRANSACTION HISTORY</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr.highlighted {
            background-color: #ffe7af;
        }

        tr:hover {
            background-color: #e5e5e5;
        }

        input[type="text"] {
            width: 100%;
            box-sizing: border-box;
            padding: 5px;
        }

        .btn-container {
            text-align: right;
            margin-top: 20px;
        }

        .btn-container button {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-container button:hover {
            background-color: #45a049;
        }

        .logout-button {
            float: right;
            background-color: #f44336;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #d32f2f;
        }
          
    </style>
    <script>
        function updateAmounts() {
            var rows = document.getElementsByTagName("tr");
        var data = [];

        for (var i = 1; i < rows.length; i++) {
            var grantedElement = rows[i].querySelector(".granted-amount");
            var availedElement = rows[i].querySelector(".availed-amount");
            var availInput = rows[i].querySelector(".avail-input");
            var stringInput = rows[i].querySelector(".string-input");
            var availingFor = rows[i].querySelector(":nth-child(2)").innerText;
            var grantedAmount = parseInt(grantedElement.innerText);
            var availedAmount = parseInt(availedElement.innerText);
            var availAmount = parseInt(availInput.value);
            var string_value = stringInput.value;

            if (!isNaN(availAmount)) {
            var newAvailedAmount = availedAmount + availAmount;

            if (newAvailedAmount <= grantedAmount) {
                availedElement.innerText = newAvailedAmount;
                data.push({
                availingFor: availingFor,
                grantedAmount: grantedAmount,
                availedAmount: newAvailedAmount,
                availAmount: availAmount,
                string_value: string_value // Include the string_value property
                });
            } else {
                alert("The availed amount exceeds the granted amount!");
            }
            }
        }

        // Send the data to the server using AJAX or fetch API
        if (data.length > 0) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_transactions.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                alert("Transaction history updated successfully!");
                } else {
                alert("Failed to update transaction history.");
                }
            }
            };
            xhr.send(JSON.stringify(data));
        }

        }

        function clearValues() {
            var stringInputs = document.getElementsByClassName("string-input");
            var availInputs = document.getElementsByClassName("avail-input");

            for (var i = 0; i < stringInputs.length; i++) {
                stringInputs[i].value = "";
                availInputs[i].value = "";
            }
        }

        function logout() {
            window.location.href = "vendor_logout.php";
        }
    </script>
</head>
<body>
    <div class="container">
        <button class="logout-button" onclick="logout()">Logout</button>
        <h1>USER TRANSACTION HISTORY</h1>
        <table>
        <tr>
    <th>Sr. No.</th>
    <th>Availing for</th>
    <th>Granted Amount</th>
    <th>Availed Amount</th>
    <th>Enter String</th>
    <th>Avail Amount</th>
</tr>
<tr>
    <td>1</td>
    <td>Education</td>
    <td class='granted-amount'>2000</td>
    <td class='availed-amount'>800</td>
    <td><input class='string-input' type='text' value=''></td>
    <td><input class='avail-input' type='text' value=''></td>
</tr>
<tr class='highlighted'>
    <td>2</td>
    <td>Fertilizers</td>
    <td class='granted-amount'>4000</td>
    <td class='availed-amount'>2000</td>
    <td><input class='string-input' type='text' value=''></td>
    <td><input class='avail-input' type='text' value=''></td>
</tr>
<tr>
    <td>3</td>
    <td>Nutritional Support</td>
    <td class='granted-amount'>3000</td>
    <td class='availed-amount'>2500</td>
    <td><input class='string-input' type='text' value=''></td>
    <td><input class='avail-input' type='text' value=''></td>
</tr>
<tr>
    <td>4</td>
    <td>Medicines</td>
    <td class='granted-amount'>2000</td>
    <td class='availed-amount'>1500</td>
    <td><input class='string-input' type='text' value=''></td>
    <td><input class='avail-input' type='text' value=''></td>
</tr>
        </table>
        <div class="btn-container">
            <button onclick="clearValues()">Clear</button>
            <button onclick="updateAmounts()">Update</button>
            
        </div>
    </div>
</body>
</html>
