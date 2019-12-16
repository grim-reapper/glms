<?php
$attributes = array('class' => 'mainForm');

echo form_open_multipart('laws/edit', $attributes);
?>
<!-- Input text fields -->

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Law Details</h5>
        </div>



        <div class="rowElem  ">
            <label>Law Title:</label>
            <div class="formRight" style="width: 80%;" >
                <?php echo $law->law_title; ?>
            </div>
        </div>  
        <div class="fix"></div>

        <div class="rowElem  ">
            <label>Law Category:</label>

            <div class="formRight" style="width: 68%;">
                <?php echo $law->law_category_name; ?>

            </div>
        </div>  
        <div class="fix"></div>

        <div class="rowElem  ">
            <label>Passing Year :</label>
            <div class="formRight" style="width: 68%;" >
                <?php echo $law->law_passing_date; ?>     
            </div>

            <div class="fix"></div>
        </div>

        <div class="rowElem  ">
            <label>Image File :</label>
            <div class="formRight" style="width: 68%;" >
                <?php if ($law->img_file != '') {
                    echo anchor('uploads/laws/' . $law->img_file, $law->img_file, array('target' => '_blank'));
                } ?>
            </div>

            <div class="fix"></div>
        </div>

        <div class="rowElem  ">
            <label>PDF File :</label>
            <div class="formRight" style="width: 68%;">
                <?php if ($law->pdf_file != '') {
                    echo anchor('uploads/laws/' . $law->pdf_file, $law->pdf_file, array('target' => '_blank'));
                } ?>

            </div>

            <div class="fix"></div>
        </div>

        <div class="rowElem ">
            <label>Note: </label>
            <div class="formRight" style="width: 80%;" >
                       <?php echo $law->law_detail; ?>
            </div>

            <div class="fix"></div>
        </div>

    </div>
</div>
</fieldset>
</form>