@extends('layouts.app')

@section('content')

<div class="container">
{{ $articles->links() }}

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
    @foreach ($articles as $article )

    <div class="card mb-2 shadow">
        <div class="card-body">
            <div class="col-12  img">
                <img src="{{ url('./storage/images/'.$article->image) }}" alt="" width="100%" style="border: 1.5px solid gray; border-radius:8px" class="float-end  ">
            </div>
           <div class="col-12 col-lg-6 col-md-6" >
            
             <h5 class="card-title">{{ $article->title }}</h5>
            
                <div class="card-subtitle mb-2 text-muted small">{{ $article->created_at->diffForHumans() }}</div>

                <p class="card-text">{{ $article->body }}</p><br>

                <a href="{{ url("/articles/detail/$article->id") }}" class="btn btn-success ">View detail  &raquo;</a>
                </div>
           </div>
    </div>
   
    @endforeach
</div>

@endsection