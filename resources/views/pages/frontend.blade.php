@extends('layouts.frontend_default')

@section('content')
    <section id="page-title" class="page-title-center page-title-parallax page-title-dark include-header include-topbar" style="background-image: url('demos/travel/images/hotels/page-title.jpg'); background-position: center center; padding: 100px 0;" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -200px;">

        <div class="container clearfix">
            <h1>{{count($kosans)}} Kos Kosan</h1>
            <span><i class="icon-map-marker"></i>Indonesia</span>
        </div>

    </section>

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">

                <div class="row gutter-40 col-mb-80">
                    <!-- Post Content
                    ============================================= -->
                    <div class="postcontent col-lg-9 order-lg-last">
                        <!-- Posts
                        ============================================= -->
                        <div id="posts" class="row gutter-40 mb-0">
                            @forelse($kosans as $key => $item)
                                <div class="entry col-12">
                                    <div class="grid-inner row">
                                        <div class="col-lg-4">
                                            <a href="{{asset('uploads/file_kosan')}}/{{$item->file['file_kosan']}}" data-lightbox="image"><img src="{{asset('uploads/file_kosan')}}/{{$item->file['file_kosan']}}" alt="Bronze Time Hotel"></a>
                                        </div>
                                        <div class="col-lg col-md-8 mt-4 mt-lg-0">
                                            <div class="entry-title title-sm">
                                                <h2><a href="#">{{$item->name}} ( {{$item->is_type->name}} )</a></h2>
                                            </div>
                                            <div class="entry-meta">
                                                <ul>
                                                    <li><i class="icon-line-map"></i>{{$item->location}}</li>
                                                </ul>
                                            </div>
                                            <div class="entry-content">
                                                <div class="clearfix" style="margin-bottom: 10px;">
                                                    <i class="i-rounded i-small i-bordered icon-wifi-full"  data-toggle="tooltip" data-placement="top" title="WiFi"></i>
                                                    <i class="i-rounded i-small i-bordered icon-glass"  data-toggle="tooltip" data-placement="top" title="Bar"></i>
                                                    <i class="i-rounded i-small i-bordered icon-line-shuffle"  data-toggle="tooltip" data-placement="top" title="Air Conditioner"></i>
                                                    <i class="i-rounded i-small i-bordered icon-food"  data-toggle="tooltip" data-placement="top" title="Restaurant"></i>
                                                    <i class="i-rounded i-small i-bordered border-0 i-light icon-barbell"  data-toggle="tooltip" data-placement="top" title="Gym Unavailable"></i>
                                                    <i class="i-rounded i-small i-bordered icon-bell"  data-toggle="tooltip" data-placement="top" title="Room Service"></i>
                                                    <i class="i-rounded i-small i-bordered border-0 i-light icon-coffee2"  data-toggle="tooltip" data-placement="top" title="Cafe Unavailable"></i>
                                                </div>
                                                <p class="mb-0">{{$item->description}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-auto col-md-4 mt-4 mt-lg-0 text-left text-md-center">
                                            <div class="hotel-price">
                                                <i class="">Rp. </i>{{rupiah($item->price)}}
                                            </div>
                                            <small><em>Harga per bulan</em></small><br>
                                            <a href="{{route('home')}}"class="button button-rounded mt-4 mx-0">Pesan</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>

                        <ul class="pagination my-0">
                            {!! $kosans->appends(['sort' => 'location'])->links() !!}

                    </div>

                    <!-- Sidebar
                    ============================================= -->
                    <div class="sidebar col-lg-3">
                        <div class="sidebar-widgets-wrap">

                            <div class="widget clearfix">
                                <div class="toggle mb-0 clearfix">
                                    <div class="toggle-header">
                                        <div class="toggle-icon">
                                            <button class="button button-rounded btn-block m-0">
                                                <i class="toggle-closed icon-caret-right"></i>
                                                <i class="toggle-open icon-caret-down"></i>Modify Search Result
                                            </button>
                                        </div>
                                    </div>
                                    <div class="toggle-content pl-0 mt-15">
                                        <form class="row mb-0">
                                            <div class="form-process">
                                                <div class="css3-spinner">
                                                    <div class="css3-spinner-scaler"></div>
                                                </div>
                                            </div>

                                            <div class="col-12 form-group">
                                                <label for="template-contactform-location">Location <small>*</small></label>
                                                <input type="text" id="template-contactform-location" name="template-contactform-location" value="" class="sm-form-control required" placeholder="Spain" />
                                            </div>

                                            <div class="col-12">
                                                <div class="input-daterange travel-date-group row mb-0">
                                                    <div class="col-12 form-group">
                                                        <label for="">Departure</label>
                                                        <input type="text" value="" class="sm-form-control text-left" name="start" placeholder="mm/dd/yyyy">
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <label for="">Arrival</label>
                                                        <input type="text" value="" class="sm-form-control text-left" name="end" placeholder="mm/dd/yyyy">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="template-contactform-adults">Adults</label>
                                                <select id="template-contactform-adults" name="template-contactform-adults" class="sm-form-control">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label for="template-contactform-children">Childrens</label>
                                                <select id="template-contactform-children" name="template-contactform-children" class="sm-form-control">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                            </div>


                                            <div class="col-md-12 form-gorup">
                                                <div class="widget clearfix">

                                                    <h4>Price</h4>

                                                    <div>
                                                        <input id="checkbox-1" class="checkbox-style" name="checkbox" type="checkbox">
                                                        <label for="checkbox-1" class="checkbox-style-2-label checkbox-small">$0 - $49</label>
                                                    </div>
                                                    <div>
                                                        <input id="checkbox-2" class="checkbox-style" name="checkbox" type="checkbox">
                                                        <label for="checkbox-2" class="checkbox-style-2-label checkbox-small">$49 - $99</label>
                                                    </div>
                                                    <div>
                                                        <input id="checkbox-3" class="checkbox-style" name="checkbox" type="checkbox">
                                                        <label for="checkbox-3" class="checkbox-style-2-label checkbox-small">$99 - $129</label>
                                                    </div>
                                                    <div>
                                                        <input id="checkbox-4" class="checkbox-style" name="checkbox" type="checkbox">
                                                        <label for="checkbox-4" class="checkbox-style-2-label checkbox-small">$129 - $199</label>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="w-100"></div>

                                            <div class="col-12 form-group d-none">
                                                <input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
                                            </div>

                                            <div class="col-12 form-group mb-0">
                                                <a href="#" class="button button-3d m-0">Search</a>
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
    </section>
@stop
