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
                    <h1 style="font-size: 40px; font-weight:bold">View Battery</h1>
                    <div class="table-container">
                        <table class="table_deg" id="companyTable">
                        <tr>
                            <th class="th_deg">Name</th>
                            <th class="th_deg">Price</th>
                            <th class="th_deg">Quantities</th>
                            <th class="th_deg">Capacity</th>
                            <th class="th_deg">type</th>
                            <th class="th_deg">Image</th>
                            <th class="th_deg">Options</th>
                        </tr>

                        @foreach ($data as $data)
                        <tr>
                            <td>{{$data->name}}</td>
                            <td>{{$data->price}}</td>
                            <td>{{$data->quantities}}</td>
                            <td>{{$data->capacity}}</td>
                            <td>{{$data->type}}</td>
                            <td><img src="Battery/{{$data->image}}"></td>
                            <td>
                                <div class="btn-container">
                                    <a onclick="confirmDelete(event, '{{url('Delete_Battery', $data->id)}}')" class="btn btn-danger" href="#">Delete</a>
                                    <a onclick="confirmUpdate(event, '{{url('Update_Battery', $data->id)}}')" class="btn btn-update" href="{{url('company.Update_Battery')}}">Update</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function confirmDelete(event, deleteUrl) {
            event.preventDefault();
            Swal.fire({
                title: 'Are You Sure You Want To Delete This?',
                text: "You Won't Be Able To Undo This!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            })
        }

        function confirmUpdate(event, updateUrl) {
            event.preventDefault();
            Swal.fire({
                title: 'Are You Sure You Want To Update This?',
                text: "Please make sure you have made the necessary changes.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = updateUrl;
                }
            })
        }
    </script>
</body>
</html>
