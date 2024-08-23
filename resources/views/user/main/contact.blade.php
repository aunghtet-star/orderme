@extends('user.layouts.master')

@section('title','Contact Page')

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 col-12 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title text-center mb-3" style="border-bottom:1px solid black;">
                                <h3>Connecting With Us</h3>
                            </div>
                            <form action="{{ route('user#contactSend') }}" method="POST">
                                @csrf
                                <div class="row">


                                    <div class="">
                                        <div class="row">
                                            <div class="form-group col-md-2 col-12">
                                                <input id="cc-pament" name="name" disabled type="text" value="{{ Auth::user()->name }}" class="form-control @error('name') is-invalid @enderror" value="" aria-required="true" aria-invalid="false" placeholder="Name">
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="form-groupcol-md-2 col-12 ">
                                                <input id="cc-pament" name="email" disabled type="text" value="{{ Auth::user()->email }}" class="form-control @error('email') is-invalid @enderror" value="" aria-required="true" aria-invalid="false" placeholder="Email">
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input id="cc-pament" name="subject"  type="text" value="" class="form-control @error('subject') is-invalid @enderror" value="" aria-required="true" aria-invalid="false" placeholder="Subject">
                                            @error('subject')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <textarea name="yourMessage"  cols="30" rows="10" class="form-control @error('yourMessage') is-invalid @enderror" placeholder="Your Message"></textarea>
                                            @error('yourMessage')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn bg-dark text-primary  float-end col-md-3 col-3">Send</button>
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
