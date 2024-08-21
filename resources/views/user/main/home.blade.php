@extends('user.layouts.master')

@section('title','User Home Page')

@section('content')

     <!-- Shop Start -->
     <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Filter By Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between rounded mb-3 shadow-sm bg-dark text-white px-3 py-1">
                            {{-- <input type="checkbox" class="custom-control-input" checked id="price-all"> --}}
                            <label class="mt-2 text-primary fs-4" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal text-primary">{{ count($category) }}</span>
                        </div>

                        <div class=" d-flex align-items-center justify-content-between mb-3 pt-1">
                            <a href="{{ route('user#home') }}">
                                 <label class="text-dark" for="price-1">ALL</label>
                            </a>
                         </div>

                        @foreach ($category as $c)
                        <div class=" d-flex align-items-center justify-content-between mb-3 pt-1">
                           <a href="{{ route('user#filter',$c->id) }}">
                                <label class="text-dark" for="price-1">{{ $c->name }}</label>
                           </a>
                        </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->


                {{-- <div class="">
                    <button class="btn btn btn-dark text-primary w-100">Order</button>
                </div> --}}
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                @if (session('sendSuccess'))
                        <div class="col-4 offset-4">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-check"></i> {{session('sendSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <div>
                                <a href="{{ route('cart#list') }}">
                                    <button type="button" class="btn btn-dark position-relative">
                                        <i class="fa-solid fa-cart-shopping text-primary "></i>
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($cart) }}
                                        </span>
                                      </button>
                                </a>

                                <a href="{{ route('user#history') }}" class="ms-3">
                                    <button type="button" class="btn btn-dark position-relative text-primary">
                                        <i class="fa-solid fa-clock-rotate-left text-primary"></i> History
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($history) }}
                                        </span>
                                      </button>
                                </a>
                            </div>

                            <div class="ml-2">
                                <div class="btn-group">
                                        <select name="sorting" id="sortingOption" class="form-control">
                                            <option value="">Choose Options...</option>
                                            <option value="asc">Ascending</option>
                                            <option value="desc">Descending</option>
                                        </select>
                                </div>
                                {{-- <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">10</a>
                                        <a class="dropdown-item" href="#">20</a>
                                        <a class="dropdown-item" href="#">30</a>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                <span class="row" id="dataList">
                    @if (count($product) != 0)
                        @foreach ($product as $p )
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/'.$p->image) }}" alt="" style="height: 250px">
                                        <div class="product-action">
                                            {{-- <a class="btn btn-outline-dark btn-square" href="#"><i class="fa fa-shopping-cart"></i></a> --}}
                                            <a class="btn btn-outline-dark btn-square" href="{{ route('user#productDetail',$p->id) }}"><i class="fa-solid fa-circle-info"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $p->price }} Kyats</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center bg-dark rounded text-primary fs-2 shadow-sm col-6 offset-3 py-5"><i class="fa-solid fa-circle-xmark me-2"></i> There is no Products Here!</p>
                    @endif
                </span>


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

@endsection

@section('scriptSource')

<script>
    $(document).ready(function(){
    // $.ajax({
    //     type : 'get',
    //     url : 'http://127.0.0.1:8000/user/ajax/productList',
    //     dataType : 'json',
    //     success : function(response){
    //         console.log(response);
    //     }
    // })



   $('#sortingOption').change(function(){
        $eventOption = $('#sortingOption').val();

        if($eventOption == 'asc'){
            $.ajax({
                type : 'get',
                url : '/user/ajax/productList',
                data : {
                    'status' : 'asc'
                },
                dataType : 'json',
                success : function(response){

                    $list='';
                    for($i=0;$i<response.length;$i++){
                      $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="" style="height: 250px">
                                <div class="product-action">

                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} Kyats</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                            `;
                    }
                    $('#dataList').html($list);
                }
            })

        } else if ($eventOption == 'desc') {
            $.ajax({
                type : 'get',
                url : '/user/ajax/productList',
                data : {
                    'status' : 'desc'
                },
                dataType : 'json',
                success : function(response){
                    $list='';
                    for($i=0;$i<response.length;$i++){
                      $list += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/${response[$i].image}') }}" alt="" style="height: 250px">
                                <div class="product-action">

                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} Kyats</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                            `;
                    }
                    $('#dataList').html($list);
                }
            })
        }
   })
});

</script>

@endsection
