<?php 
 if($bookingServiceType!='')
 {
 ?>
 <script>
 function getResponseCheck()
 {
	 $('#payResponseId').load('actionpage.php?action=paymentGatewayPayment&serviceId=<?php echo $_SESSION['serviceId']; ?>&type=<?php echo $bookingServiceType; ?>');

 }
 const myTimeout = setInterval(getResponseCheck, 2000);
 </script>

<div id="payResponseId" style="display:none"></div>
<?php } ?> 


<div style="position:fixed; right:10px; bottom:50px; width:250px;" id="notificationpop"></div>
<div style="display:none;" id="popactionhide"></div>
<script>
function playSound()
{
    var audio = new Audio('https://flyshop.in/masteradmin/upload/mixkit-positive-notification-951.wav');
    audio.play();
}


setInterval(function(){
$('#notificationpop').load('loadnotificationpop.php');
}, 3000);

function hidenotpop(id,type){
 
$('#popactionhide').load('actionpage.php?action=popactionhide&id='+id+'&type='+type);
}
</script>

<div class="navbar navbar-expand-lg navbar-light" style="display:none;">
		<div class="text-center d-lg-none w-100">
			<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
				<i class="icon-unfold mr-2"></i>
				Footer
			</button>
		</div>

		<div class="navbar-collapse collapse" id="navbar-footer">
			<span class="navbar-text">
				<?php echo $footerversion; ?>
			</span>

			<ul class="navbar-nav ml-lg-auto">
				
			</ul>
		</div>
	</div>
	
	
<iframe id="actoinfrm" name="actoinfrm" src="" style="display:none;"></iframe>

<script>
function getSearchAgent(pickupAgentSearchfromAgent,agentresultfield,listsearch){

var agentsearchfieldval = encodeURI($('#'+pickupAgentSearchfromAgent).val());  
var pickupAgentSearchfromAgent = pickupAgentSearchfromAgent;

if(agentsearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchagentlists.php?keyword='+agentsearchfieldval+'&searchagentlists='+listsearch+'&agentresultfield='+agentresultfield+'&pickupAgentSearchfromAgent='+pickupAgentSearchfromAgent);
}
}



function getSearchCIty(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchcitylists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}





function getSearchCItyName(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchcityNamelists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}


function redirectpage(pages){
window.location.href = pages;
$('#loadingwhite').hide();
}

function showloading(){
$('#loadingwhite').show();
}

$("form").on('submit', function (e) {
 $('#loadingwhite').show();
});





function loadpop(pagetitle,obj,width){
$('#popcontent').html('<div style="padding:10px; text-align:center;"><img src="https://goinmyway.in/software/images/loading.gif" width="32" ></div>');
var popaction = $(obj).attr('popaction'); 
$('#poptitle').html(pagetitle);
$('.modal-dialog').css('max-width',width);
$('#popcontent').load('loadpopup.php?'+popaction);
}



function hideModal() {
  $("#myModal").removeClass("in");
  $(".modal-backdrop").remove();
  $('body').removeClass('modal-open');
  $('body').css('padding-right', '');
  $(".modal").hide();
}

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>


<div style="width: 100%; height: 100%; z-index: 999999; background-color: #ffffffb8; position: fixed; left: 0px; top: 0px; text-align: center; display:none;" id="loadingwhite">

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" align="left" valign="bottom"><div style="padding: 15px 20px; background-color: #FFFFFF; display: inline-block; width: auto;"><i class="icon-spinner2 spinner"></i> &nbsp;Wait please...</div></td>
    </tr>
</table>

</div>





<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="" style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="card-header header-elements-inline" style="border-bottom: 1px solid #ddd;">
                                                            <h5 class="modal-title mt-0" id="poptitle"></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div id="popcontent">
                                                           
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
											

<div id="footer_action_div" style="display:none;"></div>