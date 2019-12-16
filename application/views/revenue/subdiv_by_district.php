<option value="0">Select Tehsil</option>
                    <?php foreach ($subdiv as $c_list) { ?>
                        <option value="<?php echo $c_list->tehsil_id; ?>"><?php echo $c_list->tehsil_name; ?></option>
                    <?php } ?>