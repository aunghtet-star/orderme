@extends('admin.layouts.master')

@section('title','Account Detail Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">

                @if (session('updateSuccess'))
                    <div class="col-3 offset-7">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{session('updateSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-3">
                               <a href="{{ route('category#list') }}">
                                <i class="fa-solid fa-arrow-left text-dark"></i>
                               </a>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'female')
                                            <img src="{{ asset('images/profileFemale.jpg') }}" class="shadow-sm img-thumbnail" >
                                        @else
                                            <img src="{{ asset('images/profileMale1.avif') }}" class="shadow-sm img-thumbnail" >
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image)}}"  />
                                    @endif
                                </div>
                                <div class="col-5 offset-1 ">
                                    <h4 class="my-4"><i class="fa-solid text-success fa-user me-2"></i>{{ Auth::user()->name }}</h4>
                                    <h4 class="my-4"><i class="fa-solid text-success fa-envelope me-2"></i>{{ Auth::user()->email }}</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-phone text-danger me-2"></i>{{ Auth::user()->phone }}</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-location-dot text-danger me-2"></i>{{ Auth::user()->address }}</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-venus-mars text-warning me-2"></i>{{ Auth::user()->gender }}</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-user-clock text-warning me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-3 offset-7">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn bg-primary text-dark">
                                            <i class="fa-solid text-dark fa-user-pen me-2"></i>Edit Profile
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
