<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/plugins.min.js')}}"></script>

<!-- Travel Demo Specific Script -->
<script src="{{asset('js/components/datepicker.js')}}"></script>

<!-- Star Rating Plugin -->
<script src="{{asset('js/components/star-rating.js')}}"></script>

<!-- Footer Scripts
============================================= -->
<script src="{{asset('js/functions.js')}}"></script>

<script>
    $(function() {
        $('.travel-date-group').datepicker({
            autoclose: true,
            startDate: "today"
        });
    });
</script>
