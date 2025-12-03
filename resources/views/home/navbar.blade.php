<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->


<!-- Topbar Start -->
<div class="container-fluid bg-dark p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small></small>
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                <small></small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small></small>
            </div>
            <div class="h-100 d-inline-flex align-items-center mx-n2">
                <a href="{{ url('shopping') }}" class="btn btn-link rounded-0 border-0 border-end border-secondary me-2">
                    <i class="fas fa-shopping-cart"></i>
                        {{ count((array) session('cart')) + count((array) session('shoppingCart')) + count((array) session('batteryCart')) + count((array) session('categoryCart')) }}
                    </span>
                </a>
                @auth
                <a class="btn btn-link rounded-0 border-0 border-end border-secondary me-2" href="{{ url('/order-history') }}">
                    <i class="fas fa-file-invoice-dollar me-1"></i>
                </a>
            @endauth

            </div>

        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href='/' class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
        <marquee behavior="scroll" direction="right">
            <h4 class="m-0 text-primary">BR SolarEnergy</h4>
        </marquee>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <!-- Add the following line to include the cart icon -->

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href='/' class="nav-item nav-link ">Home</a>
            <a href={{ route('company') }} class="nav-item nav-link">Company</a>
            <a href={{ route('Technician') }} class="nav-item nav-link">Technician </a>
            <a href={{ route('contact') }} class="nav-item nav-link">Contact</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Products</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href={{ route('Product') }} class="dropdown-item">All Product</a>
                    <a href={{ route('Inverter') }} class="dropdown-item">Inverter</a>
                    <a href={{ route('SPanel') }} class="dropdown-item">Solar Panel</a>
                    <a href={{ route('Battery') }} class="dropdown-item">Battery</a>
                    <a href={{ route('Categorie') }} class="dropdown-item">Categories</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                @auth
                    <a href="#" class="nav-link dropdown-toggle" role="button" id="dynamicNameDropdown" data-bs-toggle="dropdown" aria-expanded="false">{{ auth()->user()->name }}</a>
                @else
                    <a href="#" class="nav-link dropdown-toggle" role="button" id="dynamicNameDropdown" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                @endauth
                <ul class="dropdown-menu" aria-labelledby="dynamicNameDropdown">
                    @if (Route::has('login'))
                        @auth
                            <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item btn btn-danger">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            @if (Route::has('register'))
                                <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>


        </div>
        <a href={{ route('Design Sys') }} class="btn btn-primary rounded-0 py-4 px-lg-2 d-none d-lg-block">Create Your Solar System<i class="fa fa-arrow-right ms-3"></i></a>

    </div>
</nav>


