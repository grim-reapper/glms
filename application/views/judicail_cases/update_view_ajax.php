
<script>
             $( "txtDate" ).live( "click", function() {
  alert( "Goodbye!" ); // jQuery 1.3+
});

                $("#txtDate").datepicker({
                    showOn: 'button',
                    //buttonText: 'View Date',
                    buttonImage: "<?php echo base_url();?>asset/images/calender.png",
                    buttonImageOnly: true,
                    dateFormat: 'yy-mm-dd'
                    
                });

                $(".ui-datepicker-trigger").mouseover(function() {
                    $(this).css('cursor', 'pointer');
                   
                    
                });

            
        </script>
<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open('judicial_cases/update_view', $attributes);
?>
<table cellpadding="0" cellspacing="0" width="100%" class="display" id="propertylist">
            	<thead>
                	<tr>
                        <th>Sr.#</th>
                        <th>Date</th>
                        <th>Case.#</th>
                        <th>Mauza</th>
                        <th>Petitioner</th>
                        <th>Respondant</th>
                        <th>Case Category</th>
                        <th style='width: 150px;'>Proceedings</th>
                        <th>Next Date</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr class="gradeA">
                        <?php $i=1; foreach ($cases as $list) {
                                     ?>
                        <td style="text-align: center;"><?php echo $i++;?></td>
                        <td style="text-align: center;"><?php echo date('d', strtotime($list->date_of_hearing)); ?>
                            <?php echo date('M', strtotime($list->date_of_hearing)); ?> 
                            <?php echo date('y', strtotime($list->date_of_hearing)); ?>
                        <input type='hidden' name='update_date1_<?php echo $list->case_id;?>' value='<?php echo $list->date_of_hearing;?>'>
                        </td>
                        <td style="text-align: center;"><?php echo $list->case_no;?></td>
                        <td><?php echo $list->mouza_name;?></td>
                        
                       <?php if($list->suing_counsel == NULL)
                        {
                          $class =" leftDir mr20 ml20 lawyerbutton";
                            $title= ' Advocate name required';
                            } else {
                            $class=" leftDir mr20 ml20 lawyerbutton";
                            $title= $list->suing_counsel ;
                        }
                       ?>
                        <td><?php echo $list->suing_party_name ;?><div class="<?php echo $class;?>" title="<?php echo $title;?>"> Vie</div></td>
                        <?php if( $list->defending_party_counsel == NULL)
                        {
                           $class=" leftDir mr20 ml20 lawyerbutton";
                            $title= ' Advocate name required';
                            
                        } else {
                            $class =" leftDir mr20 ml20 lawyerbutton";
                            $title=  $list->defending_party_counsel;
                       }
                       ?>
                         <td ><?php echo $list->defending_party_name ;?><div class="<?php echo $class;?>" title="<?php echo $title;?>"> Vie</div></td>
                        <td ><?php echo $list->case_tittle_name  ;?></td>
                        <td> 
                         <select name="case_proceedings_<?php echo $list->case_id;?>">
                        <?php foreach ($case_proceedings as $lists) { ?>
                            <?php if($lists->proceedings_id == $list->proceedings_id){ ?>
                              <option value="<?php echo $lists->proceedings_id; ?>" selected="selected"><?php echo $list->proceedings_name; ?></option>
                            <?php } else {?>
                        <option value="<?php echo $lists->proceedings_id; ?>"><?php echo $lists->proceedings_name; ?></option>
                        <?php } }?>
                        </select>
                        
                        </td>
                        <td style="text-align: center;"><input type="text" name="update_date_<?php echo $list->case_id;?>" class="datepicker"/></td>
                       
                </tr>
                    <?php }?>
                    
                 </tbody>
             </table>
         <input type="submit"   name="submit" value="Save" class="basicBtn header_button"/>
        
        <?php form_close();?>
  
