@extends('admin.layouts.master')

@section('title','Product List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green bg-primary text-dark au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>
                            {{-- <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button> --}}
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{session('deleteSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <h4 class=" text-secondary">Search Key: <span class="text-danger">{{ request('key')}}</span></h4>
                        </div>
                        <div class="col-3 offset-6 mb-3 ">
                            <form action="{{ route('product#list')}}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control rounded" placeholder="Search..." value="{{ request('key')}}">
                                    <button class="btn btn-dark text-white rounded" type="submit">
                                        <i class="fa-solid fa-magnifying-glass text-primary"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-1 p-2 my-1 bg-white text-center ml-3 shadow-sm rounded">
                            <h3><i class="fa-solid fa-database me-2 text-primary"></i>{{ $products->total() }} </h3>
                        </div>
                    </div>

                    @if (count($products) != 0)
                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2 text-center ">
                            <thead>
                                <tr>
                                    <th class="fs-6">Image</th>
                                    <th class="fs-6">Name</th>
                                    <th class="fs-6">Price</th>
                                    <th class="fs-6">Category</th>
                                    <th class="fs-6">View Count</th>
                                    <th class="fs-6"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $p)
                                <tr class="tr-shadow">
                                    <td class="col-2"><img src="{{ asset('storage/'.$p->image) }}" class="shadow-sm img-thumbnail "></td>
                                    <td class="col-3">{{ $p->name }}</td>
                                    <td class="col-2">{{ $p->price }} Ks</td>
                                    <td class="col-2">{{ $p->categories_name }}</td>
                                    <td class="col-2"><i class="fa-solid fa-eye me-1"></i>{{ $p->view_count  }}</td>
                                    <td class="col-2">
                                        <div class="table-data-feature">
                                            <a href="{{ route('product#edit',$p->id) }}">
                                                <button class="item me-2" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fa-solid fa-eye"></i>>
                                                </button>
                                            </a>
                                           <a href="{{ route('product#updatePage',$p->id) }}">
                                            <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                {{-- <i class="zmdi zmdi-edit"></i> --}}
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                           </a>

                                            <a href="{{ route('product#delete',$p->id)}}">
                                                <button class="item me-3" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    {{-- <i class="zmdi zmdi-delete"></i> --}}
                                                    <i class="fa-solid fa-trash-can text-danger"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $products->links()}}
                        </div>

                    </div>
                    @else
                        <h2 class="text-dark text-center mt-5">There is no Product Here!</h2>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
