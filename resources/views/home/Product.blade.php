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
            <h1 class="display-3 text-white mb-3 animated slideInDown">All Product</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Search Form Start -->
    <div class="container mb-5">
        <div class="d-flex justify-content-center">
            <input id="searchInput" type="text" class="form-control me-2" placeholder="Search by name" style="max-width: 300px;">
            <select id="categorySelect" class="form-select me-2" style="max-width: 200px;">
                <option value="">All Categories</option>
                <option value="inverter">Inverter</option>
                <option value="battery">Battery</option>
                <option value="solar">Solar Panel</option>
                <option value="categories">Categories</option>
            </select>
            <select id="priceSortSelect" class="form-select me-2" style="max-width: 200px;">
                <option value="">Sort by Price</option>
                <option value="asc">Price: Low to High</option>
                <option value="desc">Price: High to Low</option>
            </select>
        </div>
    </div>
    <!-- Search Form End -->



    <!-- Product Listings Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">Product</h6>
                <h1 class="mb-4">All Product</h1>
            </div>

            <div id="productList" class="row g-4">
                <!-- Inverters -->
                @foreach ($data1 as $inverter)
    <div class="col-lg-4 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s" data-category="inverter">
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
                @if($inverter->quantities > 0)
                    <a href="{{ route('cart.inverter', ['id' => $inverter->id]) }}" style="display: inline-block; padding: 10px 20px; background-color: #088f0d; color: white; text-decoration: none; border-radius: 4px; font-size: 16px; transition: background-color 0.3s ease;">Add To Cart</a>
                @else
                    <p style="color: red;">Out of stock</p>
                @endif
            </div>
        </div>
    </div>
@endforeach

                <!-- Batteries -->
                @foreach ($data2 as $battery)
                <div class="col-lg-4 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s" data-category="battery">
                    <div class="team-item rounded overflow-hidden">
                        <div class="d-flex">
                            <img class="img-fluid w-75" src="Battery/{{$battery->image}}" alt="">
                            <div class="team-social w-25"></div>
                        </div>
                        <div class="p-4">
                            <h5>Battery Name:</h5><p>{{ $battery->name }}</p>
                            <h5>Price:</h5><p class="product-price">{{ $battery->price }}</p>
                            <h5>Capacity:</h5><p>{{ $battery->capacity }}</p>
                            <h5>Type:</h5><p>{{ $battery->type }}</p>
                            <h5>Owner:</h5>
                            @foreach($battery->owns as $own)
                                <p>{{ $own->company->name }}</p>
                            @endforeach
                            @if($battery->quantities > 0)
                                <a href="{{ route('cart.battery', ['id' => $battery->id]) }}" style="display: inline-block; padding: 10px 20px; background-color: #088f0d; color: white; text-decoration: none; border-radius: 4px; font-size: 16px; transition: background-color 0.3s ease;">Add To Cart</a>
                            @else
                                <p style="color: red;">Out of stock</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

                <!-- Solar Panels -->
                @foreach ($data3 as $solar)
                <div class="col-lg-4 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s" data-category="solar">
                    <div class="team-item rounded overflow-hidden">
                        <div class="d-flex">
                            <img class="img-fluid w-75" src="SolarPanel/{{$solar->image}}" alt="">
                            <div class="team-social w-25"></div>
                        </div>
                        <div class="p-4">
                            <h5>SolarPanel Name:</h5><p>{{ $solar->name }}</p>
                            <h5>Price:</h5><p class="product-price">{{ $solar->price }}</p>
                            <h5>Capacity:</h5><p>{{ $solar->capacity }}</p>
                            <h5>Description:</h5><p>{{ $solar->description }}</p>
                            <h5>Owner:</h5>
                            @foreach($solar->owns as $own)
                                <p>{{ $own->company->name }}</p>
                            @endforeach
                            @if($solar->quantities > 0)
                                <a href="{{ route('cart.solar', ['id' => $solar->id]) }}" style="display: inline-block; padding: 10px 20px; background-color: #088f0d; color: white; text-decoration: none; border-radius: 4px; font-size: 16px; transition: background-color 0.3s ease;">Add To Cart</a>
                            @else
                                <p style="color: red;">Out of stock</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

                <!-- Categories -->
                @foreach ($data5 as $categories)
                <div class="col-lg-4 col-md-6 wow fadeInUp product-item" data-wow-delay="0.1s" data-category="categories">
                    <div class="team-item rounded overflow-hidden">
                        <div class="d-flex">
                            <img class="img-fluid w-75" src="Categories/{{$categories->image}}" alt="">
                            <div class="team-social w-25"></div>
                        </div>
                        <div class="p-4">
                            <h5>Categories Name:</h5><p>{{ $categories->name }}</p>
                            <h5>Price:</h5><p class="product-price">{{ $categories->price }}</p>
                            <h5>Description:</h5><p>{{ $categories->description }}</p>
                            <h5>Owner:</h5>
                            @foreach($categories->owns as $own)
                                <p>{{ $own->company->name }}</p>
                            @endforeach
                            @if($categories->quantities > 0)
                                <a href="{{ route('cart.category', ['id' => $categories->id]) }}" style="display: inline-block; padding: 10px 20px; background-color: #088f0d; color: white; text-decoration: none; border-radius: 4px; font-size: 16px; transition: background-color 0.3s ease;">Add To Cart</a>
                            @else
                                <p style="color: red;">Out of stock</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            </div>
        </div>
    </div>
    <!-- Product Listings End -->

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

    <!-- Search and Filter Script -->
    <script>
        const searchInput = document.getElementById('searchInput');
        const categorySelect = document.getElementById('categorySelect');
        const priceSortSelect = document.getElementById('priceSortSelect');
        const productList = document.getElementById('productList');
        const products = Array.from(productList.querySelectorAll('.product-item'));

        searchInput.addEventListener('input', filterProducts);
        categorySelect.addEventListener('change', filterProducts);
        priceSortSelect.addEventListener('change', filterProducts);

        function filterProducts() {
            const searchValue = searchInput.value.toLowerCase();
            const categoryValue = categorySelect.value;
            const sortValue = priceSortSelect.value;

            let filteredProducts = products;

            // فلترة المنتجات بناءً على الاسم والفئة
            if (searchValue) {
                filteredProducts = filteredProducts.filter(product => {
                    const name = product.querySelector('h5 + p').textContent.toLowerCase();
                    return name.includes(searchValue);
                });
            }

            if (categoryValue) {
                filteredProducts = filteredProducts.filter(product => {
                    const category = product.getAttribute('data-category');
                    return category === categoryValue;
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
    </script>
</body>

</html>
