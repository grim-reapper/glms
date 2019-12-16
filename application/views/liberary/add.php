
<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open_multipart('liberary/add_book', $attributes);
?>

<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Liberary Entry Form</h5>
        </div>


        <div class="rowElem">
            <label>District:</label>
            <div class="formRight" >
                <select name="district" id="id"  >
                    <option value="0">Select</option>
                    <?php foreach ($district as $list) { ?>
                        <option value="<?php echo $list->district_id; ?>"><?php echo $list->district_name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <label>OwnerShip</label>
            <div class="formRight">
                <select name="ownership">
                    <option value="">Select</option>
                    <option value="Government">Govt.</option>
                    <option value="Private">Private</option>
                </select>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Name of Owner</label>
            <div class="formRight">
                <input type="text" name="name_of_owner" value="" />
            </div>
            <label>Contact No.</label>
            <div class="formRight">
                <input type="text" name="contact" value="" />
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Book Title</label>
            <div class="formRight">
                <input type="text" name="book_title" value="" />
            </div>
            <label>Author</label>
            <div class="formRight">
                <input type="text" name="author" value="" />
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Edition</label>
            <div class="formRight">
                <select name="edition">
                    <option value="">Select</option>
                    <?php for($i=1800; $i<2016;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }?>
                </select>
            </div>
            <label >Category</label>
            <div class="formRight">
                <select name="category">
                    <option value="">Select</option>
                    <option value="Law">Law</option>
                    <option value="Science">Science</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Literature">Literature</option>
                    <option value="History">History</option>
                    <option value="Religion">Religion</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Pages</label>
            <div class="formRight">
                <input type="text" name="pages" value=""/>
            </div>
            <label>Condition</label>
            <div class="formRight">
                <select name="condition">
                    <option value="">Select</option>
                    <option value="New">New</option>
                    <option value="Good">Good</option>
                    <option value="Old">Old</option>
                    <option value="Torn">Torn</option>
                    </select>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Almirah No</label>
            <div class="formRight">
                <input type="text" name="almirah_no" value="">
            </div>
            <label>Box No</label>
            <div class="formRight">
                <input type="text" name="box_no" value="">
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Status</label>
            <div class="formRight">
                <select name="status">
                    <option value="">Select</option>
                    <option value="Hard">Hard</option>
                    <option value="Soft">Soft</option>
                    <option value="e-Book">e-Book</option>
                </select>
            </div>
            <label>Price</label>
            <div class="formRight">
                <input type="text" name="price" value="">
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Title Page</label>
            <div class="formRight">
                <input type="file"   name="title_page" value="" />
            </div>
            <label>Contents</label>
            <div class="formRight">
                <input type="file"   name="contents" value="" />
            </div>

            <div class="fix"></div>
        </div>
        <div class="rowElem">
            <label>Availability</label>
            <div class="formRight">
                <select name="availability">
                    <option value="">Select</option>
                    <option value="Public">Public</option>
                    <option value="Restricted">Restricted</option>
                    <option value="Personal">Personal</option>
                </select>

            </div>
            <label>Note</label>
            <div class="formRight">
                <textarea rows="4" cols="" name="note"  placeholder=""  ></textarea>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem  noborder">
            <label></label>
            <div class="formRight">
                <input type="submit"   name="submit" value="Save" class="basicBtn"  />
                <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('liberary', 'Cancel', $attributes);
                ?>
            </div>
            <div class="fix"></div>
        </div>
    </div>


</fieldset>