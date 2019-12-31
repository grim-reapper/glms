<script type="text/javascript">


    // search property by tehsil

    function names_by_division() {
        var form_data = {
            division_id: $("#division").val(),
            type: 'div'
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
            data: form_data,
            success: function (msg) {
                //alert(msg);
                $("#d_list").html(msg)
                get_district_circle();
            }
        });
    }

    function names_by_district() {
        var form_data = {
            district_id: $("#district").val(),
            type: 'dist'
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
            data: form_data,
            success: function (msg) {
                $("#d_list").html(msg)
                get_tehsil_circle();


            }
        });
    }

    function names_by_subdivision() {
        var form_data = {
            tehsil_id: $("#subdivision").val(),
            type: 'subdiv'
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
            data: form_data,
            success: function (msg) {
                $("#d_list").html(msg)
                get_qgoicircle_circle();

            }
        });
    }

    function names_by_qgoicircle() {
        //alert($("#qcircle").val());
        var form_data = {
            q_id: $("#qcircle").val(),
            type: 'qgcircle'
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
            data: form_data,
            success: function (msg) {
                $("#d_list").html(msg)
                get_patwar_circle();

            }

        });
    }

    function names_by_patwarcircle() {
        // alert($("#patwar").val());
        var form_data = {
            p_id: $("#patwar").val(),
            type: 'patwar'
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("mauza/mauza_circle_ajax_list"); ?>',
            data: form_data,
            success: function (msg) {
                $("#d_list").html(msg)

            }

        });
    }
</script>
<?php

