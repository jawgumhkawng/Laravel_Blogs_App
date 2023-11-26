@extends('layouts.app')

@section('content')

<div class="container"> 
    <div class="card mb-2 shadow">
            <div class="card-body">
                <div class="col-12  img">
                    <img src="{{ url('./storage/images/'.$articles->image) }}" alt="" width="100%" style="border: 1.5px solid gray; border-radius:8px" class="float-end  ">
                </div>
            <div class="col-12 col-lg-6 col-md-6" >
                
                <h5 class="card-title">{{ $articles->title }}</h5>
                
                    <div class="card-subtitle mb-2 text-muted small">{{ $articles->created_at->diffForHumans() }},Category: <b>{{ $articles->category->name }}</b>
                    </div>

                    <p class="card-text">{{ $articles->body }}</p><br>

                    <a href="{{ url("/articles") }}" class="btn btn-warning">Back  </a>
                    <a href="{{ url("/articles/delete/$articles->id") }}" onclick="return confirm('Are you sure, you want to DELETE this {{ $articles->title }}?')" class="btn btn-danger">Delete  </a>
                    </div>
            </div>
    </div>

    <ul class="list-group">
        <li class="list-group-item active">
            <b>Comment ({{ count($articles->comments) }})</b>
        </li>
        @foreach ($articles->comments as $comment )

        <li class="list-group-item">
            <a href="{{ url("/comments/delete/$comment->id") }}"
                class="btn-close float-end ">
                </a>
            {{ $comment->content }}</li>
            
        @endforeach
    </ul>
   
</div>

@endsection