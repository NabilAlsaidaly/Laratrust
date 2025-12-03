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
<div class="page-content">
    <div class="page-header">
      <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Dashboard</h2>
      </div>
    </div>

    <section class="no-padding-bottom">

      <div class="container-fluid">

        <div class="page-content">

            </div>
        </div>
      </div>
    </section>
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


