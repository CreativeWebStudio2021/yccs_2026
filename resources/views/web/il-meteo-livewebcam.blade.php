<?
function isFile($url) {
    $headers = get_headers($url);
    if($headers && strpos($headers[0], '200') !== false) { //response code 200 means that url is fine
        return true;
    } else {
        return false;
    }
}
?>
<h2>Meteo Live Webcam</h2>
<div style="width:98%">							
	<img src="http://www.yccsfiles.com/webcam/livecamportocervo.jpg" style="width:100%" alt="Live Webcam" id="webcam"> 
</div>
<div style="clear:both"></div>
<script type="text/javascript">
	var cont=0;
	function update_webcam(){
		document.getElementById('webcam').src='http://www.yccsfiles.com/webcam/livecamportocervo.jpg?time='+cont;
		cont++;
		window.setTimeout('update_webcam()' , 36000);
	}
	window.setTimeout('update_webcam()' , 5000);
</script>