<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
</head>

<body>
    @include('home.navbar')
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Technician</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <!-- Breadcrumb placeholder -->
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">Technician</h6>
                <h1 class="mb-4">Technician Information</h1>
                <div class="input-group">
                    <input type="text" id="searchInput" onkeyup="searchTechnicians()" class="form-control" placeholder="Search by name, company, or phone">
                    <button class="btn btn-primary" type="button" onclick="searchTechnicians()"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s" id="techniciansContainer">
                @foreach ($data as $technician)
                    <div class="testimonial-item text-center technician-item">
                        <div class="testimonial-img position-relative">
                            <div class="btn-square bg-primary rounded-circle">
                                <i class="fa fa-quote-left text-white"></i>
                            </div>
                            <img class="img-fluid rounded-circle mx-auto mb-5" src="{{ asset('Technician/' . $technician->image) }}">
                        </div>
                        <h5 class="mb-1 technician-name">Name: {{ $technician->name }}</h5>
                        <div class="testimonial-text text-center rounded p-4">
                            <h5>Work For:</h5>
                            <p class="technician-company">{{ $technician->company->name }}</p>
                            <p><h5>Information</h5> {{ $technician->info }}</p>
                            <span class="fst-italic"><h5>Phone</h5><span class="technician-phone">{{ $technician->phone }}</span></span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

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
    <script>
        function searchTechnicians() {
            var input, filter, technicianItems, technicianName, technicianCompany, technicianPhone, i, txtValueName, txtValueCompany, txtValuePhone, carousel;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            technicianItems = document.querySelectorAll(".technician-item");
            carousel = $(".testimonial-carousel");
            let foundIndex = -1;

            for (i = 0; i < technicianItems.length; i++) {
                technicianName = technicianItems[i].querySelector(".technician-name");
                technicianCompany = technicianItems[i].querySelector(".technician-company");
                technicianPhone = technicianItems[i].querySelector(".technician-phone");

                if (technicianName || technicianCompany || technicianPhone) {
                    txtValueName = technicianName.textContent || technicianName.innerText;
                    txtValueCompany = technicianCompany.textContent || technicianCompany.innerText;
                    txtValuePhone = technicianPhone.textContent || technicianPhone.innerText;

                    if (txtValueName.toUpperCase().indexOf(filter) > -1 || txtValueCompany.toUpperCase().indexOf(filter) > -1 || txtValuePhone.toUpperCase().indexOf(filter) > -1) {
                        technicianItems[i].style.display = "";
                        if (foundIndex === -1) {
                            foundIndex = i;
                        }
                    } else {
                        technicianItems[i].style.display = "none";
                    }
                }
            }

            if (foundIndex !== -1) {
                // بعد عرض العناصر المناسبة، قم بإعادة تهيئة الكاروسيل والتحرك إلى العنصر المحدد
                carousel.owlCarousel('destroy'); // تدمير الكاروسيل الحالي
                carousel.owlCarousel({ // إعادة تهيئة الكاروسيل مع تعيين العنصر الحالي
                    autoplay: false,
                    items: 1,
                    loop: false,
                    startPosition: foundIndex
                });
            } else {
                carousel.trigger('play.owl.autoplay');
            }
        }

        $(document).ready(function(){
            // Initialize the carousel with autoplay
            $(".testimonial-carousel").owlCarousel({
                autoplay: true,
                items: 1,
                loop: true
            });
        });
    </script>
</body>

</html>
