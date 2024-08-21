@extends('admin.layouts.master')

@section('title','Admin List Page')

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
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                            <form action="{{ route('admin#list')}}" method="GET">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control rounded" placeholder="Search..." value="{{ request('key')}}">
                                    <button class="btn btn-dark text-white rounded" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-1 p-2 my-1 bg-white text-center ml-3 shadow-sm rounded">
                            <h3><i class="fa-solid fa-database text-primary me-2"></i>{{ $admin->total() }}</h3>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2 text-center ">
                            <thead>
                                <tr>
                                    <th class="fs-6">Image</th>
                                    <th class="fs-6">Name</th>
                                    <th class="fs-6">Email</th>
                                    <th class="fs-6">Gender</th>
                                    <th class="fs-6">Phone</th>
                                    <th class="fs-6">Address</th>
                                    <th class="fs-6"></th>
                                    <th class="fs-6"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                <tr class="tr-shadow">
                                    <input type="hidden" class="userId" value="{{ $a->id }}">
                                    <td class="col-1">
                                        @if ($a->image == null)
                                            @if ($a->gender == 'female')
                                                <img src="{{ asset('images/profileFemale.jpg') }}" class="shadow-sm img-thumbnail" >
                                            @else
                                                <img src="{{ asset('images/profileMale1.avif') }}" class="shadow-sm img-thumbnail" >
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.$a->image) }}" class="shadow-sm img-thumbnail ">
                                        @endif
                                    </td>
                                    <td>{{ $a->name }}</td>
                                    <td>{{ $a->email }}</td>
                                    <td>{{ $a->gender }}</td>
                                    <td>{{ $a->phone }}</td>
                                    <td>{{ $a->address }}</td>
                                    <td>
                                        <div class="table-data-feature">

                                            @if (Auth::user()->id == $a->id)

                                            @else
                                                {{-- <a href="{{ route('admin#changeRole',$a->id) }}">
                                                    <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Change Role">
                                                        <i class="fa-solid fa-person-circle-minus "></i>
                                                    </button>
                                                </a> --}}

                                                <select name="role" class="form-control ms-2 changeRole">
                                                    <option value="admin" @if($a->role == 'admin') selected @endif >Admin</option>
                                                    <option value="user" @if($a->role == 'user') selected @endif >User</option>
                                                </select>

                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            @if (Auth::user()->id == $a->id)

                                            @else

                                                <a href="{{ route('admin#delete',$a->id) }}">
                                                    <button class="item  me-3" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="fa-solid fa-trash-can text-danger"></i>
                                                    </button>
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $admin->links()}}
                        </div>

                    </div>

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
            $('.changeRole').change(function(){
                // currentStatus = $(this).val();
                // parentNode = $(this).parents("tr");
                // orderId = parentNode.find('.orderId').val();
                // data = {
                //     'status' : currentStatus,
                //     'orderId' : orderId
                // }

                currentRole = $(this).val();
                parentNode = $(this).parents("tr");
                userId =parentNode.find('.userId').val();
                data = {
                    'role' : currentRole,
                    'userId' : userId
                }
                $.ajax({
                type : 'get',
                url : '/admin/ajax/change/role',
                data : data,
                dataType : 'json',
            })
            // window.location.href = "/admin/list";
            location.reload();
            })
        })
    </script>
@endsection
