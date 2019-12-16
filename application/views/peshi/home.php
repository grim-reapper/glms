
      <head>
      <script type="text/javascript">
          
            $(document).ready(function() {

                $("#date_hearing").datepicker({
                  
                    dateFormat: 'yy-mm-dd'
                    
                });

            

            });
          
         function block1()
         {
             var form_data = {
            block_id:  $('#block_1').val()
                };
                   $.ajax({
            type: 'POST',
            url: '<?php echo site_url("peshi_list/get_proceedings_by_group_id"); ?>',
            data: form_data,
            success: function(msg) {
            $('#b').html(msg);
            }
        });
         }
          
         function block2()
         {
             var form_data = {
            block_id:  $('#block_2').val()
                };
                   $.ajax({
            type: 'POST',
            url: '<?php echo site_url("peshi_list/get_proceedings_by_group_id"); ?>',
            data: form_data,
            success: function(msg) {
            $('#b1').html(msg);
            }
        });
         }
          
         function block3()
         {
             var form_data = {
            block_id:  $('#block_3').val()
                };
                   $.ajax({
            type: 'POST',
            url: '<?php echo site_url("peshi_list/get_proceedings_by_group_id"); ?>',
            data: form_data,
            success: function(msg) {
            $('#b2').html(msg);
            }
        });
         }
          
         function block4()
         {
             var form_data = {
            block_id:  $('#block_4').val()
                };
                   $.ajax({
            type: 'POST',
            url: '<?php echo site_url("peshi_list/get_proceedings_by_group_id"); ?>',
            data: form_data,
            success: function(msg) {
            $('#b3').html(msg);
            }
        });
         }
         
         function generate_list()
         {
          if($('#select_format').val() == 0)
              {
                  
           
              
        if($('#block_1').val() && $('#block_2').val() && $('#block_3').val() && $('#block_4').val() )

                 {
                     
                 if($('#date_hearing').val())
                     {
            
         
            
             var form_data = {
                  block_1:  $('#block_1').val(),
                  block_2:  $('#block_2').val(),
                  block_3:  $('#block_3').val(),
                  block_4:  $('#block_4').val(),
                  date:     $('#date_hearing').val()
           
                };
                 $.ajax({
            type: 'POST',
            url: '<?php echo site_url("peshi_list/generate_list"); ?>',
            data: form_data,
            success: function(msg) {
            $('#p_list').show();
            $('#p_list').html(msg);
            $('#f_list').hide();
            $('#genrate').hide();
            $('#print').show();
            $('#one_b').hide();
            $('#two_b').hide();
            $('#three_b').hide();
            $('#four_b').hide();
            $('#date').hide();
            $('#sub_bar').show();
            }
                });
         }
         else{
         alert('Select the Date');
         }
         }
         else
         {
         alert('First Select All the Blocks');
         }
         }
         else if($('#select_format').val() == 1)
         {
                var form_data = {
                  block_1:  $('#block_1').val(),
                  block_2:  $('#block_2').val(),
                  block_3:  $('#block_3').val(),
                  block_4:  $('#block_4').val(),
                  date:     $('#date_hearing').val()
           
                };
                 $.ajax({
            type: 'POST',
            url: '<?php echo site_url("peshi_list/generate_list_court"); ?>',
            data: form_data,
            success: function(msg) {
            $('#f_list').show();
            $('#f_list').html(msg);
            $('#genrate').hide();
            $('#p_list').hide();
            $('#print').show();
            $('#one_b').hide();
            $('#two_b').hide();
            $('#three_b').hide();
            $('#four_b').hide();
            $('#date').hide();
            $('#sub_bar').show();
           
            }
                });
        
         }
         }
           
       
             
          </script>
        <script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=600,width=950');
        mywindow.document.write('<html><head><title>my div</title>');
        mywindow.document.write('<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/css/main.css" />');
        
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }
     </script>
          </head>
 
    
          <div id="sub_bar" style="display: none;" onchange="generate_list();">
        <select id="select_format">
        <option value="0">Public Format</option>
        <option value="1">Court Format</option>
        </select>
         </div>


    
   
<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');
echo form_open('peshi_list/generate', $attributes);
?>

<fieldset>  
<div class="widget first_form"> 
<div class="head " >
    <h5>Generate Peshi List</h5>
    
       <?php
           $attributes = array('class' => 'basicBtn header_button' );
            echo anchor('judicial_cases','Close',$attributes);
       ?>
  </div>
    <div id="mydd">
    <div class="rowElem Odd">
      <h3 style="background: white; color: black;">IN THE COURT OF  Mr. IRFAN NAWAZ MEMON, ADDITIONAL DISTRICT COLLECTOR (REVENUE), LAHORE</h3>
    </div>
     <div class="rowElem" id="date">
            <label style="width:163px" >Date</label>
            <div class="formRight" style="width:120px">
                <input type="text" name="date" id="date_hearing" value="" />
            </div>
            <div class="fix"></div>
            </div>
    
     <div class="rowElem noborder" id="one_b" >
        <label>First Block</label>
          <div class="formRight">
                <select id="block_1" onchange="block1();" style="display: block;">
                <option value="">Select</option>
                <?php foreach($groups as $list) { ?>
                <option value="<?php echo $list->group_id;?>"><?php echo $list->group_name;?></option>
                <?php }?>
                </select>
            </div>
            <div id="b">
            </div>
        </div>
     <div class="rowElem noborder" id="two_b" >
        <label>Second Block</label>
          <div class="formRight">
                <select id="block_2" onchange="block2();">
                <option value="" >Select</option>
                <?php foreach($groups as $list) { ?>
                <option value="<?php echo $list->group_id;?>"><?php echo $list->group_name;?></option>
                <?php }?>
                </select>
            </div>
            <div id="b1">
            </div>
        </div>
     <div class="rowElem noborder" id="three_b" >
        <label>Third Block</label>
          <div class="formRight">
                <select id="block_3" onchange="block3();">
                <option value="">Select</option>
                <?php foreach($groups as $list) { ?>
                <option value="<?php echo $list->group_id;?>"><?php echo $list->group_name;?></option>
                <?php }?>
                </select>
            </div>
            <div id="b2">
            </div>
        </div>
     <div class="rowElem noborder" id="four_b" >
        <label>Fourth Block</label>
          <div class="formRight">
                <select id="block_4" onchange="block4();">
                <option value="" >Select</option>
                <?php foreach($groups as $list) { ?>
                <option value="<?php echo $list->group_id;?>"><?php echo $list->group_name;?></option>
                <?php }?>
                </select>
            </div>
            <div id="b3">
            </div>
        </div>
    <div id="p_list">
        
    </div>
        <div id="f_list">
            </div>
    
    
       
  
        
    <?php form_close();?>
        </div>
   
   
      <div class="rowElem noborder">
        <label>
            </label>
<div class="formRight" id="genrate">
   
                <input  type="button"  onclick="generate_list();"  name="submit" value="Generate List" class="basicBtn"  />
                </div>
        <div class="clear"></div>
    </div>
      <div class="rowElem noborder">
        <label>
            </label>
<div class="formRight" id="print" style="display: none;">
   
                <input  type="button"  name="submit" value="Print" class="basicBtn" onclick="PrintElem('#mydd');"  />
                </div>
        <div class="clear"></div>
    </div>
     
    </div>
<!--  <button onclick="generate_list();">Genrate</button>-->