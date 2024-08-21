@extends('admin.layouts.master')

@section('title','Order List Page')

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
                                <h2 class="title-1">Order Lists</h2>

                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="col-3">
                            <h4 class=" text-secondary">Search Key: <span class="text-danger">{{ request('key')}}</span></h4>
                        </div>
                        <div class="col-3 offset-6 mb-3 ">
                            <form action="{{ route('order#list')}}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control rounded" placeholder="Search..." value="{{ request('key')}}">
                                    <button class="btn btn-dark text-white rounded" type="submit">
                                        <i class="fa-solid fa-magnifying-glass text-primary"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div> --}}

                    {{-- <div class="row my-3">
                        <div class="col-1 p-2 my-1 bg-white text-center ml-3 shadow-sm rounded">
                            <h3><i class="fa-solid fa-database me-2 text-primary"></i> {{ count($order) }} </h3>
                        </div>
                    </div> --}}


                    <form action="{{ route('order#changeStatus') }}" method="get">
                        @csrf
                        <div class="input-group my-5 col-3 ">
                            <div class="btn   bg-dark text-primary input-group-text">
                                <span><i class="fa-solid fa-database me-2 text-primary"></i> {{ count($order) }} </span>
                            </div>
                            <select name="orderStatus" id="orderStatus" class="form-control form-select ">
                                <option value="">All</option>
                                <option value="0" @if(request('orderStatus') == '0') selected @endif>Pending</option>
                                <option value="1" @if(request('orderStatus') == '1') selected @endif>Accept</option>
                                <option value="2" @if(request('orderStatus') == '2') selected @endif>Reject</option>
                            </select>
                            <button type="submit" class="btn ms-1  bg-dark text-primary input-group-text">
                                <i class="fa-solid fa-magnifying-glass text-primary"></i>
                            </button>

                        </div>
                    </form>

                    @if ( count($order) != 0)
                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2 text-center ">
                            <thead>
                                <tr>
                                    <th class="fs-6">User Id</th>
                                    <th class="fs-6">User Name</th>
                                    <th class="fs-6">Order Date</th>
                                    <th class="fs-6">Order Code</th>
                                    <th class="fs-6">Amount</th>
                                    <th class="fs-6">Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">

                                @foreach ( $order as $o )
                                <tr class="tr-shadow">
                                    <input type="hidden" class="orderId" value="{{ $o->id }}">
                                    <td> {{ $o->user_id }} </td>
                                    <td> {{ $o->u_name }} </td>
                                    <td> {{ $o->created_at->format('F-j-Y') }} </td>
                                    <td>
                                        <a href="{{ route('order#listInfo',$o->order_code) }}" class="text-danger">
                                            {{ $o->order_code }}
                                        </a>
                                    </td>
                                    <td> {{ $o->total_price }} Kyats </td>
                                    <td>
                                        <select name="status" class="form-control statusChange">
                                            <option value="0" @if($o->status == 0) selected @endif>Pending</option>
                                            <option value="1" @if($o->status == 1) selected @endif>Accept</option>
                                            <option value="2" @if($o->status == 2) selected @endif>Reject</option>
                                        </select>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                        {{-- <div class="mt-3">
                            {{ $order->links()}}
                        </div> --}}

                    </div>

                    @else
                        <h2 class="text-dark text-center mt-5">There is no Order Here!</h2>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')
<script>
    $(document).ready(function(){
        // $('#orderStatus').change(function(){
        //     status = $('#orderStatus').val();
        //     $.ajax({
        //         type : 'get',
        //         url : '/orders/ajax/status',
        //         data : {
        //             'status' : status
        //         },
        //         dataType : 'json',
        //         success : function(response){
        //             $list='';
        //             for($i=0;$i<response.length;$i++){

        //                 month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        //                 dbDate = new Date(response[$i].created_at);
        //                 finalDate = month[dbDate.getMonth()] +"-"+ dbDate.getDate() +"-"+ dbDate.getFullYear();
        //                 console.log(finalDate)

        //                 if(response[$i].status == 0){
        //                     statusMessage = `
        //                         <select name="status" class="form-control statusChange">
        //                             <option value="0" selected>Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                     `;
        //                 }else if (response[$i].status == 1){
        //                     statusMessage = `
        //                         <select name="status" class="form-control statusChange">
        //                             <option value="0">Pending</option>
        //                             <option value="1" selected>Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                     `;
        //                 }else if(response[$i].status == 2){
        //                     statusMessage = `
        //                         <select name="status" class="form-control statusChange">
        //                             <option value="0">Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2" selected>Reject</option>
        //                         </select>
        //                     `;
        //                 }

        //               $list += `
        //                         <tr class="tr-shadow">
        //                             <input type="hidden" class="orderId" value="${response[$i].id}">
        //                             <td>  ${response[$i].user_id}  </td>
        //                             <td>  ${response[$i].u_name}  </td>
        //                             <td>  ${finalDate} </td>
        //                             <td>  ${response[$i].order_code}  </td>
        //                             <td>  ${response[$i].total_price}  Kyats </td>
        //                             <td> ${statusMessage} </td>
        //                         </tr>
        //                     `;
        //             }
        //             $('#dataList').html($list);
        //         }
        //     })
        // })

        // change status
        $('.statusChange').change(function(){
            currentStatus = $(this).val();
            parentNode = $(this).parents("tr");
            orderId = parentNode.find('.orderId').val();
            data = {
                'status' : currentStatus,
                'orderId' : orderId
            }
            $.ajax({
                type : 'get',
                url : '/orders/ajax/change/status',
                data : data,
                dataType : 'json',
            })
            location.reload();
        })
    })
</script>
@endsection
