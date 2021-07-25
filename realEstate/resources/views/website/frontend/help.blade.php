@extends('website.frontend.layouts.main')
@section('profile')
<div class="row justify-content-center">
                        <div class="col-xl-10">
                            <div class="card w-100 border-0 p-0 mt-20 rounded-3 overflow-hidden bg-image-contain bg-image-center" style="background-image: url('{{asset('storage/images/pexels-daria-shevtsova-3597111.jpg')}}');">
                                <div class="card-body p-md-5 p-4 text-center" style="background-color:rgba(0,85,255,0.8)">
                                    <h2 class="fw-700 display2-size text-white display2-md-size lh-2">How can we help you?</h2>
                                    <p class="font-xsss ps-lg-5 pe-lg-5 lh-28 text-grey-200">
                                </p>
                                    <div class="form-group w-lg-75 mt-4 border-light border p-1 bg-white rounded-3 ms-auto me-auto">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group icon-input mb-0">
                                                    <form action="{{url('/contactus')}}" method="post">
                                                        @CSRF
                                                    <input type="text" name="text" class="style1-input border-0 ps-5 font-xsss mb-0 text-grey-500 fw-500 bg-transparent" placeholder="Ask us anything">
                                                        <div class="col-md-4">
                                                            <input type="submit" class="w-100 d-block btn bg-current text-white font-xssss fw-600 ls-3 style1-input p-0 border-0 text-uppercase " value="Go">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
@endsection
