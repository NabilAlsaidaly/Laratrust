<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">

    <div class="title">

        <h1 class="h5" style="color:bisque">{{ auth()->user()->name }}</h1>
        <p style="color:aquamarine">{{ auth()->user()->usertype }}</p>
    </div>
    </div>
    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="nav-item" id="homeNav">
            <a href="{{ url('index') }}" class="nav-link active"><i class="icon-home"></i> Home</a>
        </li>

        <li class="nav-item" id="BRNav">
            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="icon-user"></i>Profile</a></li>
        </li>

        <li class="nav-item">
            <a href="#productsDropdown" aria-expanded="false" data-toggle="collapse" class="nav-link">
                <i class="icon-windows"></i> Products
            </a>
            <ul id="productsDropdown" class="collapse list-unstyled">
                <li><a href="{{ url('View_All') }}" class="nav-link">All Product</a></li>
                <li class="nav-item" id="inverterNav">
                    <a href="#inverterDropdown" aria-expanded="false" data-toggle="collapse" class="nav-link">
                        <i class="icon-windows"></i> Inverter
                    </a>
                    <ul id="inverterDropdown" class="collapse list-unstyled">
                        <li><a href="{{ url('View_Inverter') }}" class="nav-link">View Inverter</a></li>
                    </ul>
                </li>
                <li class="nav-item" id="solarNav">
                    <a href="#solarDropdown" aria-expanded="false" data-toggle="collapse" class="nav-link">
                        <i class="icon-windows"></i> Solar Panel
                    </a>
                    <ul id="solarDropdown" class="collapse list-unstyled">
                        <li><a href="{{ url('View_Solar') }}" class="nav-link">View Solar Panel</a></li>
                    </ul>
                </li>
                <li class="nav-item" id="batteryNav">
                    <a href="#batteryDropdown" aria-expanded="false" data-toggle="collapse" class="nav-link">
                        <i class="icon-windows"></i> Battery
                    </a>
                    <ul id="batteryDropdown" class="collapse list-unstyled">
                        <li><a href="{{ url('View_Battery') }}" class="nav-link">View Battery</a></li>
                    </ul>
                </li>
                <li class="nav-item" id="categoriesNav">
                    <a href="#categoriesDropdown" aria-expanded="false" data-toggle="collapse" class="nav-link">
                        <i class="icon-windows"></i> Categories
                    </a>
                    <ul id="categoriesDropdown" class="collapse list-unstyled">
                        <li><a href="{{ url('View_Categories') }}" class="nav-link">View Categories</a></li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="nav-item" id="userNav">
            <a href="{{url('View_User')}}" class="nav-link"><i class="icon-user"></i> User</a>
        </li>

        <li class="nav-item" id="techNav">
            <a href="{{url('Admin_Tech')}}" class="nav-link"><i class="icon-user"></i>Technician</a>
        </li>

        <li class="nav-item" id="userNav">
            <a href="{{url('View_Companies')}}" class="nav-link"><i class="fas fa-building"></i>Companies</a>
        </li>

        <li class="nav-item" id="providerNav">
            <a href="{{url('View_Provider')}}" class="nav-link"><i class="fas fa-file-alt"></i>Provider Request</a>
        </li>

        <li class="nav-item" id="providerNav">
            <a href="{{url('View_Messages')}}" class="nav-link"> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                    <i class="fas fa-envelope"></i> User Messages</a>
        </li>

    </ul>


</nav>

</script>

