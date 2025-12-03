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

    <div class="container-xxl py-5 center-screen">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-4">Technician Information</h1>
            </div>
            <div id="productDetails" class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s">
                    <div class="team-item rounded overflow-hidden">
                        <div class="d-flex justify-content-center">
                            <img class="img-fluid w-75" src="/Technician/{{ $tech->image }}" alt="{{ $tech->name }}">
                        </div>
                        <div class="p-4">
                            <h5>Name:</h5>
                            <p>{{ $tech->name }}</p>
                            <h5>Phone:</h5>
                            <p>{{ $tech->phone }}</p>
                            <h5>Work For:</h5>
                            <p class="technician-company">{{ $tech->company->name }}</p>
                            <h5>Information:</h5>
                            <p>{{ $tech->info }}</p>
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
