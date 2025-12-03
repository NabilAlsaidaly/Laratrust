<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.idcss')
    <style>
        .center-screen {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center; /* لضمان أن النصوص تكون في المنتصف */
        }
    </style>
</head>

<body>
    @include('home.navbar')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container-xxl py-5 center-screen">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">Product</h6>
                <h1 class="mb-4">Battery</h1>
            </div>
            <div id="productDetails" class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s">
                    <div class="team-item rounded overflow-hidden">
                        <div class="d-flex justify-content-center">
                            <img class="img-fluid w-75" src="/Battery/{{ $battery->image }}" alt="{{ $battery->name }}">
                        </div>
                        <div class="p-4">
                            <h5>Battery Name:</h5>
                            <p>{{ $battery->name }}</p>
                            <h5>Price:</h5>
                            <p class="product-price">{{ $battery->price }}</p>
                            <h5>Capacity:</h5>
                            <p>{{ $battery->capacity }}</p>
                            <h5>Description:</h5>
                            <p>{{ $battery->description }}</p>
                            <h5>Owner:</h5>
                            @foreach($battery->owns as $own)
                            <p>{{ $own->company->name }}</p>
                            @endforeach
                            <a href="{{ route('cart.battery', ['id' => $battery->id]) }}" style="display: inline-block; padding: 10px 20px; background-color: #088f0d; color: white; text-decoration: none; border-radius: 4px; font-size: 16px; transition: background-color 0.3s ease;">Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
