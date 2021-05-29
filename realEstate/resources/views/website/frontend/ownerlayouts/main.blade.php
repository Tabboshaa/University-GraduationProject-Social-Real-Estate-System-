<!DOCTYPE html>
<html lang="en">

  
<!--   15:40:28 GMT -->
            @include('website.frontend.ownerlayouts.head')

  <body id="page-top">

               @include('website.frontend.ownerlayouts.header')
    <div id="wrapper">
      <!-- Sidebar -->
		              @include('website.frontend.ownerlayouts.slidebar')
                
                  @yield('content')

			<!-- Sticky Footer -->
			            @include('website.frontend.ownerlayouts.footer')

		</div>
      <!-- /.content-wrapper -->
      
    </div>
	</div>
    <!-- /#wrapper -->
	
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

               @include('website.frontend.ownerlayouts.foot')
	
  </body>


<!--   15:44:08 GMT -->
</html>
