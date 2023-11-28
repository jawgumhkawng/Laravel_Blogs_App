@extends('layouts.app')

@section('content')

<div class="container bg-derk"> 
    @if (session('CmtCreate'))

    <div class="alert alert-info alert-dismissible fade show"  role="alert" style="transition: all 1s ease; user-select:none;">
        <strong>Created!</strong>{{session('CmtCreate')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx" aria-label="Close"></button>
    </div>      

    @endif

      @if (session('Auth'))

    <div class="alert alert-danger alert-dismissible fade show"  role="alert" style="transition: all 1s ease;">
        <strong>Created!</strong>{{session('Auth')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx" aria-label="Close"></button>
    </div>      

    @endif

        @if (session('CmtDel'))

    <div class="alert alert-danger alert-dismissible fade show"  role="alert" style="transition: all 1s ease;">
        <strong >Deleted!</strong>{{session('CmtDel')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx" aria-label="Close"></button>
    </div>      

    @endif
    <div class="card mb-2 shadow bg-derk text-white"  style=" user-select:none;">
            <div class="card-body">
                <div class="col-12  img">
                    <img src="{{ url('./storage/images/'.$articles->image) }}" alt="" width="100%" style="border: 1.5px solid gray; border-radius:8px" class="float-end  ">
                </div>
            <div class="col-12 col-lg-6 col-md-6" >
                
                <h5 class="card-title">{{ $articles->title }}</h5>
                
                    <div class="card-subtitle mb-2 text-info small">{{ $articles->created_at->diffForHumans() }},Category: <b>{{ $articles->category->name }}</b>
                    </div>

                    <p class="card-text">{{ $articles->body }}</p><br>

                    <a href="{{ url("/articles") }}" class="btn btn-warning">Back  </a>
                    @auth
                    @can("article-delete", $articles)
                      <a href="{{ url("/articles/delete/$articles->id") }}" onclick="return confirm('Are you sure, you want to DELETE this {{ $articles->title }}?')" class="btn btn-danger">Delete  </a>
                    @endcan
                    @endauth

                </div>
            </div>
    </div>

    <ul class="list-group mb-3 shadow " style=" user-select:none;">
        <li class="list-group-item active bg-derk">
            <b>Comment ({{ count($articles->comments) }})</b>
        </li>
        @foreach ($articles->comments as $comment )

        <li class="list-group-item bg-derk text-white">
            @can("comment-delete", $comment)
                <a href="{{ url("/comments/delete/$comment->id") }}"
                class="btn-close float-end ms-5">
                </a>
            @endcan
            {{ $comment->content }}
            <div class="small mt-2">
            By <b>{{ $comment->user->name }}</b>,
            {{ $comment->created_at->diffForHumans() }}
            </div>
        </li>
            
        @endforeach
    </ul>

    @auth          
        <form action="{{ url('/comments/add') }}" class="bg-derk" method="post">
         @csrf
        <input type="hidden" name="article_id" value="{{ $articles->id }}">
        <textarea type="text"  name="content" placeholder="New Comment" class="form-control mb-2 bg-derk text-white" ></textarea>
        <input type="submit" value="Add Comment" class="btn btn-secondary" name="" id="">
        
        </form>
    @endauth
   
</div>

@endsection