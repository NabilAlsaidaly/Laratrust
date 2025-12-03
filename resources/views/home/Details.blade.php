<!DOCTYPE html>
<html lang="en">
<head>
  @include('home.idcss')
</head>
<body>
    @include('home.navbar')
    @if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif


@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Details</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <!-- يمكن إضافة روابط التنقل هنا إذا لزم الأمر -->
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Company Details Start -->
    <div class="container mt-4">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-4">{{ $company->name }}</h1>
        </div>

        <div class="mb-5">
            <div class="card-body">
                <h5 class="card-title">{{ $company->name }}</h5>
                <p class="card-text">Phone: {{ $company->phone ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Products Section Start -->
        <div id="productList" class="row g-4">
            <!-- Inverters -->
            @foreach ($inverters as $inverter)
            <div class="col-lg-4 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s" data-category="inverter">
                <div class="team-item rounded overflow-hidden">
                    <div class="d-flex">
                        <img class="img-fluid w-75" src="{{ asset('inverter/' . $inverter->image) }}" alt="{{ $inverter->name }}">
                        <div class="team-social w-25"></div>
                    </div>
                    <div class="p-4">
                        <h5>Inverter Name:</h5><p>{{ $inverter->name }}</p>
                        <h5>Price:</h5><p>{{ $inverter->price }}</p>
                        <h5>Capacity:</h5><p>{{ $inverter->capacity }}</p>
                        <h5>Description:</h5><p>{{ $inverter->description }}</p>
                        <h5>Owner:</h5>
                        @foreach($inverter->owns as $own)
                            <p>{{ $own->company->name }}</p>
                        @endforeach
                        <a href="{{ route('cart.inverter', ['id' => $inverter->id]) }}" style="display: inline-block; padding: 10px 20px; background-color: #088f0d; color: white; text-decoration: none; border-radius: 4px; font-size: 16px; transition: background-color 0.3s ease;">Add To Cart</a>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Batteries -->
            @foreach ($batteries as $battery)
            <div class="col-lg-4 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s" data-category="battery">
                <div class="team-item rounded overflow-hidden">
                    <div class="d-flex">
                        <img class="img-fluid w-75" src="{{ asset('Battery/' . $battery->image) }}" alt="{{ $battery->name }}">
                        <div class="team-social w-25"></div>
                    </div>
                    <div class="p-4">
                        <h5>Battery Name:</h5><p>{{ $battery->name }}</p>
                        <h5>Price:</h5><p>{{ $battery->price }}</p>
                        <h5>Capacity:</h5><p>{{ $battery->capacity }}</p>
                        <h5>Type:</h5><p>{{ $battery->type }}</p>
                        <h5>Owner:</h5>
                        @foreach($battery->owns as $own)
                            <p>{{ $own->company->name }}</p>
                        @endforeach
                        <a href="{{ route('cart.battery', ['id' => $battery->id]) }}" style="display: inline-block; padding: 10px 20px; background-color: #088f0d; color: white; text-decoration: none; border-radius: 4px; font-size: 16px; transition: background-color 0.3s ease;">Add To Cart</a>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Solar Panels -->
            @foreach ($solar as $panel)
            <div class="col-lg-4 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s" data-category="solar">
                <div class="team-item rounded overflow-hidden">
                    <div class="d-flex">
                        <img class="img-fluid w-75" src="{{ asset('SolarPanel/' . $panel->image) }}" alt="{{ $panel->name }}">
                        <div class="team-social w-25"></div>
                    </div>
                    <div class="p-4">
                        <h5>SolarPanel Name:</h5><p>{{ $panel->name }}</p>
                        <h5>Price:</h5><p>{{ $panel->price }}</p>
                        <h5>Capacity:</h5><p>{{ $panel->capacity }}</p>
                        <h5>Description:</h5><p>{{ $panel->description }}</p>
                        <h5>Owner:</h5>
                        @foreach($panel->owns as $own)
                            <p>{{ $own->company->name }}</p>
                        @endforeach
                        <a href="{{ route('cart.solar', ['id' => $panel->id]) }}" style="display: inline-block; padding: 10px 20px; background-color: #088f0d; color: white; text-decoration: none; border-radius: 4px; font-size: 16px; transition: background-color 0.3s ease;">Add To Cart</a>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Categories -->
            @foreach ($categories as $category)
            <div class="col-lg-4 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s" data-category="category">
                <div class="team-item rounded overflow-hidden">
                    <div class="d-flex">
                        <img class="img-fluid w-75" src="{{ asset('Categories/' . $category->image) }}" alt="{{ $category->name }}">
                        <div class="team-social w-25"></div>
                    </div>
                    <div class="p-4">
                        <h5>Category Name:</h5><p>{{ $category->name }}</p>
                        <h5>Price:</h5><p>{{ $category->price }}</p>
                        <h5>Description:</h5><p>{{ $category->description }}</p>
                        <h5>Owner:</h5>
                        @foreach($category->owns as $own)
                            <p>{{ $own->company->name }}</p>
                        @endforeach
                        <a href="{{ route('cart.category', ['id' => $category->id]) }}" style="display: inline-block; padding: 10px 20px; background-color: #088f0d; color: white; text-decoration: none; border-radius: 4px; font-size: 16px; transition: background-color 0.3s ease;">Add To Cart</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Products Section End -->
    </div>
    <!-- Company Details End -->

    <!-- JavaScript Libraries -->
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
