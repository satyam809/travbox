<?php 

if($_REQUEST['fromdate']!='' && $_REQUEST['todate']!=''){

 $fromdate=$_REQUEST['fromdate'];
 $todate=$_REQUEST['todate'];

} else {
// $fromdate=date('d-m-Y', strtotime("-30 days"));
// $todate=date('d-m-Y'); 
}

?>

	
<?php include "libraryheader.php"; ?>

<div class="page-content pt-0">
<?php include "libraryleft.php"; ?>

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>



		<!-- Main content -->
		<div class="content-wrapper">

<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="selectfrm"> 
			<div class="content">
			<div class="mb-3">
					<h6 class="mb-0 font-weight-semibold">
						Library Dashboard
					</h6> 
				</div>
  			<div class="row">
					<div class="col-sm-6 col-xl-3">
							<a href="display.html?ga=hotellibrary"><div class="card card-body">
							<div class="media">
								<div class="mr-3 align-self-center"> 
									<i class="fa fa-bed text-blue-400" style="font-size: 50px;" aria-hidden="true"></i>
								</div>
							
								<div class="media-body text-right">
									<h3 class="font-weight-semibold mb-0">
										<?php
										$a=GetPageRecord('count(id) as totalobj','hotelMaster',' parentId="'.$LoginUserDetails['parentId'].'" and status=1 '); 
										$res=mysqli_fetch_array($a); echo $res['totalobj']; 
										?>
									</h3>
									<span class="text-uppercase font-size-sm text-muted">Total Hotel</span>
								</div>
							 
							</div>
						</div></a>
					</div>

					<div class="col-sm-6 col-xl-3" style="display:none;">
						<div class="card card-body">
							<a href="display.html?ga=activitylibrary"><div class="media">
								<div class="mr-3 align-self-center"> 
									<i class="fa fa-blind text-indigo-400" aria-hidden="true" style="font-size: 50px;" ></i>
								</div>

								<div class="media-body text-right">
									<h3 class="font-weight-semibold mb-0"><?php
										$a=GetPageRecord('count(id) as totalobj','activityMaster',' parentId="'.$LoginUserDetails['parentId'].'" and status=1 '); 
										$res=mysqli_fetch_array($a); echo $res['totalobj']; 
										?></h3>
									<span class="text-uppercase font-size-sm text-muted">Total Activity</span>
								</div>
							</div></a>
						</div>
					</div>

					<div class="col-sm-6 col-xl-3" style="display:none;">
						<div class="card card-body">
							<a href="display.html?ga=sightseeinglibrary"><div class="media">
								<div class="media-body">
									<h3 class="font-weight-semibold mb-0"><?php
										$a=GetPageRecord('count(id) as totalobj','sightseeingMaster',' parentId="'.$LoginUserDetails['parentId'].'" and status=1 '); 
										$res=mysqli_fetch_array($a); echo $res['totalobj']; 
										?></h3>
									<span class="text-uppercase font-size-sm text-muted">Total Sightseeing</span>
								</div>

								<div class="ml-3 align-self-center"> 
									<i class="fa fa-picture-o text-success-400" aria-hidden="true" style="font-size: 50px;"></i>
								</div>
							</div></a>
						</div>
					</div>

					<div class="col-sm-6 col-xl-3" style="display:none;">
						<div class="card card-body">
							<a href="display.html?ga=cruselibrary"><div class="media">
								<div class="media-body">
									<h3 class="font-weight-semibold mb-0"><?php
										$a=GetPageRecord('count(id) as totalobj','cruseMaster',' parentId="'.$LoginUserDetails['parentId'].'" and status=1 '); 
										$res=mysqli_fetch_array($a); echo $res['totalobj']; 
										?></h3>
									<span class="text-uppercase font-size-sm text-muted">Total Cruise</span>
								</div>

								<div class="ml-3 align-self-center"> 
									<i class="fa fa-ship text-danger-400" aria-hidden="true" style="font-size: 50px;"></i>
								</div>
							</div></a>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-sm-6 col-xl-3">
				<div class="card card-body" style="min-height: 335px;">
				<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.PieChart);

