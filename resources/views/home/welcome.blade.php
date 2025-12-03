<!DOCTYPE html>
<html lang="en">

<head>
@include('home.css')
</head>

    <!-- Spinner Start -->
   @include('home.navbar')
    <!-- Navbar End -->
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
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative" data-dot="<img src='img/carousel-1.jpg'>">
                <img class="img-fluid" src="img/carousel-1.jpg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown">Product</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-3"></p>
                                <a href="{{route('Product')}}" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">Discover</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative" data-dot="<img src='img/carousel-2.jpg'>">
                <img class="img-fluid" src="img/carousel-2.jpg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown">Provider</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-3"></p>
                                <a href="{{route('company')}}" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">Show Provider</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative" data-dot="<img src='img/carousel-3.jpg'>">
                <img class="img-fluid" src="img/carousel-3.jpg" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-2 text-white animated slideInDown">Technician</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-3"></p>
                                <a href="{{route('Technician')}}" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">More Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <select class="form-select" name="category">
                            <option value="all">All</option>
                            <option value="companies">Companies</option>
                            <option value="technicians">Technicians</option>
                            <option value="products">Products</option>
                        </select>
                        <input type="text" class="form-control" name="query" placeholder="Search...">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">Company</h6>
                <h1 class="mb-4">Companies that provide the service</h1>
            </div>
            <div class="row g-4">
                @foreach ($data6 as $company)
                <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="img/img-600x400-1.jpg" alt="">
                        <div class="position-relative p-4 pt-0">
                            <div class="service-icon">
                                <i class="fa fa-solar-panel fa-3x"></i>
                            </div>
                            <h4 class="mb-3">{{$company->name}}</h4>
                            <p>{{$company->phone}}</p>
                            <a class="small fw-medium" href="{{ route('home.Details', ['companyId' => $company->id]) }}">Details<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Service End -->
