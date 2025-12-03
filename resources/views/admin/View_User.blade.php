<!DOCTYPE html>
<html lang="ar">
<head>
    @include('admin.css')
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
                    <h1 style="font-size: 40px; font-weight:bold">View User</h1>
                    <div class="search-container">
                        <label for="searchInput">Search:</label>
                        <input type="text" id="searchInput" onkeyup="searchUsers()" placeholder="">
                    </div>
                    <table id="userTable" class="table_deg"> <!-- Added id attribute -->
                        <tr>
                            <th class="th_deg">Name</th>
                            <th class="th_deg">Email</th>
                            <th class="th_deg">Phone</th>
                            <th class="th_deg">UserType</th>
                            <th class="th_deg">Option</th>
                        </tr>

                        @foreach ($data as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->usertype }}</td>
                            <td>
                                <div class="btn-container">
                                    @if ($user->is_active)
                                        <a onclick="confirmDeactivation(event, '{{ url('deactivate_user', $user->id) }}')" class="btn btn-warning" style="background-color: orange" href="#">Deactivate</a>
                                    @else
                                        <a onclick="confirmActivation(event, '{{ url('activate_user', $user->id) }}')" class="btn btn-success" style="background-color: blue" href="#">Activate</a>
                                    @endif
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
        function confirmDeactivation(event, deactivateUrl) {
            event.preventDefault();
            Swal.fire({
                title: 'Are You Sure You Want To Deactivate This User?',
                text: "You Can Be Able To Undo This!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deactivateUrl;
                }
            })
        }

        function confirmActivation(event, activateUrl) {
            event.preventDefault();
            Swal.fire({
                title: 'Are You Sure You Want To Activate This User?',
                text: "Please make sure you have made the necessary changes.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = activateUrl;
                }
            })
        }
    </script>

<script type="text/javascript">
    function searchUsers() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("userTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                var cell = td[j];
                if (cell) {
                    txtValue = cell.textContent || cell.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break; // Break the inner loop to avoid hiding the row if any cell matches the filter
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }
</script>






</body>
</html>
