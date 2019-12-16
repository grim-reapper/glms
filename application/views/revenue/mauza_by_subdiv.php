 <option value="0">Select Mauza</option>
                    <?php foreach ($mauza as $b_list) { ?>
                        <option value="<?php echo $b_list->mauza_id; ?>"><?php echo $b_list->mouza_name; ?></option>
                    <?php } ?>