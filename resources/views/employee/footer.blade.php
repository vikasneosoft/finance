 <!-- /.content-wrapper -->
 <footer class="main-footer">
     <strong>Copyright &copy; <?php echo date('Y'); ?></strong>
     All rights reserved.
     <div class="float-right d-none d-sm-inline-block">
         <b></b>
     </div>
 </footer>

 <aside class="control-sidebar control-sidebar-dark">
 </aside>
 </div>
 <script src="{{ asset('public/js/jquery.min.js') }}" type="text/javascript"></script>
 <script src="{{ asset('public/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
 <script src="{{ asset('public/js/sparkline.js') }}" type="text/javascript"></script>

 <script src="{{ asset('public/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
 <script src="{{ asset('public/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
 <script src="{{ asset('public/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
 <script src="{{ asset('public/js/responsive.bootstrap4.min.js') }}" type="text/javascript"></script>

 <script src="{{ asset('public/js/jquery.overlayScrollbars.min.js') }}" type="text/javascript"></script>
 <script src="{{ asset('public/js/adminlte.js') }}" type="text/javascript"></script>
 <script src="{{ asset('public/js/dashboard.js') }}" type="text/javascript"></script>
 <script src="{{ asset('public/js/demo.js') }}" type="text/javascript"></script>
 <script type="text/javascript">
     $(document).ready(function() {
         setTimeout(function() {
             $('.alert-success').fadeOut('fast');
             $('.alert-danger').fadeOut('slow');
         }, 5000);

         setTimeout(function() {
             $('.flashMessage').fadeOut('slow');
         }, 3000);
     });
 </script>

 @yield('employee-js')
 </body>

 </html>
