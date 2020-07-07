<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Toko Online</title>
    <link rel="shortcut icon" href="{{ asset('images/basket.png') }}" type="image/x-icon" />
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet" />    
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <livewire:styles />
    <livewire:scripts />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>

<body style="background-color: #e2e8f0;">

    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark text-white mb-5"
        style="background-color: #171d26!important;">
        <a href="/" class="navbar-brand font-weight-bold"><i class="fa fa-carrot"></i> SK STORE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-sk">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar-sk">
            <!-- categories -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa fa-list-ul"></i> CATEGORIES
                    </a>
                </li>
            </ul>
            <!-- end categories -->

            <!-- search -->
            <div class="mx-2 my-auto d-inline" style="width: 45%">
                <div class="input-group">
                    <input type="text" class="form-control border border-right-0" placeholder="Search...">
                    <span class="input-group-append">
                        <button class="btn text-dark border border-left-0" style="background-color: white" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
            <!-- end search -->

            <ul class="nav navbar-nav navbar-right ml-auto">
                
                <!-- cart -->
                <div>
                    <li class="nav-item ml-3 mr-3">
                        <a href="" class="btn btn-md shadow btn-outline-dark btn-block" style="color: #333;background-color: #fff;border-color: #fff;"><i class="fa fa-shopping-cart"></i> 0 | 0</a>
                    </li>
                </div>
                <!-- end cart -->

                @if (Auth::guard('customer')->check())
                <ul class="navbar-nav d-none d-md-block ml-4">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle font-weight-bold text-white" href="#" id="navbarDropdown"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle"></i> {{ Auth::guard('customer')->user()->name }}
                        </a>
                        <div class="dropdown-menu border-0 shadow" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/customer/dashboard"><i
                                    class="fa fa-tachometer-alt"></i> DASHBOARD</a>
                            <a class="dropdown-item" href="/customer/orders"><i class="fa fa-shopping-cart"></i> MY ORDERS</a>
                            <div class="dropdown-divider"></div>
                            <livewire:customer.auth.logout />
                        </div>
                </ul>
                @else
                <li class="nav-item">
                    <a href="/customer/login" class="btn btn-md shadow btn-outline-dark btn-block"
                        style="color: #fff;background-color: #343a40;border-color: #343a40;"><i
                            class="fa fa-user-circle"></i> ACCOUNT</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>

    @if (Auth::guard('customer')->check() && request()->segment(1) == "customer")
    <div class="jumbotron rounded-0" style="background-color: #566479;padding-bottom:8rem">
        <div class="container">
        </div>
    </div>
    @endif

    <div class="container-fluid mb-5">

        @yield('content')

    </div>

    <script>
        @if(session()->has('success'))
            toastr.success('{{ session('success') }}')
        @elseif(session()->has('error'))
            toastr.error('{{ session('error') }}')
        @endif

        window.livewire.on('alert', param => {
            toastr[param['type']](param['message']);
            toastr.options.preventDuplicates = true;
        });
    </script>
</body>
</html>