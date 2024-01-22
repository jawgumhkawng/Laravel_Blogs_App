@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-6">
                {{ $articles->withQueryString()->links() }}
            </div>



            @auth
                <div class="col-lg-6 col-6 ">

                    <button type="button" class="  mt-2 float-end link text-primary " title="View Profile"
                        style="border:none; cursor:pointer; padding:0; background:none; font-size:20px; " data-bs-toggle="modal"
                        data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap"> <i
                            class="fa-solid fa-user"></i></button>

                </div>

                <div class="modal fade " id="exampleModal" style="user-select: none" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="card d-flex justify-content-center align-items-center" style="width: 100%;">
                                @if ($user->image)
                                    <img src='{{ url("./images/$user->image") }}' class="card-img-top rounded-circle mt-4"
                                        style="border: 2px solid gray; height:220px; width:220px" alt="..."><br>
                                @else
                                    <p class="text-muted mt-3">Set Your Profile Image!</p>
                                    <form action="{{ route('users.upload') }}" method="post" class="form-control mt-5"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $user->id }}">
                                        <input type="file" name="image" class="form-control"><br>
                                        <button class="btn btn-sm btn-primary float-end">Submit</button>
                                    </form>
                                @endif


                                <div class="card-body">
                                    <h5 class="card-title h4">Name : {{ $user->name ? $user->name : '' }}</h5>
                                    <p class="card-text">Email : {{ $user->email ? $user->email : '' }}</p>
                                    {{-- <a href="#" class="btn btn-primary" data-bs-dismiss="modal">Close</a> --}}
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            @endauth

            @if (session('Created'))
                <div class="alert alert-info alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
                    <strong>Created!</strong>{{ session('Created') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx"
                        aria-label="Close"></button>
                </div>
            @endif

            @if (session('search'))
                <div class="alert alert-info alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
                    <strong>Search!</strong>{{ session('search') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx"
                        aria-label="Close"></button>
                </div>
            @endif

            @if (session('Updated'))
                <div class="alert alert-info alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
                    <strong>Updated!</strong>{{ session('Updated') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx"
                        aria-label="Close"></button>
                </div>
            @endif

            @if (session('Deleted'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
                    <strong>Deleted!</strong>{{ session('Deleted') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <hr>

            <div class="d-flex mt-3">
                <div class="row">

                    @forelse($articles as $key => $article)
                        <div class="col-lg-4 col-md-6 col-12 mb-lg-4 mb-4 items-center" id="card" style="">
                            <a href='{{ url("/articles/detail/$article->id") }}' style="text-decoration:none;">
                                <div class="card shadow article-image" style="width: 100%;">
                                    <img src="{{ url('./images/' . $article->image) }}" class="card-img-top "
                                        style=" width: 100%;" alt="...">
                                    <div class="card-body">
                                        <h4 class="card-title fw-bold">{{ $article->title }}</h4>
                                        <div class="text-muted small" style="cursor:pointer;">
                                            <b>Author : </b><b class="text-success">{{ $article->user->name }}</b><br>
                                            @if ($article->category->id == 1)
                                                <b>Category : </b><span
                                                    class="btn btn-sm btn-success p-0 px-1 m-0 text-white">
                                                    {{ $article->category->name }}</span><br>
                                            @elseif($article->category->id == 2)
                                                <b>Category : </b><span class="btn btn-sm btn-info p-0 px-1 m-0 text-white">
                                                    {{ $article->category->name }}</span><br>
                                            @elseif($article->category->id == 3)
                                                <b>Category : </b><span
                                                    class="btn btn-sm btn-secondary p-0 px-1 m-0 text-white">
                                                    {{ $article->category->name }}</span><br>
                                            @elseif($article->category->id == 4)
                                                <b>Category : </b><span
                                                    class="btn btn-sm btn-primary p-0 px-1 m-0 text-white">
                                                    {{ $article->category->name }}</span><br>
                                            @else
                                                <b>Category : </b><span
                                                    class="btn btn-sm btn-warning p-0 px-1 m-0 text-white">
                                                    {{ $article->category->name }}</span><br>
                                            @endif
                                            <b>Comments : </b> <b class="text-primary">
                                                {{ count($article->comments) }}</b> |
                                            <span class="text-muted">{{ $article->created_at->diffForHumans() }}...</span>
                                            |
                                            <span
                                                class="text-muted">{{ date('d-m-Y', strtotime($article->created_at)) }}</span>
                                        </div><br>
                                        <p class="card-text ">{{ substr($article->body, 0, 60) }}... </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <h5 class="fw-bold text-danger mb-4">There is no articles yet</h5>
                    @endforelse

                </div>
            </div>

            <div class="col-lg-6 col-6">
                {{ $articles->withQueryString()->links() }}
            </div>

            <hr>

        </div>
    </div>
@endsection
