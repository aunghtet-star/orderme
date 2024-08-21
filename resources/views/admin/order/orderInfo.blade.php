@extends('admin.layouts.master')

@section('title','Order Info Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="row">
                        <div class="">
                            <a href="{{ route('order#list')}}"><button class="btn bg-dark text-primary my-3">
                                <i class="fa-solid fa-arrow-left text-primary"></i>
                            </button>
                        </a>
                        </div>
                    </div>

                    <div class="row col-4">

                        <div class="card mt-4">
                            <div class="card-body" style="border-bottom: 1px solid blue">
                                <h3>Order Info</h3>
                                <small class="text-warning"><i class="fa-solid fa-triangle-exclamation me-2"></i>Include Delivery Charges</small>
                            </div>
                            <div class="card-body">
                                <div class="row my-3">
                                    <div class="col"><i class="fa-solid fa-user me-2 text-primary"></i>Name</div>
                                    <div class="col"> {{ strtoupper($orderList[0]->u_name) }} </div>
                                </div>

                                <div class="row my-3">
                                    <div class="col"><i class="fa-solid fa-barcode me-2 text-primary"></i>Order Code</div>
                                    <div class="col"> {{ $orderList[0]->order_code }} </div>
                                </div>

                                <div class="row my-3">
                                    <div class="col"><i class="fa-solid fa-calendar-days me-2 text-primary"></i>Order Date</div>
                                    <div class="col"> {{ $orderList[0]->created_at->format('F-j-Y') }} </div>
                                </div>

                                <div class="row my-3">
                                    <div class="col"><i class="fa-solid fa-money-bill-wave me-2 text-primary"></i>Total</div>
                                    <div class="col"> {{ $order->total_price }} Kyats </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2 text-center ">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="fs-6">Order Id</th>
                                    <th class="fs-6">User Name</th>
                                    <th class="fs-6">Product Image</th>
                                    <th class="fs-6">Product Name</th>
                                    <th class="fs-6">Qty</th>
                                    <th class="fs-6">Amount</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ( $orderList as $o )
                                <tr class="tr-shadow">
                                    <td></td>
                                    <td> {{ $o->id }} </td>
                                    <td> {{ $o->u_name }} </td>
                                    <td class="col-2"> <img src="{{ asset('storage/'.$o->p_image) }}" class="shadow-sm img-thumbnail "> </td>
                                    <td> {{ $o->p_name }} </td>
                                    <td> {{ $o->qty }} </td>
                                    <td> {{ $o->total }} Kyats </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- <div class="mt-3">
                            {{ $order->links()}}
                        </div> --}}

                    </div>


                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

