<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">



    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
    @media (min-width: 576px) {
    .img img {
        width: 190px;
        float: right;
        height: 190px; 
    }
  
    }
    .bg-derk {
        background: linear-gradient(to top right, #000, #1c1917);
    }


    </style>
</head>
<body>
    

<div class="container">

    @if($errors->any())
        <div class="alert alert-warning">
            <ol>
                @foreach($errors->all() as $error)
                 <li>{{ $error }}</li>
                @endforeach
            </ol>
        </div>
    @endif

    <form method="post" enctype="multipart/form-data">
     @csrf

    
    <div class="mb-3">
        <label>Title</label>
        <input type="text" name="name" class="form-control">
    </div>

   
    <div class="mb-3">
        <label>Body</label>
        <textarea name="desc" class="form-control"></textarea>
    </div>

     

    <input type="submit" value="Add Article" 
    class="btn btn-primary">
    <a href="{{ url("/admin") }}" class="d-inline-flex focus-ring focus-ring-danger ms-3 py-1 px-2 text-decoration-none border rounded-2"> Back</a>
    </form>
 </div>

</body>
</html>