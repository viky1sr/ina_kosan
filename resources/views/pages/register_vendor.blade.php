@extends('layouts.frontend_default')

@section('style-page')
    <style>
        .form-group > label.error {
            display: block !important;
            text-transform: none;
        }

        .form-group input.valid ~ label.error,
        .form-group input[type="text"] ~ label.error,
        .form-group input[type="email"] ~ label.error,
        .form-group input[type="number"] ~ label.error,
        .form-group select ~ label.error,
        .form-group textarea ~ label.error { display: none !important; }
    </style>
@stop
@section('content')
    <section id="page-title" class="page-title-center page-title-parallax page-title-dark include-header include-topbar" style="background-image: url('demos/travel/images/hotels/page-title.jpg'); background-position: center center; padding: 100px 0;" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -200px;">

        <div class="container clearfix">
            <h1>Register Vendor</h1>
{{--            <span><i class="icon-map-marker"></i>Ingin menjadi vendor ?</span>--}}
        </div>

    </section>

    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix">
                <div class="form-widget">
                    <div class="row">
                        <div class="col-lg-6">
                            <form class="row" id="regiterForm" action="{{route('register-vendor-store')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }} {{ method_field('POST') }}
                                <div id="successRegister"></div>
                                <div class="col-6 form-group">
                                    <label>Name:</label>
                                    <input type="text" name="name" class="form-control required" value="" placeholder="Enter your Full Name">
                                </div>
                                <div class="col-6 form-group">
                                    <label>Name Kosan:</label>
                                    <input type="text" name="name_kosan"  class="form-control required" value="" placeholder="Enter your Name Kosan">
                                </div>
                                <div class="col-12 form-group">
                                    <label>Email:</label>
                                    <input type="email" name="email" class="form-control required" value="" placeholder="Enter your Email Address">
                                </div>
                                <div class="col-6 form-group">
                                    <label>Number Phone:</label>
                                    <input type="number" name="no_hp" class="form-control required" value="" placeholder="Enter your Number">
                                </div>
                                <div class="col-6 form-group">
                                    <label>Number Phone Kosan:</label>
                                    <input type="number" name="no_hp_kosan" class="form-control required" value="" placeholder="Enter your Number">
                                </div>
                                <div class="col-6 form-group">
                                    <label>Password:</label>
                                    <input type="password" name="password" class="form-control required" value="" placeholder="Enter your password">
                                </div>
                                <div class="col-6 form-group">
                                    <label>Password Confrim:</label>
                                    <input type="password" name="password_confirmation" class="form-control required" value="" placeholder="Enter your password confrim">
                                </div>
                                <div class="col-12 form-group">
                                    <label>File Pendukung:</label>
                                    <input type="file" name="file_pendukung" class="form-control required" value="" placeholder="Enter your Number">
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Reason:</label>
                                        <textarea name="reason" class="form-control required" cols="30" rows="5"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Address:</label>
                                        <textarea name="address"  class="form-control required" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" name="event-registration-submit" class="btn btn-secondary submitBtn">Register</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-6 pl-lg-4">
                            <p><span class="dropcap">F</span>oster best practices effectiveness inspire breakthroughs solve immunize turmoil. Policy dialogue peaceful The Elders rural global support. Process inclusive innovate readiness, public sector complexity. Lifting people up cornerstone partner, technology working families civic engagement activist recognize potential global network. Countries tackling solution respond change-makers tackle. Assistance, giving; fight against malnutrition experience in the field lasting change scalable. Empowerment long-term, fairness policy community progress social responsibility; Cesar Chavez recognition. Expanding community ownership visionary indicator pursue these aspirations accessibility. Achieve; worldwide, life-saving initiative facilitate. New approaches, John Lennon humanitarian relief fundraise vaccine Jane Jacobs community health workers Oxfam. Our ambitions informal economies.</p>

{{--                            <blockquote class="topmargin bottommargin">--}}
{{--                                <p>Human rights healthcare immunize; advancement grantees. Medical supplies; meaningful, truth technology catalytic effect. Promising development capacity building international enable poverty.</p>--}}
{{--                            </blockquote>--}}

{{--                            <div class="w-100">--}}
{{--                                <p>Provide, Aga Khan, interconnectivity governance fairness replicable, new approaches visionary implementation. End hunger evolution, future promising development youth. Public sector, small-scale farmers; harness facilitate gender. Contribution dedicated global change movements, prosperity accelerate progress citizens of change. Elevate; accelerate reduce child mortality; billionaire philanthropy fluctuation, plumpy'nut care opportunity catalyze. Partner deep.</p>--}}
{{--                            </div>--}}

{{--                            <div class="w-100">--}}
{{--                                <p>Frontline harness criteria governance freedom contribution. Campaign Angelina Jolie natural resources, Rockefeller peaceful philanthropy human potential. Justice; outcomes reduce carbon emissions nonviolent resistance human being. Solve innovate aid communities; benefit truth rural development UNICEF meaningful work. Generosity Action Against Hunger relief; many voices impact crisis situation poverty pride. Vaccine carbon.</p>--}}
{{--                            </div>--}}

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <script src="{{asset('assets/js/vendor-all.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready( () => {
            $('#regiterForm').on('submit', (e) => {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: $(this).attr("action"),
                    // data: $(this).find('input,select,textarea').serialize(),
                    data: new FormData($('#regiterForm')[0]),
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('.submitBtn').html('<div class="text-white mr-2 align-self-center loader-sm ">Loading upload...</div>');
                        $('.submitBtn').prop('disabled', true);
                        $('.backBtn').addClass('d-none');
                    },
                    success: (data) => {
                        if(data.status === "ok"){
                            $('.submitBtn').html('Submit');
                            $('.submitBtn').prop('disabled', false);
                            $('.backBtn').removeClass('d-none');
                            toastr["success"](data.messages);
                            window.location.href = data.route
                        }
                    },
                    error: (data) => {
                        var data = data.responseJSON;
                        if(data.status == "fail"){
                            $('.submitBtn').html('Submit');
                            $('.submitBtn').prop('disabled', false);
                            $('.backBtn').removeClass('d-none');
                            toastr["error"](data.messages);
                        }
                    }
                });
            });
        })
    </script>
@stop

@section('script-page')

@stop
