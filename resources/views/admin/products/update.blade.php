@extends('admin.layouts.master')

@section('title','Product Update Page')

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
                                <h3 class="text-center title-2">Update Product</h3>
                            </div>
                            <hr>

                            <form action="{{ route('product#update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="productId" value="{{ $products->id }}">
                                    <div class=" col-3 offset-1">
                                        <img src="{{ asset('storage/'.$products->image)}}" class="shadow-sm img-thumbnail " />
                                        <div class="">
                                            <input type="file" name="productImage" class="form-control mt-2  @error('productImage') is-invalid @enderror">
                                            @error('productImage')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class=" col-5 ">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="productName" type="text"  class="form-control @error('productName') is-invalid @enderror" value="{{ old('productName',$products->name) }}" aria-required="true" aria-invalid="false" placeholder="Enter Product Name...">
                                            @error('productName')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select name="productCategory" class="form-control @error('productCategory') is-invalid @enderror">
                                                <option value="">Choose Category...</option>
                                                @foreach ($category as $c )
                                                <option value="{{ $c->id }}" @if ($products->category_id == $c->id) selected @endif>{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('productCategory')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="productPrice" type="number"  class="form-control @error('productPrice') is-invalid @enderror" value="{{ old('productPrice',$products->price) }}" aria-required="true" aria-invalid="false" placeholder="Enter Price...">
                                            @error('productPrice')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="productWaitingTime" type="number"  class="form-control @error('productWaitingTime') is-invalid @enderror" value="{{ old('productWaitingTime',$products->waiting_time) }}" aria-required="true" aria-invalid="false">
                                            @error('productWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">View Count</label>
                                            <input id="cc-pament" name="viewCount" type="number"  class="form-control" value="{{ old('viewCount',$products->view_count) }}" aria-required="true" aria-invalid="false" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Created Date</label>
                                            <input type="text" name="created_at" class="form-control" value="{{ $products->created_at->format('j-F-Y') }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <textarea name="productDescription" class="form-control @error('productDescription') is-invalid @enderror" cols="30" rows="10" placeholder="Enter Description...">{{ old('productDescription',$products->description) }}</textarea>
                                            @error('productDescription')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn bg-primary text-dark float-end col-3"><i class="fa-solid fa-user-pen me-2 text-dark"></i>Update</button>
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
