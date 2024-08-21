@extends('admin.layouts.master')

@section('title','User Edit Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-3">
                                <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>

                            <form action="{{ route('admin#userUpdate') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $userData->id }}">
                                    <div class=" col-3 offset-1">
                                        @if ($userData->image == null)
                                            @if ($userData->gender == 'female')
                                                <img src="{{ asset('images/profileFemale.jpg') }}" class="shadow-sm img-thumbnail" >
                                            @else
                                                <img src="{{ asset('images/profileMale1.avif') }}" class="shadow-sm img-thumbnail" >
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.$userData->image)}}" class="shadow-sm img-thumbnail" />
                                        @endif

                                        <div class="">
                                            <input type="file" name="image" class="form-control mt-2  @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class=" col-5 ">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text"  class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$userData->name) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Name...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="text"  class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$userData->email) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Email...">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number"  class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone',$userData->phone) }}" aria-required="true" aria-invalid="false" placeholder="Enter Admin Phone...">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose Gender...</option>
                                                <option value="male" @if ($userData->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if ($userData->gender == 'female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Admin Adress...">{{ old('address',$userData->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn bg-primary text-dark float-end col-3"><i class="fa-solid text-dark fa-user-pen me-2"></i>Update</button>
                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
