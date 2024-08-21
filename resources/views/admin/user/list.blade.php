@extends('admin.layouts.master')

@section('title','User List Page')

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
                                <h2 class="title-1">User Lists</h2>

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
                            <form action="{{ route('admin#userList')}}" method="GET">
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
                            <h3><i class="fa-solid fa-database text-primary me-2"></i>{{ $users->total() }}</h3>
                        </div>
                    </div>

                    {{-- @if ( count($order) != 0) --}}
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
                                    <th class="fs-6">Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($users as $u )
                                <tr>
                                    <input type="hidden" class="userId" value="{{ $u->id }}">
                                    <td class="col-2">
                                        @if ($u->image == null)
                                            @if ($u->gender == 'female')
                                                <img src="{{ asset('images/profileFemale.jpg') }}" class="shadow-sm img-thumbnail" >
                                            @else
                                                <img src="{{ asset('images/profileMale1.avif') }}" class="shadow-sm img-thumbnail" >
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.$u->image) }}" class="shadow-sm img-thumbnail ">
                                        @endif
                                    </td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{  $u->gender}}</td>
                                    <td>{{ $u->phone }}</td>
                                    <td>{{ $u->address }}</td>
                                    <td>
                                        <select name="userRole" class="form-control changeRole">
                                            <option value="user" @if($u->role == 'user') selected @endif>User</option>
                                            <option value="admin" @if($u->role == 'admin') selected @endif>Admin</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">

                                            <a href="{{ route('admin#userUpdatePage',$u->id) }}">
                                                <button class="item me-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    {{-- <i class="zmdi zmdi-edit"></i> --}}
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </a>

                                            <a href="{{ route('admin#userDelete',$u->id) }}">
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
                            {{ $users->links()}}
                        </div>

                    </div>

                    {{-- @else
                        <h2 class="text-dark text-center mt-5">There is no Order Here!</h2>
                    @endif --}}

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
            currentRole= $(this).val();
            parentNode = $(this).parents("tr");
            userId = $(parentNode).find('.userId').val();

            data = {
                'userId' : userId,
                'role' : currentRole
            }

            $.ajax({
                type :'get',
                url :'/user/ajax/change/role',
                data : data,
                dataType : 'json'
            })
            location.reload();
        })
    })
</script>
@endsection

