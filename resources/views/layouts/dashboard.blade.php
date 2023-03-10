<!DOCTYPE html>
<html>

@include('partial.Admin.new_head')
@stack('css-page')

<body class="loading" data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

<div id="wrapper">
    @include('partial.Admin.new_header')
    @include('partial.Admin.new_menu')
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
              @yield('content')
            </div> <!-- container-fluid -->
        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        {{(Utility::getValByName('footer_text')) ? Utility::getValByName('footer_text') :  __('Copyright Vital Shield') }} {{ date('Y') }}
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>

      <!-- ============================================================== -->
      <!-- End Page content -->
      <!-- ============================================================== -->


</div>
  <!-- END wrapper -->

@include('partial.Admin.new_footer')
</body>
</html>
