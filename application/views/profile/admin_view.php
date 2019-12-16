<div class="widget first_form">
    <div class="head"><h5 class="iFrames">Designations</h5>
     
    </div>
 <div id="case_list">
        <table cellpadding="0" cellspacing="0" width="100%" class="display" id="propertylist">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Group</th>
                    
                </tr>
            </thead>
            <tbody>
                  <?php foreach ($designation as $list) { ?>

                <tr class="gradeA">
                    <td> <?php echo $list->designation_name;?></td>
                    <td><?php echo $list->designation_group;?></td>
                   
                </tr>
                  <?php }?>
            </tbody>

        </table>

    </div>
</div>