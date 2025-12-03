<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
</head>

<body>
    <!-- Spinner Start -->
    @include('home.navbar')
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Company</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">Company</h6>
                <h1 class="mb-4">Companies that provide the service</h1>
                <!-- إضافة مربع البحث -->
                <div class="input-group">
                    <input type="text" id="searchInput" onkeyup="searchCompanies()" class="form-control" placeholder="Search by company name or location">
                    <button class="btn btn-primary" type="button" onclick="searchCompanies()"><i class="fa fa-search"></i></button>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($data as $company)
                <div class="col-md-6 col-lg-4 wow fadeInUp service-item" data-wow-delay="0.1s">
                    <div class="service-item rounded overflow-hidden">
                        <img class="img-fluid" src="img/img-600x400-1.jpg" alt="">
                        <div class="position-relative p-4 pt-0">
                            <div class="service-icon">
                                <i class="fa fa-solar-panel fa-3x"></i>
                            </div>
                            <h5>Company Name :</h5><p class="company-name mb-3">{{ $company->name }}</p>
                            <h5>Website</h5><a href="">{{ $company->website }}</a>
                            <h5>Phone</h5><p>{{ $company->phone }}</p>
                            <h5>Location</h5><p class="company-location">{{ $company->location }}</p>
                            <a class="small fw-medium" href="{{ route('home.Details', ['companyId' => $company->id]) }}">Details<i class="fa fa-arrow-right ms-2"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

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

    <!-- Search Script -->
    <script type="text/javascript">
        function searchCompanies() {
            var input, filter, container, serviceItems, companyName, companyLocation, i, txtValueName, txtValueLocation;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            container = document.querySelector(".container .row");
            serviceItems = container.getElementsByClassName("service-item");

            for (i = 0; i < serviceItems.length; i++) {
                companyName = serviceItems[i].querySelector(".company-name");
                companyLocation = serviceItems[i].querySelector(".company-location");

                if (companyName || companyLocation) {
                    txtValueName = companyName.textContent || companyName.innerText;
                    txtValueLocation = companyLocation.textContent || companyLocation.innerText;

                    if (txtValueName.toUpperCase().indexOf(filter) > -1 || txtValueLocation.toUpperCase().indexOf(filter) > -1) {
                        serviceItems[i].style.display = "";
                    } else {
                        serviceItems[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>

</html>
