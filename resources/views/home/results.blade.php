<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
</head>

<body>
    @include('home.navbar')

    <!-- نتائج البحث -->
    <div class="container mt-4">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="text-primary">Search Results</h6>
            <h1 class="mb-4">Search results for "{{ request()->query('query') }}"</h1>
        </div>

        @if ($data1->isEmpty() && $data2->isEmpty() && $data3->isEmpty() && $data4->isEmpty() && $data5->isEmpty() && $data6->isEmpty())
            <div class="alert alert-warning" role="alert">
                No results found.
            </div>
        @endif

        <!-- Inverters -->
        @if (!$data1->isEmpty())
            <div class="mb-5">
                <h3>Inverters</h3>
                <div class="row">
                    @foreach ($data1 as $inverter)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <img src="inverter/{{ $inverter->image }}" class="card-img-top"
                                    alt="{{ $inverter->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $inverter->name }}</h5>
                                    <p class="card-text">{{ $inverter->description }}</p>
                                    <a href="{{ route('inverter.details', ['type' => 'inverter', 'id' => $inverter->id]) }}"
                                        class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Batteries -->
        @if (!$data2->isEmpty())
            <div class="mb-5">
                <h3>Batteries</h3>
                <div class="row">
                    @foreach ($data2 as $battery)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <img src="Battery/{{ $battery->image }}" class="card-img-top"
                                    alt="{{ $battery->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $battery->name }}</h5>
                                    <p class="card-text">{{ $battery->description }}</p>
                                    <a href="{{ route('battery.details', ['type' => 'battery', 'id' => $battery->id]) }}"
                                        class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Solar Panels -->
        @if (!$data3->isEmpty())
            <div class="mb-5">
                <h3>Solar Panels</h3>
                <div class="row">
                    @foreach ($data3 as $solar)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <img src="SolarPanel/{{ $solar->image }}" class="card-img-top"
                                    alt="{{ $solar->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $solar->name }}</h5>
                                    <p class="card-text">{{ $solar->description }}</p>
                                    <a href="{{ route('solar.details', ['id' => $solar->id]) }}"
                                        class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif


        <!-----Categories--------->
        @if (!$data6->isEmpty())
        <div class="mb-5">
            <h3>Categories</h3>
            <div class="row">
                @foreach ($data6 as $categories)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            <img src="Categories/{{ $categories->image }}" class="card-img-top"
                                alt="{{ $categories->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $categories->name }}</h5>
                                <p class="card-text">{{ $categories->description }}</p>
                                <a href="{{ route('category.details', ['id' => $categories->id]) }}"
                                    class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


        <!-- Technicians -->
        @if (!$data4->isEmpty())
            <div class="mb-5">
                <h3>Technicians</h3>
                <div class="row">
                    @foreach ($data4 as $tech)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <img src="Technician/{{ $tech->image }}" class="card-img-top"
                                    alt="{{ $tech->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $tech->name }}</h5>
                                    <p class="card-text">{{ $tech->phone }}</p>
                                    <a href="{{ route('tech.details', ['type' => 'technician', 'id' => $tech->id]) }}"
                                        class="btn btn-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Companies -->
        @if (!$data5->isEmpty())
        <div class="mb-5">
            <h3>Companies</h3>
            <div class="row">
                @foreach ($data5 as $company)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            <img src="img/img-600x400-1.jpg" class="card-img-top" alt="{{ $company->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $company->name }}</h5>
                                <p class="card-text">{{ $company->phone }}</p>
                                <a href="{{ route('home.Details', ['companyId' => $company->id]) }}" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- JavaScript الخاص بالقالب -->
    <script src="js/main.js"></script>
</body>

</html>
