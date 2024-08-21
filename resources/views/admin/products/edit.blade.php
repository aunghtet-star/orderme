@extends('admin.layouts.master')

@section('title','Product Edit Page')

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
                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Details </h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-1">

                                    <img src="{{ asset('storage/'.$products->image)}}" class="shadow-sm img-thumbnail " />

                                </div>
                                <div class="col-5 offset-1 ">
                                    <h3 class="my-4"><i class="fa-regular fa-note-sticky text-success me-2"></i>{{ $products->name }}</h3>
                                    <h4 class="my-4"><i class="fa-solid fa-money-bill-wave text-success me-2"></i>{{ $products->price }} Ks</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-clock text-danger me-2"></i>{{ $products->waiting_time }} mins</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-eye text-danger me-2"></i>{{ $products->view_count }}</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-clone text-primary me-2"></i>{{ $products->categories_name }}</h4>
                                    <h4 class="my-4"><i class="fa-regular fa-calendar-check text-warning me-2"></i>{{ $products->created_at->format('j-F-Y') }}</h4>
                                    <h4 class="my-4"><i class="fa-solid fa-file-lines text-warning  fs-4 me-2"></i>{{ $products->description }}</h4>
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
