<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="title">
            <h1 class="h5" style="color:bisque">Company Name:  {{ auth()->user()->company->name  }} </h1>
            <p style="color:aquamarine">User Name:    {{ auth()->user()->name }}</p>
            @if (!auth()->user()->is_active)
            <div class="alert alert-danger" role="alert">
                Your Account is Not Active,To Know The Details.
                <a href="{{url('contact')}}" style="color: blue">Contact The Administrator</a>
            </div>
        @endif
        </div>
    </div>
    <!-- Sidebar Navigation Menus-->
    <span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="nav-item" id="homeNav">
            <a href="{{ url('indexx') }}" class="nav-link active"><i class="icon-home"></i> Home</a>
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
                        <li><a href="{{ url('Add_Inverter') }}" class="nav-link">Add Inverter</a></li>
                        <li><a href="{{ url('View_Inverter') }}" class="nav-link">View Inverter</a></li>
                    </ul>
                </li>
                <li class="nav-item" id="solarNav">
                    <a href="#solarDropdown" aria-expanded="false" data-toggle="collapse" class="nav-link">
                        <i class="icon-windows"></i> Solar Panel
                    </a>
                    <ul id="solarDropdown" class="collapse list-unstyled">
                        <li><a href="{{ url('Add_Solar') }}" class="nav-link">Add Solar Panel</a></li>
                        <li><a href="{{ url('View_Solar') }}" class="nav-link">View Solar Panel</a></li>
                    </ul>
                </li>
                <li class="nav-item" id="batteryNav">
                    <a href="#batteryDropdown" aria-expanded="false" data-toggle="collapse" class="nav-link">
                        <i class="icon-windows"></i> Battery
                    </a>
                    <ul id="batteryDropdown" class="collapse list-unstyled">
                        <li><a href="{{ url('Add_Battery') }}" class="nav-link">Add Battery</a></li>
                        <li><a href="{{ url('View_Battery') }}" class="nav-link">View Battery</a></li>
                    </ul>
                </li>
                <li class="nav-item" id="categoriesNav">
                    <a href="#categoriesDropdown" aria-expanded="false" data-toggle="collapse" class="nav-link">
                        <i class="icon-windows"></i> Categories
                    </a>
                    <ul id="categoriesDropdown" class="collapse list-unstyled">
                        <li><a href="{{ url('Add_Categories') }}" class="nav-link">Add Categories</a></li>
                        <li><a href="{{ url('View_Categories') }}" class="nav-link">View Categories</a></li>
                    </ul>
                </li>
            </ul>
            <li class="nav-item" id="technicianNav">
                <a href="#technicianDropdown" aria-expanded="false" data-toggle="collapse" class="nav-link">
                    <i class="icon-user"></i> Technician
                </a>
                <ul id="technicianDropdown" class="collapse list-unstyled">
                    <li><a href="{{ url('Add_Technician') }}" class="nav-link">Add Technician</a></li>
                    <li><a href="{{ url('View_Technician') }}" class="nav-link">View Technician</a></li>
                </ul>
            </li>

            <li class="nav-item" id="BillsNav">
                <a href="{{ url('View_Bills') }}" class="nav-link active"><i class="fas fa-file-invoice"></i>
                    Bills</a>
            </li>

        </li>
    </ul>

</nav>
