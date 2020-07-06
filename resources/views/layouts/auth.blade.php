<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Login - Console</title>
 <link rel="shortcut icon" href="{{ asset('images/basket.png') }}" type="image/x-icon"/>
 <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fontawesome/5.13.0/js/all.min.js">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <livewire:styles/>

    
</head>
<body style="background-color: #e2e8f0;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="text-center mb-4">
                <img src="{{ asset('images/basket.png') }}" style="width:100px;background-color: #fff;border-radius: 50%;padding: 8px;">
                <h3 class="font-weight-bold mt-2">SK STORE</h3>
                </div>

                 @yield('content')

            </div>
        </div>
    </div>
    <livewire:scripts/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ mix('js/app.js') }}"></script>
       <style>
           body{
           font-family: 'Quicksand', sans-serif;
           }
       </style>
 <script>

 @if(session()->has('success'))
    toastr.success('{{ session('success') }}')
 @elseif(session()->has('error'))
    toastr.error('{{ session('error') }}')
 @endif

 </script>
</body>
</html>