@extends('layouts.app')

@section('content')

<div class="container ">
<div class="row">

<div class="col-lg-6 col-6"> 
    {{ $articles->links() }}
</div>
@auth
    <div class="col-lg-6 col-6 ">
   
<button type="button" class="  mt-2 float-end link text-primary " style="border:none; cursor:pointer; padding:0; background:none; font-size:20px; " data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap"> <i class="fa-solid fa-user"></i></button>
 
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="card" style="width: 100%;">
        @if($user->image)

           <img src='{{ url("./images/$user->image") }}' class="card-img-top" style="border: 2px solid gray; border-radius:10px" width="100%" alt="..."><br> 
        
        @else

         <form action="{{ route('articles.upload') }}" method="post" class="form-control mt-5" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $user->id }}">
            <input type="file" name="image" class="form-control"><br>
            <button class="btn btn-primary float-end">Submit</button>
        </form>

        @endif
        
       
        <div class="card-body">
            <h5 class="card-title h4">Name : {{ $user->name ? $user->name : '' }}</h5>
            <p class="card-text">Email : {{ $user->email ? $user->email : ''}}</p>
            {{-- <a href="#" class="btn btn-primary" data-bs-dismiss="modal">Close</a> --}}
        </div>
        </div>
      
       
      
    </div>
  </div>
</div>
@endauth

@if (session('Created'))

    <div class="alert alert-info alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
        <strong>Created!</strong>{{session('Created')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx" aria-label="Close"></button>
    </div>      

@endif

@if (session('Updated'))

    <div class="alert alert-info alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
        <strong>Updated!</strong>{{session('Updated')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx" aria-label="Close"></button>
    </div>      

@endif

@if (session('Deleted'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
        <strong>Deleted!</strong>{{session('Deleted')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>      

@endif
    

    <div class="card mb-2 shadow bg-derk " style=" user-select:none;">
        <div class="card-body">
            @forelse($articles as $key => $article )
                
          
            <a href='{{ url("/articles/detail/$article->id") }}' style="text-decoration:none;">
            <div class="col-12  img mt-3 mb-5">
                <img src="{{ url('./images/'.$article->image) }}" alt="" width="100%" style="border: 1.5px solid gray; border-radius:8px" class="float-end  ">
            </div>
           <div class="col-12 col-lg-6 col-md-6 mb-5 " >
            
             <h4 class="card-title text-dark">{{ $article->title }}</h4>

              <div class="text-muted small" style="cursor:pointer;">
                    <b class="text-success">{{ $article->user->name}}</b><br>
                    <b >Category : </b> <span class="text-primary" > {{ $article->category->name }}</span> |
                    <b >Comments : </b> <span class="text-primary" > {{ count( $article->comments) }}</span> |
                    <span class="text-muted">{{ $article->created_at->diffForHumans() }}...</span>
                </div>
            
                <div class="card-subtitle mb-2 text-info small">{{ $article->created_at->diffForHumans() }}</div>

                <p class="card-text text-dark">{{ $article->body }} </p><br>

               
             </div>
            </a>
             <hr>
   
        @empty

        <div class="card">
            <h5 class="text-bold text-danger text-center">There is no articles yet</h5>
        </div>
                
        @endforelse 
               </div>
    </div>
</div>
</div>
@endsection