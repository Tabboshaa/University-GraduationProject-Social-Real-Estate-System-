<!DOCTYPE html>
<html lang="en">

  
<!--   15:40:28 GMT -->
            @include('website.frontend.layouts.head')

  <body id="page-top">

               @include('website.frontend.layouts.header')
    <div id="wrapper">
      <!-- Sidebar -->
		              @include('website.frontend.layouts.slidebar')
                
                  @yield('content')

			<!-- Sticky Footer -->
			            @include('website.frontend.layouts.footer')

		</div>
      <!-- /.content-wrapper -->
      
    </div>
	</div>
    <!-- /#wrapper -->
	
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

               @include('website.frontend.layouts.foot')
	
  </body>


<!--   15:44:08 GMT -->
</html>
