
<!-- Vendor -->
<script src="{{asset('asset/vendor/jquery/jquery.js')}}"></script>
<script src="{{asset('asset/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
<script src="{{asset('asset/vendor/popper/umd/popper.min.js')}}"></script>
<script src="{{asset('asset/vendor/bootstrap/js/bootstrap.js')}}"></script>
{{--<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>--}}
<script src="{{asset('asset/vendor/common/common.js')}}"></script>
<script src="{{asset('asset/vendor/nanoscroller/nanoscroller.js')}}"></script>
<script src="{{asset('asset/vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('asset/vendor/jquery-placeholder/jquery-placeholder.js')}}"></script>
@yield('page_script')
<!-- Specific Page Vendor -->
{{--<script src="vendor/jquery-appear/jquery-appear.js"></script>--}}
{{--<script src="vendor/owl.carousel/owl.carousel.js"></script>--}}
{{--<script src="vendor/isotope/isotope.js"></script>--}}
<script src="{{asset('asset/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('asset/js/dataTables.responsive.min.js')}}"></script>
<!-- Theme Base, Components and Settings -->
<script src="{{asset('asset/js/theme.js')}}"></script>

<!-- Theme Custom -->
<script src="{{asset('asset/js/custom.js')}}"></script>

<!-- Theme Initialization Files -->
<script src="{{asset('asset/js/theme.init.js')}}"></script>
<script src="{{asset('asset/js/examples/examples.modals.js')}}"></script>

@yield('script')
</body>
</html>