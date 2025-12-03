<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom CSS for shopping cart */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
            margin-bottom: 2rem;
            animation: fadeIn 1s ease-in-out;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #dddddd;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .cart-header h2 {
            font-size: 28px;
            font-weight: bold;
            color: #343a40;
        }

        .cart-header .badge {
            font-size: 18px;
            background-color: #007bff;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            color: #ffffff;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #ddd;
            align-items: center;
            animation: slideIn 0.5s ease-in-out;
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .cart-item img:hover {
            transform: scale(1.05);
        }

        .item-info {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .item-info div {
            max-width: 400px;
        }

        .item-info h5 {
            font-size: 20px;
            font-weight: bold;
            color: #343a40;
            margin: 0;
        }

        .item-info p {
            font-size: 14px;
            color: #6c757d;
            margin: 0;
        }

        .item-details {
            text-align: right;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .item-details span {
            display: block;
            font-size: 16px;
            color: #343a40;
            margin-bottom: 0.5rem;
        }

        .item-details input {
            width: 60px;
            padding: 0.3rem;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .item-details input:focus {
            border-color: #007bff;
        }

        .cart-total {
            display: flex;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 2px solid #ddd;
            font-weight: bold;
            font-size: 18px;
            color: #343a40;
            animation: fadeIn 0.5s ease-in-out;
        }

        .btn-checkout,
        .btn-continue {
            padding: 0.75rem 2.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            font-size: 18px;
            margin-top: 1rem;
            text-decoration: none;
            display: inline-block;
        }

        .btn-checkout {
            background-color: #28a745;
            color: white;
        }

        .btn-checkout:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .btn-continue {
            background-color: #007bff;
            color: white;
        }

        .btn-continue:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body>
    @include('home.navbar')

    <div class="container cart-container">
        <div class="cart-header">
            <h2>Shopping Cart</h2>
            <span class="badge bg-primary">
                {{ count((array) session('cart')) + count((array) session('shoppingCart')) + count((array) session('batteryCart')) + count((array) session('categoryCart')) }}
            </span>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Display solar panel items in the shopping cart -->
        @foreach(session('cart', []) as $id => $item)
            <div class="cart-item">
                <div class="item-info">
                    <img src="{{ asset('SolarPanel/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    <div>
                        <h5>{{ $item['name'] }}</h5>
                    </div>
                </div>
                <div class="item-details">
                    <span class="item-price">Price: ${{ $item['price'] }}</span>
                    <input type="number" class="item-quantity" name="quantity[{{ $id }}]" value="{{ $item['quantity'] }}" min="1" max="10" data-price="{{ $item['price'] }}" data-id="{{ $id }}">
                    <form action="{{ route('remove_solar', $id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach

        @foreach(session('shoppingCart', []) as $id => $item)
            <div class="cart-item">
                <div class="item-info">
                    <img src="{{ asset('Inverter/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    <div>
                        <h5>{{ $item['name'] }}</h5>
                        <p>{{ $item['description'] ?? '' }}</p>
                    </div>
                </div>
                <div class="item-details">
                    <span class="item-price">Price: ${{ $item['price'] }}</span>
                    <input type="number" class="item-quantity" name="quantity[{{ $id }}]" value="{{ $item['quantity'] }}" min="1" max="10" data-price="{{ $item['price'] }}" data-id="{{ $id }}">
                    <form action="{{ route('remove_inverter', $id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach

        @foreach(session('batteryCart', []) as $id => $item)
            <div class="cart-item">
                <div class="item-info">
                    <img src="{{ asset('Battery/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    <div>
                        <h5>{{ $item['name'] }}</h5>
                    </div>
                </div>
                <div class="item-details">
                    <span class="item-price">Price: ${{ $item['price'] }}</span>
                    <input type="number" class="item-quantity" name="quantity[{{ $id }}]" value="{{ $item['quantity'] }}" min="1" max="10" data-price="{{ $item['price'] }}" data-id="{{ $id }}">
                    <form action="{{ route('remove_battery', $id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach

        @foreach(session('categoryCart', []) as $id => $item)
            <div class="cart-item">
                <div class="item-info">
                    <img src="{{ asset('Categories/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    <div>
                        <h5>{{ $item['name'] }}</h5>
                        <p>{{ $item['description'] ?? '' }}</p>
                    </div>
                </div>
                <div class="item-details">
                    <span class="item-price">Price: ${{ $item['price'] }}</span>
                    <input type="number" class="item-quantity" name="quantity[{{ $id }}]" value="{{ $item['quantity'] }}" min="1" max="10" data-price="{{ $item['price'] }}" data-id="{{ $id }}">
                    <form action="{{ route('remove_category', $id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </div>
            </div>
        @endforeach

        <!-- Display total price -->
        <div class="cart-total">
            <h4>Total:</h4>
            <span id="total-price">$0</span>
        </div>

        <form action="{{ route('confirm_purchase') }}" method="POST">
            @csrf
            <input type="hidden" name="total_price" id="total-price-input" value="0">
            <button type="submit" class="btn-checkout">Confirmation</button>
        </form>

        <button class="btn-continue"><a href="{{ route('Product') }}" style="color: #ffffff">Continue Shopping</a></button>

       
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const quantityInputs = document.querySelectorAll('.item-quantity');
        const totalPriceElement = document.getElementById('total-price');
        const totalPriceInput = document.getElementById('total-price-input');

        function calculateTotal() {
            let total = 0;
            quantityInputs.forEach(input => {
                const price = parseFloat(input.getAttribute('data-price'));
                const quantity = parseInt(input.value);
                total += price * quantity;
            });
            totalPriceElement.textContent = `$${total.toFixed(2)}`;
            totalPriceInput.value = total.toFixed(2);
        }

        function updateQuantity(event) {
            const input = event.target;
            const id = input.getAttribute('data-id');
            const quantity = input.value;

            fetch(`/update-quantity/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Quantity updated successfully');
                    calculateTotal();
                } else {
                    console.error('Failed to update quantity');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        quantityInputs.forEach(input => {
            input.addEventListener('change', updateQuantity);
        });

        calculateTotal();
    });
    </script>





    </div>

    <!-- JavaScript Libraries -->
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
