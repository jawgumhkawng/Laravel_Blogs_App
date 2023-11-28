@extends('layouts.app')

@section('content')

<div class="container ">
<div class="row">

<div class="col-lg-6 col-6"> 
    {{ $articles->links() }}
</div>
<div class="col-lg-6 col-6 ">
   
<button type="button" class=" text-white mt-2 float-end link " style="border:none; padding:0; background:none; font-size:20px; " data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">{{ $user->name }} <i class="fa-solid fa-user"></i></button>
 
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="card" style="width: 100%;">
        <img src="{{ url('./images/20231127084949.jpg') }}" class="card-img-top" style="border: 2px solid gray; border-radius:10px" height="100%" alt="..."><br>
        <form action="{{ route('articles.upload') }}" method="post" class="form-control" enctype="multipart/form-data">
            @csrf
            
            <input type="file" name="image" class="form-control"><br>
            <button class="btn btn-primary float-end">Submit</button>
        </form>
        <div class="card-body">
            <h5 class="card-title h4">Name : {{ $user->name }}</h5>
            <p class="card-text">Email : {{ $user->email }}</p>
            {{-- <a href="#" class="btn btn-primary" data-bs-dismiss="modal">Close</a> --}}
        </div>
        </div>
      
       
      
    </div>
  </div>
</div>

@if (session('Created'))

    <div class="alert alert-info alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
        <strong>Created!</strong>{{session('Created')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx" aria-label="Close"></button>
    </div>      

@endif

@if (session('Deleted'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
        <strong>Deleted!</strong>{{session('Deleted')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>      

@endif
    

    <div class="card mb-2 shadow bg-derk text-white" style=" user-select:none;">
        <div class="card-body">
            @foreach ($articles as $article )
            <div class="col-12  img mt-3 mb-5">
                <img src="{{ url('./storage/images/'.$article->image) }}" alt="" width="100%" style="border: 1.5px solid gray; border-radius:8px" class="float-end  ">
            </div>
           <div class="col-12 col-lg-6 col-md-6 mb-5 " >
            
             <h5 class="card-title">{{ $article->title }}</h5>
            
                <div class="card-subtitle mb-2 text-info small">{{ $article->created_at->diffForHumans() }}</div>

                <p class="card-text">{{ $article->body }} <a href="{{ url("/articles/detail/$article->id") }}" class="text-decoration-none ">..see more  </a></p><br>

               
             </div>
             <hr>
   
    @endforeach
               </div>
    </div>
</div>
</div>
@endsection