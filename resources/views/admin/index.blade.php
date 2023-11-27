@extends('layouts.app')

@section('content')
<div class="container">
     <h2>hello</h2>
 @if (session('Created'))

    <div class="alert alert-info alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
        <strong>Created!</strong>{{session('Created')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx" aria-label="Close"></button>
    </div>      

@endif

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item me-3" role="presentation">
    <button class="nav-link active position-relative " style="border:1px solid #3c6efd" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home 
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ count($categories) }}
            <span class="visually-hidden">unread messages</span>
        </span>
    </button>
  </li>
  <li class="nav-item me-3" role="presentation">
    <button class="nav-link position-relative" style="border:1px solid #3c6efd" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile  
        
         <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ count($articles) }}
            <span class="visually-hidden">unread messages</span>
        </span>
    
    </button>
  </li>
 
  <li class="nav-item" role="presentation">
    <button class="nav-link position-relative" style="border:1px solid #3c6efd" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" >Disabled  

         <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            {{ count($users) }}
            <span class="visually-hidden">unread messages</span>
        </span>

    </button>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">

    <table class="table">
        <thead class="table-light">
           <tr>
            <th width="20%">No</th>
            <th width="20%">Nmae</th>
            <th width="30%">des</th>
            <th width="30%">created_at</th>
           </tr>
        </thead>
        <tbody>
            
            @foreach ($categories as  $category)
            <tr>
                <td width="20%">{{ $category->id  }}</td>
                <td width="20%">{{ $category->name }}</td>
                <td width="30%">{{ $category->desc }}</td>
                <td width="30%">{{ $category->created_at }}</td>
                 
            </tr>
            
           
             @endforeach
             
        </tbody>
    </table>

  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
    
        <table class="table">
        <thead class="table-light">
           <tr>
            <th>No</th>
            <th>Nmae</th>
            <th>des</th>
            <th>created_at</th>
           </tr>
        </thead>
        <tbody>
            
            @foreach ($articles as  $article)
            <tr>
                <td>{{ $article->id  }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ substr($article->body,0,60) }}</td>
                <td>{{ $article->created_at }}</td>
                 
            </tr>
            
           
             @endforeach
             
        </tbody>
    </table>

  </div>
  <div class="tab-pane fade " id="pills-disabled" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
        <table class="table">
        <thead class="table-light">
           <tr>
            <th width="20%">No</th>
            <th width="20%">Nmae</th>
            <th width="30%">des</th>
            <th width="30%">created_at</th>
           </tr>
        </thead>
        <tbody>
            
            @foreach ($users as  $user)
            <tr>
                <td width="20%">{{ $user->id  }}</td>
                <td width="20%">{{ $user->name }}</td>
                <td width="30%">{{ $user->email }}</td>
                <td width="30%">{{ $user->created_at }}</td>
                 
            </tr>
            
           
             @endforeach
             
        </tbody>
    </table>
  </div>

</div>
</div>

@endsection