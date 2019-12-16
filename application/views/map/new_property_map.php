<html>
<head>
<title>Maps Location</title>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/jquery-1.4.4.js" ></script>
<script type="text/javascript">
 
           
		   // search property by tehsil
		   
  function update_map_marker(){
				var form_data = {
				latitude    : $("#lat").val(),
				longitude   : $("#lng").val(),
				property_id : $("#property_id").val()
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("map/update_map_marker"); ?>',
				data: form_data,
				success : function(msg){
                     alert(msg);
					}
			});	
    }
</script>
<script language="javascript" type="text/javascript">

    function SendValueToParent()

    {

        var lng = document.getElementById("lng").value;
		var lat = document.getElementById("lat").value;
        window.opener.GetValueFromChild(lat,lng);		
        window.close();
        return false;
    }

</script>
<style type="text/css">
body{ margin:0; padding:0;}
#maps{}
</style>
<?php echo $map['js']; ?>
</head>
<body>
<div id="maps"> <?php echo $map['html']; ?> </div>

<?php 
  echo form_open('map/update_map_marker');
?>

<input  type="text" name="latitude" id="lat"  value=""  readonly  />
<input type="text"  name="longitude" id="lng" value=""  readonly  />
<input  type="button" name="save" value="Save Coordinates" onClick="javascript:return SendValueToParent();" />

</form>
</body>
