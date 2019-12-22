<script type="text/javascript">


		   // search property by tehsil

  function names_by_division(){
				var form_data = {
				division_id : $("#division").val(),
                                type : 'div'
			   }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
				data: form_data,
				success : function(msg){
                                    //alert(msg);
				    $("#d_list").html(msg)
                                    get_district_circle();
                                        }
			});
			}
  function names_by_district(){
				var form_data = {
				district_id : $("#district").val(),
				type : 'dist'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#d_list").html(msg)
                                          get_tehsil_circle();



				 }
			});
    }
  function names_by_subdivision(){
				var form_data = {
				tehsil_id : $("#subdivision").val(),
				type : 'subdiv'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#d_list").html(msg)
                                         get_qgoicircle_circle();

				 }
			});
    }
  function names_by_qgoicircle(){
                                //alert($("#qcircle").val());
				var form_data = {
				q_id : $("#qcircle").val(),
				type : 'qgcircle'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#d_list").html(msg)
                                         get_patwar_circle();

				 }

			});
    }
  function names_by_patwarcircle(){
                               // alert($("#patwar").val());
				var form_data = {
				p_id : $("#patwar").val(),
				type : 'patwar'
	         }
			$.ajax({
				type : 'POST',
				url : '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
				data: form_data,
				success : function(msg){
					 $("#d_list").html(msg)

				 }

			});
    }
    </script>
<?php
$mouza_str = '';
$p_total = 0;
$e_total = 0;
$total_ga = 0;
$pg_total ='';
$ev_total = '';
$vc_total = '';
if(!empty($survey_list )) {
    foreach ($survey_list as $list) {
        $total_ga += ($list->schedule_rate + $list->market_rate);
        $pga = json_decode($list->public_path, true);
        if ($pga) {
            foreach ($pga as $pg) {
                if ($pg['public_path_ownership'] === 'provincial_govt') {
                    $p_total += $pg['pp_area'];
                } else if ($pg['public_path_ownership'] === 'ex-evacuee') {
                    $e_total += $pg['pp_area'];
                }
            }
        }
    }
}
?>
<div class="table">
    <div class="counts">
        Total NO of Survey: <?php echo count($survey_list);?>
        Total Govt Area: <?php echo $p_total + $e_total;?>
        Total GA Price: <?php echo $total_ga?>
    </div>
  <div class="head">
    <h5 class="iFrames">Survey</h5>
          	 <?php
                $attributes = array('class' => 'basicBtn header_button','style' => ' margin-right: 290px;' );
                echo anchor('registration/add','Add Survey',$attributes);
             ?>
  </div>
    <div id="d_list">
     <table cellpadding="0" cellspacing="0" border="0" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <td width="15%">Name of Housing Scheme</td>
                        <td width="10%">Mouza.</td>
                        <td width="15%">Area of Scheme</td>
                        <td width="20%">PG Area</td>
                        <td width="15%">Evacuee Area</td>
                        <td width="15%">VLC Land Area</td>
                        <td width="15%">Total Area</td>
                        <td width="15%">PG Area Price</td>
                        <td width="15%">VCL Area Price</td>
                        <td width="15%">Evacuee Price</td>
                        <td width="15%">Total Price</td>
                        <td width="10%">Action</td>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 1;?>
                <?php
                foreach($survey_list as $list){ ?>
                	<tr class="gradeA" >
                        <td><?php echo $list->housing_scheme; ?></td>
                        <td><?php
                            $mouzas = json_decode($list->khasra_details, true);
                            if($mouzas){
                                foreach($mouzas as $mouza){
                                    $mouza_str .= $mouza['mouza'].',';
                                }
                            }
                            echo rtrim($mouza_str,',');
                            ?></td>
                        <td><?php echo $list->total_area_scheme; ?></td>
                        <td><?php
                            $pga = json_decode($list->public_path, true);
                            if($pga){
                                foreach($pga as $pg){
                                    if($pg['public_path_ownership'] === 'provincial_govt'){
                                        $pg_total .= $pg['pp_area'].',';
                                    }else if($pg['public_path_ownership']  === 'ex-evacuee'){
                                        $ev_total .= $pg['pp_area'].',';
                                    }else if($pg['public_path_ownership']  === 'village_common_land'){
                                        $vc_total .= $pg['pp_area'].',';
                                    }
                                }
                            }
                            echo rtrim($pg_total, ',');
                            ?></td>
                        <td><?php echo rtrim($ev_total, ','); ?></td>
                        <td><?php echo rtrim($vc_total, ','); ?></td>
                        <td><?php echo $list->total_area_public; ?></td>
                        <td><?php echo $list->schedule_rate; ?></td>
                        <td><?php echo $list->market_rate; ?></td>
                         <td><?php echo $list->dpac_rate; ?></td>
                        <td><?php
                            $sr = (int)$list->schedule_rate;
                            $mr = (int)$list->market_rate;
                            $dpr = (int)$list->dpac_rate;
                            echo $sr + $mr + $dpr;
                            ?></td>
                        <td>&nbsp;&nbsp;<?php echo anchor('registration/edit/'.$list->id,'Edit'); ?>
<!--                            --><?php //echo anchor('mauza/mauza_detail/'.$list->mauza_id,'|view'); ?>
                        </td>
                    </tr>
                <?php
				$i++;
				 }
				?>
                </tbody>
            </table>
           </div>
          </div>