<br>
<br>
<br>
<br>
   <!-- Products Section -->
   <div class="container">
    <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
        <h6 class="text-primary">Products</h6>
        <h1 class="mb-4">Some Products Of Company</h1>
    </div>


    <!-- Filter Buttons -->
    <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.3s">
        <div class="col-12 text-center">
            <ul class="list-inline mb-5" id="portfolio-flters">
                <li class="mx-2 active" data-filter="*">All</li>
                <li class="mx-2" data-filter=".battery">Batteries</li>
                <li class="mx-2" data-filter=".inverter">Inverters</li>
                <li class="mx-2" data-filter=".solar">Solar Panels</li>
                <li class="mx-2" data-filter=".categories">Categories</li>
            </ul>
        </div>
    </div>
    <!-- Products Container -->
    <div class="row g-4 portfolio-container wow fadeInUp" data-wow-delay="0.5s">
        @foreach ($data1 as $inverter)
        <div class="col-lg-4 col-md-6 portfolio-item inverter">
            <div class="portfolio-img rounded overflow-hidden">
                <img class="img-fluid" src="inverter/{{ $inverter->image }}" alt="{{ $inverter->name }}">
                <div class="portfolio-btn">
                    <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="inverter/{{$inverter->image}}" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                    <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="{{ route('cart.inverter', ['id' => $inverter->id]) }}"><i class="fas fa-shopping-cart"></i></a>
                </div>

            </div>
            <div class="pt-3">
                <p class="text-primary mb-0">Inverter</p>
                <hr class="text-primary w-25 my-2">
                <h5 class="lh-base"><h5>Name:</h5>{{ $inverter->name }}</h5>
                <h5 class="lh-base"><h5>Price:</h5>{{ $inverter->price }}</h5>
                <h5 class="lh-base"><h5>Description:</h5>{{ $inverter->description }}</h5>
            </div>
        </div>
        @endforeach
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="row g-4 portfolio-container wow fadeInUp" data-wow-delay="0.5s">
        @foreach ($data2 as $battery)
        <div class="col-lg-4 col-md-6 portfolio-item battery">
            <div class="portfolio-img rounded overflow-hidden">
                <img class="img-fluid" src="Battery/{{ $battery->image }}" alt="{{ $battery->name }}">
                <!-- Portfolio Buttons -->
                <div class="portfolio-btn">
                    <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1"
                        href="Battery/{{ $battery->image }}" data-lightbox="portfolio"><i
                            class="fa fa-eye"></i></a>
                    <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="{{ route('cart.battery', ['id' => $battery->id]) }}"><i
                            class="fas fa-shopping-cart"></i></a>
                </div>
            </div>
            <!-- Portfolio Details -->
            <div class="pt-3">
                <p class="text-primary mb-0">Battery</p>
                <hr class="text-primary w-25 my-2">
                <h5 class="lh-base"><h5>Name:</h5>{{ $battery->name }}</h5>
                <h5 class="lh-base"><h5>Price:</h5>{{ $battery->price }}</h5>
                <h5 class="lh-base"><h5>Capacity:</h5>{{ $battery->capacity }}</h5>
            </div>
        </div>
        @endforeach
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="row g-4 portfolio-container wow fadeInUp" data-wow-delay="0.5s">
        @foreach ($data3 as $solar)
        <div class="col-lg-4 col-md-6 portfolio-item solar">
            <div class="portfolio-img rounded overflow-hidden">
                <img class="img-fluid" src="SolarPanel/{{ $solar->image }}" alt="{{ $solar->name }}">
                <!-- Portfolio Buttons -->
                <div class="portfolio-btn">
                    <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1"
                        href="SolarPanel/{{ $solar->image }}" data-lightbox="portfolio"><i
                            class="fa fa-eye"></i></a>
                    <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="{{ route('cart.solar', ['id' => $solar->id]) }}"><i
                            class="fas fa-shopping-cart"></i></a>
                </div>
            </div>
            <!-- Portfolio Details -->
            <div class="pt-3">
                <p class="text-primary mb-0">Solar Panels</p>
                <hr class="text-primary w-25 my-2">
                <h5 class="lh-base"><h5>Name:</h5>{{ $solar->name }}</h5>
                <h5 class="lh-base"><h5>Price:</h5>{{ $solar->price }}</h5>
                <h5 class="lh-base"><h5>Description:</h5>{{ $solar->description }}</h5>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row g-4 portfolio-container wow fadeInUp" data-wow-delay="0.5s">
        @foreach ($data5 as $categories)
        <div class="col-lg-4 col-md-6 portfolio-item categories">
            <div class="portfolio-img rounded overflow-hidden">
                <img class="img-fluid" src="Categories/{{ $categories->image }}" alt="{{ $categories->name }}">
                <!-- Portfolio Buttons -->
                <div class="portfolio-btn">
                    <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1"
                        href="Categories/{{ $categories->image }}" data-lightbox="portfolio"><i
                            class="fa fa-eye"></i></a>
                    <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="{{ route('cart.category', ['id' => $categories->id]) }}"><i
                            class="fas fa-shopping-cart"></i></a>
                </div>
            </div>
            <!-- Portfolio Details -->
            <div class="pt-3">
                <p class="text-primary mb-0">Categories</p>
                <hr class="text-primary w-25 my-2">
                <h5 class="lh-base"><h5>Name:</h5>{{ $categories->name }}</h5>
                <h5 class="lh-base"><h5>Price:</h5>{{ $categories->price }}</h5>
                <h5 class="lh-base"><h5>Description:</h5>{{ $categories->description }}</h5>
            </div>
        </div>
        @endforeach
    </div>



</div>
<!-- End Products Section -->
<br>
<br>
<br>
<br>
<br>
<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="text-primary">Technician</h6>
            <h1 class="mb-4">Technician Members</h1>
        </div>
        <div class="row g-4">
            @foreach ($data4 as $tech )
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="team-item rounded overflow-hidden">
                    <div class="d-flex">
                        <img class="img-fluid w-75" src="Technician/{{$tech->image}}" alt="">
                    </div>
                    <div class="p-4">
                        <h5>Full Name: {{$tech->name}}</h5>
                        <span><h6>Phone:{{$tech->phone}}</h6></span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

    <!-- Team End -->

    <!-- Back to Top -->



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
