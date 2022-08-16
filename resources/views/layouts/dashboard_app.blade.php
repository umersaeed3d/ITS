<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

	<!-- My CSS -->
	<link rel="stylesheet" href="/css/adminDashboard.css">
    <link rel="stylesheet" href="/css/adminInventory.css">
	<link rel="stylesheet" href="/css/modal.css">

	<!-- refer font styles-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

	<!-- refer icons-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


	<title>ITS | Dashboard</title>
</head>

<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="/home" class="brand">
			<i class='bx bxs-package'></i>
			<span class="text">Inventory Tracking System</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="/home">
					<i class='bx bxs-home'></i>
					<span class="text">Home</span>
				</a>
			</li>

            @if(in_array('lab_view',Session::get('permissions')))

            <li>
				<a href="/labs">
					<i class='bx bxs-flask'></i>
					<span class="text">Labs</span>
				</a>
			</li>

            @endif

            @if(in_array('category_view',Session::get('permissions')))

            <li>
				<a href="/categories">
					<i class='bx bxs-category'></i>
					<span class="text">Categories</span>
				</a>
			</li>

            @endif
            @if(in_array('inventory_view_all',Session::get('permissions')) or in_array('inventory_view_specific',Session::get('permissions')))
			<li>
				<a href="/inventories">
					<i class='bx bxs-package'></i>
					<span class="text">Inventory</span>
				</a>
			</li>
            @endif
            @if(in_array('user_view',Session::get('permissions')))
			<li>
				<a href="/users">
					<i class='bx bxs-group'></i>
					<span class="text">Users</span>
				</a>
			</li>
            @endif
			<li>
				<a href="/logout" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">

		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
			<a href="#" class="nav-link">Home</a>
			<form action="#">
				<div class="form-input">
					<i style="padding:5px; font-size: 20px;" class='bx bx-barcode-reader'></i>
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<!-- <input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a> -->
			<a href="#" class="nav-link">Logged in as: <h2 class="brand">{{ auth()->user()->user_name }}</h2></a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>

                        <?php $segments = ''; ?>
                        @foreach(Request::segments() as $segment)
                            <?php $segments .= '/'.$segment; ?>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li>
                                <a class="active" href="{{ $segments }}">{{$segment}}</a>
                            </li>
                        @endforeach

					</ul>
				</div>

			</div>

			<div class="container">
                <br>
                <br>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <p><strong>Opps Something went wrong</strong></p>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                @yield('main')
            </div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js">
	<script src="/js/script.js"></script>
    <script src="/js/modal.js"></script>
	<script src="/js/slideLeft.js"></script>
    </script>
</body>

</html>
