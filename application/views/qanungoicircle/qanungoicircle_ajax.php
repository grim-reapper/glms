            <select name="q_id" id="qanungoi_circle">
                            <option value="">Select Qanungoi Circle</option>
                           <?php foreach($qanungoicircle_list as $qg_list) {?>
                            <option value="<?php echo $qg_list->q_id; ?>"><?php echo $qg_list->q_circle; ?></option>
                           <?php } ?>
         </select>