$dc_value = 0;
$dc_sqft = 0;
$dc_kanal = 0;
$dc_marla = 0;
?>
<div class="table">
    <div class="head">
        <h5 class="iFrames">Survey</h5>
        <?php
        $attributes = array(
            'class' => 'basicBtn header_button', 'style' => ' margin-right: 290px;'
        );
        echo anchor('registration/add', 'Add Survey', $attributes);
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
            <?php $i = 1; ?>
            <?php
            foreach ($survey_list as $list) { ?>
                <tr class="gradeA">
                    <td><?php echo $list->housing_scheme; ?></td>
                    <td><?php
                        $mouza_str = '';
                        $mouzas = json_decode($list->khasra_details, true);
                        if ($mouzas) {
                            foreach ($mouzas as $mouza) {
                                $mouza_str .= $mouza['mouza'].',';
                            }
                        }
                        echo rtrim($mouza_str, ',');
                        ?></td>
                    <td><?php echo $list->total_area_scheme; ?></td>
                    <td><?php
                        $pga = json_decode($list->public_path, true);
//                        echo '<pre>',
//                        print_r($pga);
                        if ($pga) {

                            $s_value = 0;
                            $t_marla = 0;
                            $t_kanal = 0;
                            $v_kanal = 0;
                            $e_kanal = 0;
                            $t_sqft = 0;
                            $e_marla = 0;

                            $e_sqft = 0;
                            $v_marla = 0;
                            $v_sqft = 0;
                            foreach ($pga as $pg) {
                                if ($pg['public_path_ownership'] === 'provincial_govt') {
                                    $t_kanal += $pg['kanal'];
                                    // $dc_kanal += $pg['kanal'];
                                    $t_marla += $pg['marla'];
                                    // $dc_marla += $pg['marla'];
                                    $t_sqft += $pg['sqft'];
                                    // $dc_sqft += $pg['sqft'];
                                    $dc_value += (($pg['kanal'] * 20) + $pg['marla'] + ($pg['sqft']) / 225) * $list->schedule_rate;
                                } else {
                                    if ($pg['public_path_ownership'] === 'ex-evacuee') {
                                        $e_kanal += $pg['kanal'];
                                        $e_marla += $pg['marla'];
                                        $e_sqft += $pg['sqft'];
                                    } else {
                                        if ($pg['public_path_ownership'] === 'village_common_land') {
                                            $v_kanal += $pg['kanal'];
                                            $v_marla += $pg['marla'];
                                            $v_sqft += $pg['sqft'];
                                        }
                                    }
                                }
                            }
                        }
                        printf("%02d",$t_kanal); echo '-'; printf("%02d", $t_marla); echo '-'; printf("%03d", $t_sqft);
                        $dc_kanal += $t_kanal;
                        $dc_marla += $t_marla;
                        $dc_sqft += $t_sqft;
                        /*echo $t_kanal;
                        if (!empty($t_marla)) {
                            echo '-'.$t_marla;
                        }
                        if (!empty($t_sqft)) {
                            echo '-'.$t_sqft;
                        }*/
                        ?></td>
                    <td><?php
                    printf("%02d",$e_kanal); echo '-'; printf("%02d", $e_marla); echo '-'; printf("%03d", $e_sqft);
                        /*echo $e_kanal;
                        if (!empty($e_marla)) {
                            echo '-'.$e_marla;
                        }
                        if (!empty($e_sqft)) {
                            echo '-'.$e_sqft;
                        }*/
                        ?></td>
                    <td><?php
                    printf("%02d",$v_kanal); echo '-'; printf("%02d", $v_marla); echo '-'; printf("%03d", $v_sqft);
                        /*echo $v_kanal;
                        if (!empty($v_marla)) {
                            echo '-'.$v_marla;
                        }
                        if (!empty($v_sqft)) {
                            echo '-'.$v_sqft;
                        } */
                        ?></td>
                    <?php
                    $price = 0;
                    $total_price = 0;
                    if(!empty($list->dpac_rate) && !empty($list->market_rate) && !empty($list->schedule_rate)){
                        $price = $list->dpac_rate;
                        $total_price = $list->dpac_rate * 3;

                    }else if(empty($list->dpac_rate) && !empty($list->market_rate) && !empty($list->schedule_rate)){
                        $price = $list->market_rate;
                        $total_price = $list->market_rate * 3;
                    }else if(empty($list->dpac_rate) && empty($list->market_rate) && !empty($list->schedule_rate)){
                        $price = $list->schedule_rate;
                        $total_price = $list->schedule_rate * 3;
                    }else if(!empty($list->dpac_rate) && empty($list->market_rate) && !empty($list->schedule_rate)){
                        $price = $list->dpac_rate;
                        $total_price = $list->dpac_rate * 3;
                    }else if(!empty($list->dpac_rate) && !empty($list->market_rate) && empty($list->schedule_rate)){
                        $price = $list->dpac_rate;
                        $total_price = $list->dpac_rate * 3;
                    }else if(empty($list->dpac_rate) && !empty($list->market_rate) && empty($list->schedule_rate)){
                        $price = $list->market_rate;
                        $total_price = $list->market_rate * 3;
                    }else {
                        $price = $list->schedule_rate;
                        $total_price = $list->schedule_rate * 3;
                    }

                    ?>
                    <td><?php echo $list->total_area_public; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php echo $price; ?></td>
                    <td><?php
                        echo $total_price;
                        ?></td>
                    <td width="8%">&nbsp;&nbsp;<?php echo anchor('registration/edit/'.$list->id, 'Edit'); ?>
                            <?php echo anchor('registration/survey_detail/'.$list->id,'|view');
                        ?>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" align="center"><strong>Total Govt Area(K-M-SQFT)</strong></td>
                <td colspan="4" align="center"><strong>Total GA Price</strong></td>
                <td colspan="5" align="center"><strong>Total Survey</strong></td>
            </tr>
            <tr>
                <?php
                $sq = $dc_sqft % 225;
                $mr = $dc_sqft / 225;
                $m = $dc_marla + (int) $mr;
                $marla = $m % 20;
                $k = $m / 20;
                $dc_kanal += (int) $k;
                ?>
                <td colspan="3" align="center"><strong>
                        <?php printf("%02d", $dc_kanal);
                        echo '-';
                        printf("%02d", $marla);
                        echo '-';
                        printf("%03d", $sq); ?>
                    </strong></td>
                <td colspan="4" align="center">
                    <strong>
                        <?php echo number_format($dc_value) ?>
                    </strong></td>
                <td colspan="5" align="center">
                    <strong> <?php echo count($survey_list); ?></strong></td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>



