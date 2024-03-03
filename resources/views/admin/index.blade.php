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

<body class="">


    <div class="container ">
        <h2 class="my-3">Admin Pennel</h2>
        <br>
        @if (session('Created'))
            <div class="alert alert-info alert-dismissible fade show" role="alert" style="transition: all 1s ease;">
                <strong>Created!</strong>{{ session('Created') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" style="border: opx"
                    aria-label="Close"></button>
            </div>
        @endif

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item me-3" role="presentation">
                <button class="nav-link active position-relative " style="border:1px solid #3c6efd" id="pills-home-tab"
                    data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab"
                    aria-controls="pills-home" aria-selected="true">Category
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ count($categories) }}
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </button>
            </li>
            <li class="nav-item me-3" role="presentation">
                <button class="nav-link position-relative" style="border:1px solid #3c6efd" id="pills-profile-tab"
                    data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab"
                    aria-controls="pills-profile" aria-selected="false">Article

                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ count($articles) }}
                        <span class="visually-hidden">unread messages</span>
                    </span>

                </button>
            </li>

            <li class="nav-item me-5" role="presentation">
                <button class="nav-link position-relative" style="border:1px solid #3c6efd" id="pills-disabled-tab"
                    data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab"
                    aria-controls="pills-disabled" aria-selected="false">User

                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ count($users) }}
                        <span class="">new users</span>
                    </span>

                </button>
            </li>
            <div class="float-end d-inline ms-5"><a href="{{ url('/admin/category_add') }}" class=" btn btn-primary">Add
                    New Category</a></div>


        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">

                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th width="20%">No</th>
                            <th width="20%">Name</th>
                            <th width="30%">des</th>
                            <th width="30%">created_at</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($categories as $key => $category)
                            <tr>
                                <td width="20%">{{ $key + 1 }}</td>
                                <td width="20%">{{ $category->name }}</td>
                                <td width="30%">{{ $category->desc }}</td>
                                <td width="30%">{{ $category->created_at }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">

                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>des</th>
                            <th>category</th>
                            <th>created_at</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($articles as $key => $article)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ substr($article->body, 0, 60) }}</td>
                                <td>
                                    @if ($article->category->id == 1)
                                        <span class=" {{ 'btn btn-sm btn-danger p-0 px-1' }}">
                                            {{ $article->category->name }}
                                        </span>
                                    @elseif($article->category->id == 2)
                                        <span class=" {{ 'btn btn-sm btn-secondary p-0 px-1' }}">
                                            {{ $article->category->name }}
                                        </span>
                                    @elseif ($article->category->id == 3)
                                        <span class=" {{ 'btn btn-sm btn-primary p-0 px-1' }}">
                                            {{ $article->category->name }}
                                        </span>
                                    @elseif ($article->category->id == 4)
                                        <span class=" {{ 'btn btn-sm btn-info p-0 px-1' }}">
                                            {{ $article->category->name }}
                                        </span>
                                    @else
                                        <span class=" {{ 'btn btn-sm btn-warning p-0 px-1' }}">
                                            {{ $article->category->name }}
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $article->created_at }}</td>

                            </tr>


                        @empty

                            <tr>
                                <h4 class="text-center text-bold text-danger ">There is no articles yet!</h4>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div>
            <div class="tab-pane fade " id="pills-disabled" role="tabpanel" aria-labelledby="pills-contact-tab"
                tabindex="0">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th width="10%">No</th>
                            <th width="20%">Name</th>
                            <th width="30%">Email</th>
                            <th width="20%">created_at</th>
                            <th width="20%" class="text-center">option</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $key => $user)
                            <tr>
                                <td width="10%">{{ $key + 1 }}</td>
                                <td width="20%">{{ $user->name }}</td>
                                <td width="30%">{{ $user->email }}</td>
                                <td width="20%">{{ $user->created_at }}</td>
                                <td width="20%" class="text-center"><a href="#"
                                        class="btn btn-sm btn-primary px-1 py-0">Admin</a>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        const triggerTabList = document.querySelectorAll('#pills button')
        triggerTabList.forEach(triggerEl => {
            const tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', event => {
                event.preventDefault()
                tabTrigger.show()
            })
        })
    </script>
</body>

</html>
{{-- <img src="https://github.com/HtetPhone/eCom/blob/master/public/images/home.png" width="450px" height="700px">
<br> --}}
