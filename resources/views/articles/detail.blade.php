@extends('layouts.app')

@section('content')

    <div class="container bg-derk">
        @if (session('CmtCreate'))
            <div class="alert alert-info alert-dismissible fade show" role="alert"
                style="transition: all 1s ease; user-select:none;">
                <strong>Created!</strong>{{ session('CmtCreate') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx" aria-label="Close"></button>
            </div>
        @endif

        @if (session('Auth'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
                <strong>Created!</strong>{{ session('Auth') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx"
                    aria-label="Close"></button>
            </div>
        @endif

        @if (session('CmtDel'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
                <strong>Deleted!</strong>{{ session('CmtDel') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx"
                    aria-label="Close"></button>
            </div>
        @endif
        <div class="card mb-2 shadow bg-derk " style=" user-select:none;">
            <div class="card-body">
                <div class="col-12  img">
                    <img src="{{ url('./images/' . $articles->image) }}" alt="" width="100%"
                        style="border: 1.5px solid gray; border-radius:8px" class="float-end mt-lg-3 ">
                </div>
                <div class="col-12 col-lg-6 col-md-6">

                    <h5 class="card-title fw-bold">{{ $articles->title }}</h5>
                    <div class="text-muted small" style="cursor:pointer;">
                        <b class="text-success">By : {{ $articles->user->name }}</b><br>

                        @if ($articles->category->id == 1)
                            <b>Category : </b><span class="btn btn-sm btn-success p-0 px-1 m-0 text-white">
                                {{ $articles->category->name }}</span> |
                        @elseif($articles->category->id == 2)
                            <b>Category : </b><span class="btn btn-sm btn-info p-0 px-1 m-0 text-white">
                                {{ $articles->category->name }}</span> |
                        @elseif($articles->category->id == 3)
                            <b>Category : </b><span class="btn btn-sm btn-secondary p-0 px-1 m-0 text-white">
                                {{ $articles->category->name }}</span> |
                        @elseif($articles->category->id == 4)
                            <b>Category : </b><span class="btn btn-sm btn-primary p-0 px-1 m-0 text-white">
                                {{ $articles->category->name }}</span> |
                        @else
                            <b>Category : </b><span class="btn btn-sm btn-warning p-0 px-1 m-0 text-white">
                                {{ $articles->category->name }}</span> |
                        @endif

                        <b>Comments : </b> <b class="text-primary"> {{ count($articles->comments) }}</b> |
                        <span class="text-muted">{{ $articles->created_at->diffForHumans() }}...</span> | <span
                            class="text-muted">{{ date('d-m-Y', strtotime($articles->created_at)) }}</span>
                    </div>

                    {{-- <div class="card-subtitle mb-2 text-info small">{{ $articles->created_at->diffForHumans() }},Category: <b>{{ $articles->category->name }}</b> --}}
                </div>

                <p class="card-text col-lg-8">{{ $articles->body }}</p><br>

                <a href="{{ url('/articles') }}" title="Back" class="btn btn-secondary px-3"><i
                        class="fa-solid fa-circle-left"></i> </a>
                @auth
                    @can('article-delete', $articles)
                        <a href="{{ url("/articles/edit/$articles->id") }}" title="Edit" class="btn  btn-warning px-3"><i
                                class="fa-solid fa-gear"></i></a>
                        <a href="{{ url("/articles/delete/$articles->id") }}" title="Delete"
                            onclick="return confirm('Are you sure, you want to DELETE this Article {{ $articles->title }}?')"
                            class="btn  btn-danger px-3"><i class="fa-solid fa-trash"></i> </a>
                    @endcan
                @endauth

            </div>
        </div>


        <ul class="list-group mb-3 shadow " style=" user-select:none;">
            <li class="list-group-item active bg-derk">
                <b>Comment ({{ count($articles->comments) }})</b>
            </li>


            @foreach ($articles->comments as $comment)
                <li class="list-group-item bg-derk ">
                    @can('comment-delete', $comment)
                        <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end ms-5"
                            onclick="return confirm('Are you sure, you want to DELETE this comment {{ $comment->content }}?')">
                        </a>
                    @endcan
                    - {{ $comment->content }}
                    <div class="small mt-2">
                        @if ($comment->user->image)
                            <img src="{{ url('./images/' . $comment->user->image) }}" alt="" width="26px"
                                height="26px" style="border: 1px solid grey" class="rounded-circle  "><b
                                class="ms-1 text-success"> {{ $comment->user->name }}</b>,
                        @else
                            <img src="{{ url('./images/fake_profile.jpg') }}" alt="" width="26px" height="26px"
                                style="border: 1px solid grey" class="rounded-circle  "><b class="ms-1 text-success">
                                {{ $comment->user->name }}</b>,
                        @endif
                        <span class="text-muted text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </li>
            @endforeach
        </ul>

        @if ($errors->any())
            <div class="alert alert-warning">
                <ol>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif

        @auth
            <form action="{{ url('/comments/add') }}" class="bg-derk" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $articles->id }}">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <textarea type="text" name="content" placeholder="New Comment" class="form-control mb-2 bg-derk " required></textarea>
                <input type="submit" value="Add Comment" class="btn btn-primary" name="" id="">

            </form>
        @endauth

    </div>
    </div>
    <br>
    <hr>
@endsection
