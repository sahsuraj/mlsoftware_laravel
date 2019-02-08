<!DOCTYPE html>
<html lang="en">
<head>
<title>LIFE IN BALANCE CAREERS</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-responsive.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/uniform.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/fullcalendar.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/matrix-style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/matrix-media.css') }}" />
<link href="{{ asset('public/fonts/backend_fonts/css/font-awesome.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/backend_css/jquery.gritter.css') }}" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>

@include('layouts.adminLayout.admin_header')
@include('layouts.adminLayout.admin_sidebar')

@yield('content')

<!--end-main-container-part-->
@include('layouts.adminLayout.admin_footer')
<?php if(request()->segment(1)=='admin' && request()->segment(2)=='dashboard'){?>
<script src="{{ asset('js/backend_js/excanvas.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.ui.custom.js') }}"></script> 
<script src="{{ asset('js/backend_js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.flot.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.flot.resize.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.peity.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/fullcalendar.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.dashboard.js') }}"></script> 
<!--<script src="{{ asset('js/backend_js/jquery.gritter.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.interface.js') }}"></script> -->
<script src="{{ asset('js/backend_js/matrix.chat.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.validate.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.form_validation.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.wizard.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.uniform.js') }}"></script> 
<script src="{{ asset('js/backend_js/select2.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.popover.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.tables.js') }}"></script> 



<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>

<?php }else{ ?>
<script src="{{ asset('js/backend_js/jquery.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.ui.custom.js') }}"></script> 
<script src="{{ asset('js/backend_js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.uniform.js') }}"></script> 
<script src="{{ asset('js/backend_js/select2.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.validate.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.js') }}"></script>
<script src="{{ asset('js/backend_js/matrix.tables.js') }}"></script> 


<?php if(request()->segment(1)=='admin' && request()->segment(2)=='change_password'){?> 
             <script src="{{ asset('js/backend_js/matrix.form_validation.js') }}"></script>
<?php }elseif(request()->segment(1)=='admin' && request()->segment(2)=='members' && request()->segment(3)=='add-mdemberss'){?>
              <script src="{{ asset('js/backend_js/matrix.form_validation.js') }}"></script>
 
 <?php }elseif(request()->segment(1)=='admin' && request()->segment(2)=='emailtemplates' && request()->segment(3)=='edit'){?>
 
		    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
			<script>
				CKEDITOR.replace( 'summary-ckeditor' );
			</script>
 <?php }elseif(request()->segment(1)=='admin' && request()->segment(2)=='cmspages' && request()->segment(3)=='edit' || request()->segment(3)=='add-cmspage'){?>
			 <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
			<script>
				CKEDITOR.replace( 'summary-ckeditor' );
			</script>
 <?php }elseif(request()->segment(1)=='admin' && request()->segment(2)=='newsletters'){?>
			 <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
			<script>
				CKEDITOR.replace( 'summary-ckeditor' );
			</script>
<?php }elseif(request()->segment(1)=='admin' && request()->segment(2)=='faqs'){?>
			 <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
			<script>
				CKEDITOR.replace( 'summary-ckeditor' );
				CKEDITOR.replace( 'summary-ckeditor2' );
			</script>	
<?php }elseif(request()->segment(1)=='admin' && request()->segment(2)=='generalsetting'){?>
			 <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
			<script>
				CKEDITOR.replace( 'summary-ckeditor' );
				CKEDITOR.replace( 'summary-ckeditor2' );
			</script>			
			
<?php }elseif(request()->segment(1)=='admin' && request()->segment(2)=='reports' && request()->segment(3)=='customer'){?>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script> 
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> 
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> 
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> 

<?php }else{ ?>

<?php }?>

<?php }?>
</body>
</html>
