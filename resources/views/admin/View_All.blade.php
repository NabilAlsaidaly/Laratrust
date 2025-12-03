<!DOCTYPE html>
<html lang="ar">
<head>
    @include('admin.css')
    <style type="text/css">
        /* Table Styles */
        .table_deg {
            border: 3px solid skyblue;
            margin: auto;
            width: 95%;
            text-align: center;
            margin-top: 40px;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .th_deg {
            background-color: skyblue;
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
            vertical-align: middle;
        }

        tr:hover td {
            background-color: #f0f8ff;
        }

        img {
            max-width: 100%;
            height: auto;
            max-height: 200px;
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
            gap: 10px;
        }
    </style>
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    @include('admin.header')

    <div class="d-flex align-items-stretch">
        @include('admin.sidebar')

        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">

                    <!-- Company Selection -->
                    <div class="form-group">
                        <label for="company">Select Company:</label>
                        <select class="form-control" id="companySelect" onchange="loadCompanyData()">
                            <option value="">Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Inverters Table -->
                    <h1 style="font-size: 40px; font-weight:bold">View Inverters</h1>
                    <table class="table_deg" id="invertersTable">
                        <thead>
                            <tr>
                                <th class="th_deg">Name</th>
                                <th class="th_deg">Price</th>
                                <th class="th_deg">Capacity</th>
                                <th class="th_deg">Description</th>
                                <th class="th_deg">Image</th>
                                <th class="th_deg">Owner</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inverters as $inverter)
                            <tr>
                                <td>{{ $inverter->name }}</td>
                                <td>{{ $inverter->price }}</td>
                                <td>{{ $inverter->capacity }}</td>
                                <td>{{ $inverter->description }}</td>
                                <td><img src="Inverter/{{ $inverter->image }}"></td>
                                <td><a href="{{ url('View_Companies') }}"><h4>{{ $inverter->companies->first()->name }}</h4></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
<br>
<br>
                    <!-- Batteries Table -->
                    <h1 style="font-size: 40px; font-weight:bold">View Batteries</h1>
                    <table class="table_deg" id="batteriesTable">
                        <thead>
                            <tr>
                                <th class="th_deg">Name</th>
                                <th class="th_deg">Price</th>
                                <th class="th_deg">Capacity</th>
                                <th class="th_deg">Type</th>
                                <th class="th_deg">Image</th>
                                <th class="th_deg">Owner</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batteries as $battery)
                            <tr>
                                <td>{{ $battery->name }}</td>
                                <td>{{ $battery->price }}</td>
                                <td>{{ $battery->capacity }}</td>
                                <td>{{ $battery->type }}</td>
                                <td><img src="Battery/{{ $battery->image }}"></td>
                                <td><a href="{{ url('View_Companies') }}"><h4>{{ $battery->companies->first()->name }}</h4></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <!-- Solar Panels Table -->
                    <h1 style="font-size: 40px; font-weight:bold">View Solar Panels</h1>
                    <table class="table_deg" id="solarPanelsTable">
                        <thead>
                            <tr>
                                <th class="th_deg">Name</th>
                                <th class="th_deg">Price</th>
                                <th class="th_deg">Capacity</th>
                                <th class="th_deg">Description</th>
                                <th class="th_deg">Image</th>
                                <th class="th_deg">Owner</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($solarPanels as $solarPanel)
                            <tr>
                                <td>{{ $solarPanel->name }}</td>
                                <td>{{ $solarPanel->price }}</td>
                                <td>{{ $solarPanel->capacity }}</td>
                                <td>{{ $solarPanel->description }}</td>
                                <td><img src="SolarPanel/{{ $solarPanel->image }}"></td>
                                <td><a href="{{ url('View_Companies') }}"><h4>{{ $solarPanel->companies->first()->name }}</h4></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <!-- Categories Table -->
                    <h1 style="font-size: 40px; font-weight:bold">View Categories</h1>
                    <table class="table_deg" id="categoriesTable">
                        <thead>
                            <tr>
                                <th class="th_deg">Name</th>
                                <th class="th_deg">Price</th>
                                <th class="th_deg">Quantities</th>
                                <th class="th_deg">Description</th>
                                <th class="th_deg">Image</th>
                                <th class="th_deg">Owner</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $data)
                            <tr>
                                <td>{{$data->name}}</td>
                                <td>{{$data->price}}</td>
                                <td>{{$data->quantities}}</td>
                                <td>{{$data->description}}</td>
                                <td><img src="Categories/{{$data->image}}"></td>
                                <td><a href="{{ url('View_Companies') }}"><h4>{{ $data->companies->first()->name }}</h4></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

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

    {{-- /********************************************************************Filter*/ --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">

        function loadCompanyData() {
            var companyId = $('#companySelect').val();

            if (companyId) {
                $.ajax({
                    url: '/getCompanyData/' + companyId,
                    type: 'GET',
                    success: function(data) {
                        // تحديث الجداول بالبيانات التي تم جلبها
                        updateTable('#invertersTable', data.inverters, 'Inverter');
                        updateTable('#batteriesTable', data.batteries, 'Battery');
                        updateTable('#solarPanelsTable', data.solarPanels, 'SolarPanel');
                        updateTable('#categoriesTable', data.categories, 'Categories');
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            } else {
                // في حالة عدم اختيار أي شركة، عرض جميع المنتجات
                updateTable('#invertersTable', {!! json_encode($inverters) !!}, 'Inverter');
                updateTable('#batteriesTable', {!! json_encode($batteries) !!}, 'Battery');
                updateTable('#solarPanelsTable', {!! json_encode($solarPanels) !!}, 'SolarPanel');
                updateTable('#categoriesTable', {!! json_encode($categories) !!}, 'Categories');
            }
        }

        function updateTable(tableId, data, folder) {
            var table = $(tableId);
            var tbody = table.find('tbody');

            tbody.empty();

            data.forEach(function(item) {
                var companyName = item.companies && item.companies.length > 0 ? item.companies[0].name : 'N/A';

                var row = '<tr>' +
                    '<td>' + item.name + '</td>' +
                    '<td>' + item.price + '</td>' +
                    '<td>' + item.capacity + '</td>' +
                    '<td>' + (item.description || item.type || '') + '</td>' +
                    '<td><img src="' + (item.image ? folder + '/' + item.image : '') + '"></td>' +
                    '<td><a href="{{ url("View_Companies") }}"><h4>' + companyName + '</h4></a></td>' +
                    '</tr>';
                tbody.append(row);
            });
        }

        $(document).ready(function() {
            loadCompanyData(); // تحميل البيانات عند تحميل الصفحة
        });
    </script>
</body>
</html>
