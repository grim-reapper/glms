                     <option value=""> Select Category </option>
                    <?php foreach ($category as $c_list) { ?>
                        <option value="<?php echo $c_list->case_category_id; ?>"><?php echo $c_list->case_category_name; ?></option>
                    <?php } ?>
              
