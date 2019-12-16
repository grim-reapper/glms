<script type="text/javascript">


    // search property by tehsil

    function books_by_district() {
        var form_data = {
            district_id: $("#district").val()

        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("liberary/books_by_district"); ?>',
            data: form_data,
            success: function(msg) {
                //alert(msg);
                $("#book_list").html(msg)

                oTable = $('#propertylist').dataTable({
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "sDom": '<""f>t<"F"lp>'
                });


            }
        });
    }
    function books_by_private() {
        var form_data = {
            private: 'Private'

        }
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("liberary/books_by_private"); ?>',
            data: form_data,
            success: function(msg) {
                //alert(msg);
                $("#book_list").html(msg)

                oTable = $('#propertylist').dataTable({
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "sDom": '<""f>t<"F"lp>'
                });


            }
        });
    }
    function books_by_govt() {

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("liberary/books_by_govt"); ?>',
            success: function(msg) {
                //alert(msg);
                $("#book_list").html(msg)

                oTable = $('#propertylist').dataTable({
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "sDom": '<""f>t<"F"lp>'
                });


            }
        });
    }
    function books_all() {

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("liberary/books_all"); ?>',
            success: function(msg) {
                //alert(msg);
                $("#book_list").html(msg)

                oTable = $('#propertylist').dataTable({
                    "bJQueryUI": true,
                    "sPaginationType": "full_numbers",
                    "sDom": '<""f>t<"F"lp>'
                });


            }
        });
    }

</script>
<div id="sub_bar">
    <?php $this->load->view("mauza/mauza_js"); ?>        

    <select name="division_id" id="district" onchange="books_by_district();">
        <option value="">Select District</option>
        <?php foreach ($district as $list) { ?>
            <option value="<?php echo $list->district_id; ?>"><?php echo $list->district_name; ?></option>
        <?php } ?>
    </select>
</div>
<div class="widget first_form">
    <div class="head"><h5 class="iFrames"> Liberary</h5>
        <?php
        $attributes = array('class' => 'basicBtn header_button', 'style' => ' margin-right: 290px;');
        $attributes1 = array('class' => 'basicBtn header_button');
        echo anchor('liberary/add_book', 'Add Books', $attributes);
        ?>
        <button class="basicBtn header_button" onclick="books_by_private();">Private Libs</button>
        <button class="basicBtn header_button" onclick="books_by_govt();">Govt. Libs</button>
        <button class="basicBtn header_button" onclick="books_all();">All Books</button>

    </div>
    <div id="book_list">
        <table cellpadding="0" cellspacing="0" width="100%" class="display" id="propertylist">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Category</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Edition</th>
                    <th>Ownership</th>
                    <th>Availability</th>
                    <th>Note</th>
                    <th>Detail</th>


                </tr>
            </thead>
            <tbody>
                <?php foreach ($lib_data as $data) { ?>
                    <tr class="gradeA">
                        <td style="text-align: center;"><?php echo $data->book_unique_id; ?></td>
                        <td><?php echo $data->book_category; ?></td>
                        <td><?php echo $data->book_title; ?></td>
                        <td><?php echo $data->book_author; ?></td>
                        <td style="text-align: center;"><?php echo $data->book_edition; ?></td>
                        <td><?php echo $data->ownership; ?></td>
                        <td><?php echo $data->availability; ?></td>
                        <?php
                        $att = array(
                            'class' => " leftDir mr20 ml20",
                            'title' => $data->note
                        );
                        ?>
                        <td style="text-align: center;"><?php echo anchor('#', 'View', $att); ?></td>

                        <td width="8"  align="center">

                            <img src="<?php echo base_url(); ?>asset/images/plus.png" id="action_list_<?php echo $data->liberary_id ?>" onclick="list_action(<?php echo $data->liberary_id ?>);"   />

                            <ul id="list_action" class="list_action_<?php echo $data->liberary_id; ?>" style="margin-right: 9px;
                                margin-top: -6px;"   >

                                <?php
                                echo ' <li>';
                                echo anchor('liberary/view/' . $data->liberary_id, 'View');
                                echo ' </li>';
                                echo ' <li>';
                                echo anchor('liberary/edit/' . $data->liberary_id, 'Edit');
                                echo ' </li>';


                                echo ' <li>';
                                echo anchor('mauza/delete/' . $data->liberary_id, 'Delete');
                                echo ' </li>';
                                ?>
                            </ul>



                    </tr>
<?php } ?>
            </tbody>

        </table>

    </div>
</div>


