@extends('layouts.app')

@section('content')

<div class="container ">
<div class="text-info"> {{ $articles->links() }}</div>

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
    

    <div class="card mb-2 shadow bg-derk text-white">
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

@endsection