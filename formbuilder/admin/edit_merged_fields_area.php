<?php
include 'includes/common.php';

if(!$auth->isLoggedIn()) {
    $auth->redirect('login');
}

$row_id = (isset($_REQUEST['row_id'])) ? (int)$_REQUEST['row_id'] : '';

$app->checkMergedFieldsRowID($row_id);

if( ! empty($_POST) ) {

    if(isset($_POST['action'])) {
        $action = $_POST['action'];
    }
    
    switch ($action) {
        // Update Field
        case 'update':
        $output = $form_fields->updateMergedFieldsArea($row_id);
        break;
    }
}

$page_title = 'Edit Merged Fields Before/After Content Area';

$edit_merged_fields_area_page = 1;

include 'sections/header.php';

include 'sections/navigation.php';

if(isset($output)) {
    $note_status = ($output['success'] == 1) ? 'ok' : 'error';
    ?>
    <div class="note_<?php echo $note_status; ?>"><?php echo $output['message']; ?></div>
<?php 
}

$data = $db->getRow("SELECT form_id, before_content, after_content FROM `".$afp_conf['db']['prefix']."rows` WHERE id='".$row_id."'");

$before_content = $data['before_content'];
$after_content = $data['after_content'];

// Get Merged Fields Title
$merged_fields_array = $db->getAll(
    "SELECT f.text FROM `".$afp_conf['db']['prefix']."fields` f
     LEFT JOIN `".$afp_conf['db']['prefix']."rows_fields` rf ON (rf.field_id = f.id)
     WHERE rf.row_id='".$row_id."'"
);

$merged_fields = '';

foreach($merged_fields_array as $value) {
    $merged_fields .= $value['text'].', ';
}

$merged_fields = rtrim($merged_fields, ', ');

$form_id = $data['form_id'];
list($form_name, $form_description) = $form->getInfo($form_id);
?>

<div style="width:100%; clear:both;">
    <div style="float: left;"><h2><?php echo $form_name; ?></h2></div>
    <div style="float: right; margin:12px 0 0 0;"><strong><a href="<?php echo $conf['url']['path_to_afp_admin']; ?>edit_form_fields.php?form_id=<?php echo $form_id; ?>">&laquo; Back to form's fields list</a></strong></div>
    <div style="clear: both;"></div>
</div>

<?php if($form_description) { ?>
    <div class="desc"><?php echo $form_description; ?></div>
<?php } ?>

<p>Edit Merged Fields Before/After Content</p>
   
   <?php   
   if($mandatory == 1) {
       if(empty($validations)) {
            $no_valid_s = 'block';
       } else {
            $no_valid_s = 'none';
       }
   } else {
       $no_valid_s = 'none'; 
   }
   ?>
   
    <form id="update_data" name="update_data_form" action="" method="post">
    
        <input type="hidden" name="row_id" value="<?php echo $row_id; ?>" />
    
        <input type="hidden" name="action" value="update" />
    
        <table id="table-fields" class="fields" width="100%">
            <tr>
                <td nowrap="nowrap" valign="top"><strong>Merged Fields</strong></td>
                <td><?php echo $merged_fields; ?></td>
            </tr>
            <tr>
                <td nowrap="nowrap" valign="top"><strong>BEFORE Field Content</strong></td>
                <td><textarea name="before_content" rows="5"><?php echo $before_content; ?></textarea></td>
            </tr>
            <tr>
                <td nowrap="nowrap" valign="top"><strong>AFTER Field Content</strong></td>
                <td><textarea name="after_content" rows="5"><?php echo $after_content; ?></textarea></td>
            </tr>               
            <tr>
                <td nowrap="nowrap">&nbsp;</td>
                <td><input type="submit" name="submit" class="fancy-button-base green" value="Update" /></td>
            </tr> 
        </table>
        
        </form>
           
<?php
include 'sections/footer.php';
?>