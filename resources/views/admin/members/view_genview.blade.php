<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />

<link rel="stylesheet" href="{{ asset('public/jorg-charts/tree.css') }}" />
 <style type="text/css">
   .jOrgChart {
            margin: 10px;
            padding: 20px;
        }

        .jOrgChart .node {
            font-size: 14px;
            background-color: #35363B;
            border: 5px solid white;
            color: #F38630;
            -moz-border-radius: 8px;
        }

        .node label {
            font-family: tahoma;
            font-size: 14px;
            line-height: 11px;
            padding-top: 30px;
        }
		.jOrgChart .down {
    background-color: #808080;
    margin: 21px auto 0 !important;
}
    </style>
<div id="content">
  <div id="content-header">
   
  <div class="container-fluid"><br><br>
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
           
            <div class="widget-content nopadding">
             
			 <ul id="org" style="display:none">
        <li>
		<?php 
		if(empty($userDetails->profile_image)){
				$userDetails->profile_image='avatar.png';
			}
		?>
            <label><div class="image_jorg"><img style="width:165px;height:165px;" src="{{ asset('/images/backend_images/member/micro/'.$userDetails->profile_image) }}"> <h1><?php echo $userDetails->firstname;?></h1></div></label>
			<?php echo $tree; ?> </br>
        </li>
    </ul>
	<div id="chart" style="height:80%;padding-bottom: 80px;" class="orgChart">
	 
        
		</div>
		<div align="center">
		<div class="zoom">
            <span class="zoom_control">+</span>

            <div id="zoom_slider"></div>
            <span class="zoom_control">-</span>
        </div>
		<a id="minusBtn" onclick="minus()" style="cursor:pointer"><img src="{{ asset('/images/backend_images/plus.png') }}" /></a>
		<a id="plusBtn" onclick="plus()" style="cursor:pointer"><img src="{{ asset('/images/backend_images/minus.png') }}" /></a>
</div>
   <br/><br/><br/>


<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#org").jOrgChart({
            chartElement: '#chart',
            dragAndDrop: false,
            slider: true
        });
        $('#chart .cgsnode').tooltip();
        $('#chart').kinetic();
    });
</script>
<script>
    jQuery(document).ready(function() {
	
        var currIEZoom = 100;
            $('body').css('zoom', ' ' + currIEZoom + '%');
        
    });
    var currFFZoom = 1;
    var currIEZoom = 100;

    function plus(){
            
            var step = 0.05;
            currFFZoom += step;
            $('body').css('MozTransform','scale(' + currFFZoom + ')');
            var stepie = 25;
            currIEZoom += stepie;
            $('body').css('zoom', ' ' + currIEZoom + '%');

    };
    function minus(){
        if(currFFZoom > 0.05 ) {
            var step = 0.05;
            currFFZoom -= step;
            $('body').css('MozTransform','scale(' + currFFZoom + ')');
            var stepie = 25;
            currIEZoom -= stepie;
            $('body').css('zoom', ' ' + currIEZoom + '%');
        }
    };
</script>



<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="{{ asset('public/jorg-charts/jquery.jOrgChart.js') }}"></script>
<script src="{{ asset('public/jorg-charts/tree.js') }}"></script>
<script src="{{ asset('public/jquery-kinetic/jquery.kinetic.js') }}"></script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
