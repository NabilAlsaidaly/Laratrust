<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')
</head>

<body>
    @include('home.navbar')

    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Inverter</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->



    <!-- Search and Sort Form Start -->
    <div class="container mb-5">
        <form id="searchForm" class="d-flex justify-content-center">
            <input id="searchInput" type="text" class="form-control me-2" placeholder="Search by name" style="max-width: 300px;">
            <select id="sortSelect" class="form-control" style="max-width: 200px; margin-left: 10px;">
                <option value="">Sort by Price</option>
                <option value="asc">Lowest to Highest</option>
                <option value="desc">Highest to Lowest</option>
            </select>
        </form>
    </div>
    <!-- Search and Sort Form End -->

    <!--inverter-->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">Product</h6>
                <h1 class="mb-4">Inverter</h1>
            </div>

            <div id="productList" class="row g-4">
                @foreach ($data as $inverter)
                <div class="col-lg-4 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s">
                    <div class="team-item rounded overflow-hidden">
                        <div class="d-flex">
                            <img class="img-fluid w-75" src="inverter/{{$inverter->image}}" alt="">
                            <div class="team-social w-25"></div>
                        </div>
                        <div class="p-4">
                            <h5>Inverter Name:</h5><p>{{ $inverter->name }}</p>
                            <h5>Price:</h5><p class="product-price">{{ $inverter->price }}</p>
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
            </div>
        </div>
    </div>
    <!--end inverter-->

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

    <!-- Search and Sort Script -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const sortSelect = document.getElementById('sortSelect');
        const productList = document.getElementById('productList');
        const products = Array.from(productList.querySelectorAll('.product-item'));

        searchInput.addEventListener('input', filterProducts);
        sortSelect.addEventListener('change', filterProducts);

        function filterProducts() {
            const searchValue = searchInput.value.toLowerCase();
            const sortValue = sortSelect.value;

            let filteredProducts = products;

            // فلترة المنتجات بناءً على الاسم
            if (searchValue) {
                filteredProducts = products.filter(product => {
                    const name = product.querySelector('h5 + p').textContent.toLowerCase();
                    return name.includes(searchValue);
                });
            }

            // ترتيب المنتجات بناءً على السعر
            if (sortValue) {
                filteredProducts.sort((a, b) => {
                    const priceA = parseFloat(a.querySelector('.product-price').textContent.replace(/[^\d.-]/g, ''));
                    const priceB = parseFloat(b.querySelector('.product-price').textContent.replace(/[^\d.-]/g, ''));
                    return sortValue === 'asc' ? priceA - priceB : priceB - priceA;
                });
            }

            // عرض أو إخفاء المنتجات بناءً على الفلترة والترتيب
            productList.innerHTML = ''; // إفراغ قائمة المنتجات
            filteredProducts.forEach(product => {
                productList.appendChild(product); // إعادة إضافة المنتجات بالترتيب الجديد
            });
        }

        function displayAllProducts() {
            productList.innerHTML = ''; // إفراغ قائمة المنتجات
            products.forEach(product => {
                productList.appendChild(product); // إعادة إضافة جميع المنتجات
            });
        }
    </script>
</body>

</html>
