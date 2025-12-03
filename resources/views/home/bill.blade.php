<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')

    <style>


        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .cart-container {
            padding: 2rem;
            max-width: 900px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
            margin-bottom: 2rem;
            animation: fadeIn 1s ease-in-out;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #dddddd;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .cart-header h2 {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }

        .badge {
            font-size: 18px;
            background-color: #2268ff;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            color: #ffffff;
        }

        .search-container {
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .search-container input[type="text"],
        .search-container input[type="date"] {
            margin-right: 1rem;
            padding: 0.7rem;
            border: 1px solid #dddddd;
            border-radius: 5px;
            max-width: 220px;
            transition: border-color 0.3s ease;
            font-size: 16px;
            color: #555;
        }

        .search-container input[type="text"]:focus,
        .search-container input[type="date"]:focus {
            border-color: #ffffff;
            outline: none;
        }

        .search-container button {
            padding: 0.7rem 1.2rem;
            border: none;
            background-color: #ffffff;
            color: #ffffff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
            text-transform: uppercase;
        }

        .search-container button:hover {
            background-color: #ffffff;
        }

        .card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            border-left: 5px solid #2268ff;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            font-size: 20px;
            color: #333;
            font-weight: bold;
            margin-bottom: 1rem;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 1rem;
        }

        .card-body ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .card-body li {
            margin-bottom: 1.2rem;
            padding-bottom: 0.7rem;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-body li:last-child {
            border-bottom: none;
        }

        .item-info {
            display: flex;
            flex-direction: column;
        }

        .item-info strong {
            font-size: 16px;
            color: #333;
        }

        .item-info span {
            font-size: 16px;
            color: #777;
        }

        .item-price,
        .item-total {
            font-size: 16px;
            font-weight: bold;
        }

        .item-price {
            color: #555;
        }

        .item-total {
            color: #ff5722;
        }

        .item-company {
            font-size: 16px;
            color: #6c757d;
        }

        .item-icon {
            font-size: 24px;
            color: #2268ff;
            margin-right: 0.75rem;
        }

        .delete-button {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            background-color: transparent;
            color: #dc3545;
            border: none;
            font-size: 1.8rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .delete-button:hover {
            color: #c82333;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>



</head>
<body>
    @include('home.navbar')

    <div class="cart-container">
        <div class="cart-header">
            <h2>Shopping Bills</h2>
            <span id="billsCount" class="badge badge-pill badge-primary">{{ count($bills) }}</span>
        </div>

        <div class="search-container">
            <form id="searchForm" class="d-flex justify-content-center">
                <input id="searchInput" type="text" class="form-control me-2" placeholder="Search by Order ID" oninput="filterBills()">
                <input id="searchDate" type="date" class="form-control me-2" placeholder="Search by Date" oninput="filterBills()">
            </form>
        </div>

        <div id="billsContainer">
            @if($bills->isEmpty())
                <p>You have no previous orders.</p>
            @else
                @foreach($bills as $bill)
                    <div class="card bill-card" data-id="{{ $bill->id }}" data-date="{{ $bill->date }}">
                        <div class="card-header">
                            <strong>Order ID:</strong> {{ $bill->id }} <br>
                            <strong>Order Date:</strong> {{ $bill->date }} <br>
                            <strong>Invoice Value:</strong> ${{ $bill->value }}
                            <button class="delete-button" onclick="hideBill(this, {{ $bill->id }})"><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach($bill->buy as $buy)
                                    <li>
                                        <div class="item-info">
                                            <span class="item-icon">
                                                @if($buy->solar_panel_id)
                                                    <i class="fas fa-solar-panel"></i>
                                                @elseif($buy->inverter_id)
                                                    <i class="fas fa-plug"></i>
                                                @elseif($buy->battery_id)
                                                    <i class="fas fa-battery-full"></i>
                                                @elseif($buy->categories_id)
                                                    <i class="fas fa-box-open"></i>
                                                @else
                                                    <i class="fas fa-question-circle"></i>
                                                @endif
                                            </span>
                                            <strong>Product Name:</strong>
                                            @if($buy->solar_panel_id)
                                                {{ $buy->solarPanel->name }} <br>(Solar Panel)<br>
                                            @elseif($buy->inverter_id)
                                                {{ $buy->inverter->name }} <br>(Inverter)<br>
                                            @elseif($buy->battery_id)
                                                {{ $buy->battery->name }} <br>(Battery)<br>
                                            @elseif($buy->categories_id)
                                                {{ $buy->categories->name }} <br>(Category)<br>
                                            @else
                                                Unknown Item
                                            @endif
                                            <br>
                                            <span><strong>Quantity:</strong> {{ $buy->quantities }}</span> <br>
                                            <span class="item-price"><strong>The Price:</strong> ${{ $buy->item_price }}</span> <br>
                                            <span class="item-total"><strong>Total:</strong> ${{ floatval($buy->item_price) * floatval($buy->quantities) }}</span> <br>
                                            <span class="item-company"><strong>Company:</strong> {{ $buy->company->name }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hiddenBills = JSON.parse(localStorage.getItem('hiddenBills')) || [];
            const bills = document.querySelectorAll('.bill-card');

            bills.forEach(bill => {
                if (hiddenBills.includes(bill.getAttribute('data-id'))) {
                    bill.style.display = 'none';
                }
            });

            updateBillCount();
        });

        function filterBills() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const searchDate = document.getElementById('searchDate').value;
            const bills = document.querySelectorAll('.bill-card');

            let visibleCount = 0;

            bills.forEach(bill => {
                const orderId = bill.getAttribute('data-id').toLowerCase();
                const orderDate = bill.getAttribute('data-date');
                const hiddenBills = JSON.parse(localStorage.getItem('hiddenBills')) || [];

                if (!hiddenBills.includes(bill.getAttribute('data-id')) && ((searchInput && orderId.includes(searchInput)) || (searchDate && orderDate === searchDate) || (!searchInput && !searchDate))) {
                    bill.style.display = '';
                    visibleCount++;
                } else {
                    bill.style.display = 'none';
                }
            });

            document.getElementById('billsCount').textContent = visibleCount;
        }

        function hideBill(button, billId) {
            const billCard = button.closest('.bill-card');
            billCard.style.display = 'none';

            let hiddenBills = JSON.parse(localStorage.getItem('hiddenBills')) || [];
            if (!hiddenBills.includes(billId.toString())) {
                hiddenBills.push(billId.toString());
            }
            localStorage.setItem('hiddenBills', JSON.stringify(hiddenBills));

            updateBillCount();
        }

        function updateBillCount() {
            const bills = document.querySelectorAll('.bill-card');
            let visibleCount = 0;

            bills.forEach(bill => {
                if (bill.style.display !== 'none') {
                    visibleCount++;
                }
            });

            document.getElementById('billsCount').textContent = visibleCount;
        }
    </script>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