// Add data
chart.data = [ 
<?php  
$b=GetPageRecord('count(id) as totalcount, count(cityId) as toalcity, name, cityId','hotelMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 group by cityId  order by toalcity desc limit 0,3');
while($rest=mysqli_fetch_array($b)){ 

$c=GetPageRecord('*','sys_destinationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$rest['cityId'].'" and status=1 '); 
$resname=mysqli_fetch_array($c);  
?>
{
  "country": "<?php echo stripslashes($resname['name']); ?>",
  "litres": <?php echo stripslashes($rest['toalcity']); ?>
},
<?php } ?>
 ];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 1;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>

<div id="chartdiv"></div>

<h6 class="font-weight-semibold mb-0" style="font-size: 13px; text-align:center;">Top Hotel's Destinations</h6>
					 <table width="100%" border="0" cellpadding="0" cellspacing="0"  >
 
<?php  
$b=GetPageRecord('count(id) as totalcount, count(cityId) as toalcity, name, cityId','hotelMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 group by cityId  order by toalcity desc limit 0,3');
while($rest=mysqli_fetch_array($b)){ 

$c=GetPageRecord('*','sys_destinationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$rest['cityId'].'" and status=1 '); 
$resname=mysqli_fetch_array($c);  
?>
  <tr>
    <td colspan="2" style="border-bottom:1px solid #ddd; padding:10px 0px;"><a href="display.html?destination=<?php echo $rest['cityId']; ?>&ga=hotellibrary"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo stripslashes($resname['name']); ?></a></td>
    <td width="30%" align="right" style="border-bottom:1px solid #ddd; padding:10px 0px;"><?php echo stripslashes($rest['toalcity']); ?></td>
  </tr>
  <?php } ?>
</table>

<style>
tspan{  fill: #fff;}
polyline{ display:none;} 
g{ stroke: #fff;}
</style>
</div>
				</div>
				
				
				<div class="col-sm-6 col-xl-3">
				<div class="card card-body"  style="min-height: 335px;">
				<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv2", am4charts.PieChart);

// Add data
chart.data = [ 
<?php  
$b=GetPageRecord('count(id) as totalcount, count(cityId) as toalcity, name, cityId','activityMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 group by cityId  order by toalcity desc limit 0,3');
while($rest=mysqli_fetch_array($b)){ 

$c=GetPageRecord('*','sys_destinationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$rest['cityId'].'" and status=1 '); 
$resname=mysqli_fetch_array($c);  
?>
{
  "country": "<?php echo stripslashes($resname['name']); ?>",
  "litres": <?php echo stripslashes($rest['toalcity']); ?>
},
<?php } ?>
 ];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 1;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>

<div id="chartdiv2"></div>

 	<h6 class="font-weight-semibold mb-0"  style="font-size: 13px; text-align:center">Top Activities Destinations</h6>
					 <table width="100%" border="0" cellpadding="0" cellspacing="0"  >
 
<?php  
$b=GetPageRecord('count(id) as totalcount, count(cityId) as toalcity, name, cityId','activityMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 group by cityId  order by toalcity desc limit 0,5');
while($rest=mysqli_fetch_array($b)){ 

$c=GetPageRecord('*','sys_destinationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$rest['cityId'].'" and status=1 '); 
$resname=mysqli_fetch_array($c);  
?>
  <tr>
    <td colspan="2" style="border-bottom:1px solid #ddd; padding:10px 0px;"><a href="display.html?destination=<?php echo $rest['cityId']; ?>&ga=activitylibrary"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo stripslashes($resname['name']); ?></a></td>
    <td width="30%" align="right" style="border-bottom:1px solid #ddd; padding:10px 0px;"><?php echo stripslashes($rest['toalcity']); ?></td>
  </tr>
  <?php } ?>
</table>
</div>
				</div>
				
				
				<div class="col-sm-6 col-xl-3"  style="min-height: 335px;">
				<div class="card card-body">
				<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv3", am4charts.PieChart);

// Add data
chart.data = [ 
<?php  
$b=GetPageRecord('count(id) as totalcount, count(cityId) as toalcity, name, cityId','sightseeingMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 group by cityId  order by toalcity desc limit 0,3');
while($rest=mysqli_fetch_array($b)){ 

$c=GetPageRecord('*','sys_destinationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$rest['cityId'].'" and status=1 '); 
$resname=mysqli_fetch_array($c);  
?>
{
  "country": "<?php echo stripslashes($resname['name']); ?>",
  "litres": <?php echo stripslashes($rest['toalcity']); ?>
},
<?php } ?>
 ];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 1;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>

<div id="chartdiv3"></div>

 <h6 class="font-weight-semibold mb-0"  style="font-size: 13px; text-align:center;">Top Sightseeing's Destinations</h6>
					 <table width="100%" border="0" cellpadding="0" cellspacing="0"  >
 
<?php  
$b=GetPageRecord('count(id) as totalcount, count(cityId) as toalcity, name, cityId','sightseeingMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 group by cityId  order by toalcity desc limit 0,5');
while($rest=mysqli_fetch_array($b)){ 

$c=GetPageRecord('*','sys_destinationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$rest['cityId'].'" and status=1 '); 
$resname=mysqli_fetch_array($c);  
?>
  <tr>
    <td colspan="2" style="border-bottom:1px solid #ddd; padding:10px 0px;"><a href="display.html?destination=<?php echo $rest['cityId']; ?>&ga=sightseeinglibrary"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo stripslashes($resname['name']); ?></a></td>
    <td width="30%" align="right" style="border-bottom:1px solid #ddd; padding:10px 0px;"><?php echo stripslashes($rest['toalcity']); ?></td>
  </tr>
  <?php } ?>
</table>
</div>
				</div>
				
				
				<div class="col-sm-6 col-xl-3"  style="min-height: 335px;">
				<div class="card card-body">
				<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv4", am4charts.PieChart);

// Add data
chart.data = [ 
<?php  
$b=GetPageRecord('count(id) as totalcount, count(cityId) as toalcity, name, cityId','cruseMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 group by cityId  order by toalcity desc limit 0,3');
while($rest=mysqli_fetch_array($b)){ 

$c=GetPageRecord('*','sys_destinationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$rest['cityId'].'" and status=1 '); 
$resname=mysqli_fetch_array($c);  
?>
{
  "country": "<?php echo stripslashes($resname['name']); ?>",
  "litres": <?php echo stripslashes($rest['toalcity']); ?>
},
<?php } ?>
 ];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 1;
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

}); // end am4core.ready()
</script>

<div id="chartdiv4"></div>
<h6 class="font-weight-semibold mb-0" style="font-size: 13px; text-align:center;">Top Cruise's Destinations</h6>
					 <table width="100%" border="0" cellpadding="0" cellspacing="0"  >
 
<?php  
$b=GetPageRecord('count(id) as totalcount, count(cityId) as toalcity, name, cityId','cruseMaster','  parentId="'.$LoginUserDetails['parentId'].'" and status=1 group by cityId  order by toalcity desc limit 0,5');
while($rest=mysqli_fetch_array($b)){ 

$c=GetPageRecord('*','sys_destinationMaster',' parentId="'.$LoginUserDetails['parentId'].'" and id="'.$rest['cityId'].'" and status=1 '); 
$resname=mysqli_fetch_array($c);  
?>
  <tr>
    <td colspan="2" style="border-bottom:1px solid #ddd; padding:10px 0px;"><a href="display.html?destination=<?php echo $rest['cityId']; ?>&ga=cruselibrary"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo stripslashes($resname['name']); ?></a></td>
    <td width="30%" align="right" style="border-bottom:1px solid #ddd; padding:10px 0px;"><?php echo stripslashes($rest['toalcity']); ?></td>
  </tr>
  <?php } ?>
</table>
 
</div>
				</div>
				</div>
				
				
				 
</div>
</form>
</div>

</div>

<script>
$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
		if($(".checkBoxClass").prop('checked') == true){
		$('#selectandunselectall').text('Unselect All');
		$('.querylist').addClass("yellowBackground");
		}else{
		$('#selectandunselectall').text('Select All');
		$('.querylist').removeClass("yellowBackground");
		}
    });
});

function checkboxcheck(){
if ($('input.checkBoxClass').is(':checked')) {
$('#selectcheckboxbox').show();
} else { 
$('#selectcheckboxbox').hide();
}


$("input[type='checkbox']").change(function(){
    if($(this).is(":checked")){
        $(this).parent().parent().parent().parent().parent().parent().addClass("yellowBackground"); 
    }else{
        $(this).parent().parent().parent().parent().parent().parent().removeClass("yellowBackground");  
    }
});
}
</script>