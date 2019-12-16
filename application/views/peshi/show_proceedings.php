<label style="margin-left: 75px;
    margin-top: 5px;">
    <b>Proceedings:</b>
    </label>
<div class="formRight" style="margin-left: 36px;
    margin-top: 7px;">
    <?php foreach($proceedings as $list) {?>
    <?php echo $list->proceedings_name;?><br>
    <?php }?>
    </div>