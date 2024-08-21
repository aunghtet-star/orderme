@extends('admin.layouts.master')

@section('title','Customer Message Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                @if (session('deleteSuccess'))
                        <div class="col-4 offset-4">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-triangle-exclamation"></i> {{session('deleteSuccess')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                @endif

                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Customers' Messages</h2>

                            </div>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-1 p-2 my-1 bg-white text-center ml-3 shadow-sm rounded">
                            <h3><i class="fa-solid fa-database me-2 text-primary"></i> {{ $message->total() }} </h3>
                        </div>
                    </div>

                    @if (count($message) != 0)
                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2 text-center ">
                            <thead>
                                <tr>
                                    <th class="fs-6">Id</th>
                                    <th class="fs-6">Name</th>
                                    <th class="fs-6">Email</th>
                                    <th class="fs-6">Subject</th>
                                    <th class="fs-6">Message</th>
                                    <th class="fs-6"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($message as $m )
                                <tr>
                                    <td>{{ $m->id }}</td>
                                    <td>{{ $m->name }}</td>
                                    <td>{{ $m->email }}</td>
                                    <td>{{  $m->subject}}</td>
                                    <td>{{ $m->message }}</td>
                                    <td>
                                        <div class="table-data-feature me-4">
                                            <a href="{{ route('admin#deleteMessage',$m->id) }}">
                                                <button class="item  me-3" data-toggle="tooltip" data-placement="top" title="Delete">
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
                            {{ $message->links()}}
                        </div>

                    </div>
                    @else
                        <h2 class="text-dark text-center mt-5">There is no Message Here!</h2>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
