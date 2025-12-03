<!DOCTYPE html>
<html lang="ar">
<head>
    @include('company.css')
    <style type="text/css">
        /* Table Styles */
        .table_deg {
            border: 3px solid skyblue;
            margin: auto;
            width: 95%; /* Adjusted width for larger table */
            text-align: center;
            margin-top: 40px;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .th_deg {
            background-color: rgb(0, 175, 245);
            padding: 20px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
            border-bottom: 2px solid white;
        }

        td {
            padding: 15px;
            font-size: 16px;
            border-bottom: 1px solid skyblue;
            transition: background-color 0.5s;
            vertical-align: middle; /* Center content vertically */
        }

        tr:hover td {
            background-color: #f0f8ff;
        }

        img {
            max-width: 100%; /* Ensure images don't exceed the cell size */
            height: auto; /* Maintain aspect ratio */
            max-height: 200px; /* Limiting the height of the image */
        }

        /* Button Styles */
        .btn-danger, .btn-update {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .btn-danger:active {
            background-color: #bd2130;
            transform: scale(1);
        }

        .btn-danger:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.5);
        }

        .btn-update {
            background-color: #28a745;
        }

        .btn-update:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        .btn-update:active {
            background-color: #1e7e34;
            transform: scale(1);
        }

        .btn-update:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.5);
        }

        .btn-container {
            display: flex;
            justify-content: center;
            gap: 10px; /* Space between buttons */
        }

        /* Add overflow to container */
        .table-container {
            overflow-x: auto;
            margin: auto;
            width: 100%;
        }

        /* Search Box Styles */
        .search-box {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .search-input {
            padding: 10px;
            width: 300px;
            font-size: 16px;
            border: 2px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-btn {
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .search-btn:hover {
            background-color: #0056b3;
        }

        .search-btn:active {
            background-color: #004ea0;
            transform: scale(1);
        }

        .search-btn:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.5);
        }
    </style>
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    @include('company.header')

    <div class="d-flex align-items-stretch">
        @include('company.sidebar')
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h1 style="font-size: 40px; font-weight:bold">View Bills</h1>

                    <!-- Search Box -->
                    <div class="search-box">
                        <input type="text" id="searchInput" class="search-input" placeholder="Search by Bill Id or User Name" oninput="searchTable()">
                        <input type="date" id="dateInput" class="date-input" placeholder="Search by Invoice Date" onchange="searchTableByDate()">
                        <button class="search-btn" onclick="resetTable()">Reset</button>
                    </div>

                    <div class="table-container">
                        <table class="table_deg" id="companyTable">
                            <thead>
                                <tr>
                                    <th class="th_deg">Bill Id</th>
                                    <th class="th_deg">User Name</th>
                                    <th class="th_deg">Product</th>
                                    <th class="th_deg">Quantities</th>
                                    <th class="th_deg">Price</th>
                                    <th class="th_deg">Total Price</th>
                                    <th class="th_deg">Invoice Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersWithOrders as $user)
                                    @foreach ($user->buy as $buy)
                                        <tr>
                                            <td>{{ $buy->bill_id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                @if ($buy->solar_panel)
                                                    {{ $buy->solar_panel->name }} (solarPanel)
                                                @elseif ($buy->inverter)
                                                    {{ $buy->inverter->name }} (Inverter)
                                                @elseif ($buy->battery)
                                                    {{ $buy->battery->name }} (Battery)
                                                @elseif ($buy->categories)
                                                    {{ $buy->categories->name }} (Category)
                                                @else
                                                    No Product Found
                                                @endif
                                            </td>
                                            <td>{{ $buy->quantities }}</td>
                                            <td>{{ $buy->getItemPriceAttribute() }}</td>
                                            <td>{{ floatval($buy->quantities) * floatval($buy->getItemPriceAttribute()) }}</td>
                                            <td>{{ $buy->bill->date }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript files -->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/popper.js/umd/popper.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/vendor/jquery.cookie/jquery.cookie.js"></script>
    <script src="admin/vendor/chart.js/Chart.min.js"></script>
    <script src="admin/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="admin/js/charts-home.js"></script>
    <script src="admin/js/front.js"></script>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function searchTable() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("companyTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                var matchFound = false;
                // Check each column in the current row except date column (index 6)
                for (var j = 0; j < tr[i].cells.length - 1; j++) {
                    td = tr[i].cells[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            matchFound = true;
                            break; // Break the inner loop if match is found in any column
                        }
                    }
                }
                // Show or hide the row based on whether the search term was found
                if (matchFound) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

        function searchTableByDate() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("dateInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("companyTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[6]; // Column index 6 is the Invoice Date column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function resetTable() {
            // Show all table rows
            var table, tr;
            table = document.getElementById("companyTable");
            tr = table.getElementsByTagName("tr");

            for (var i = 0; i < tr.length; i++) {
                tr[i].style.display = "";
            }

            // Clear the search inputs
            document.getElementById("searchInput").value = "";
            document.getElementById("dateInput").value = "";
        }
    </script>
</body>
</html>
