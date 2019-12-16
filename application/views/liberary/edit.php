<?php
echo validation_errors();
$attributes = array('class' => 'mainForm');

echo form_open('liberary/update_book', $attributes);
?>
<!-- Input text fields -->
<fieldset>
    <div class="widget first_form">
        <div class="head">
            <h5 class="iList">Edit Form</h5>
        </div>


        <div class="rowElem">
            <label>District:</label>
            <div class="formRight" >
                <select name="district" id="id"  >
                    <option value="0">Select</option>
                    
                    <?php foreach ($district as $list) { ?>
                    <?php if($book->district_id == $list->district_id){?>
                        <option value="<?php echo $list->district_id; ?>" selected="selected"><?php echo $list->district_name; ?></option>
                    <?php } else {?>
                        <option value="<?php echo $list->district_id; ?>"><?php echo $list->district_name; ?></option>
                    <?php }} ?>
                </select>
            </div>
            <label>OwnerShip</label>
            <div class="formRight">
                <select name="ownership">
                    <option value="">Select</option>
                    <?php if($book->ownership == 'Government'){?>
                    
                    <option value="Government" selected="selected">Govt.</option>
                    <option value="Private">Private</option>
                    <?php } else {?>
                     <option value="Government" >Govt.</option>
                     <option value="Private" selected="selected">Private</option>
                    <?php  }?>
                </select>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem noborder">
            <label>Name of Owner</label>
            <div class="formRight">
                <input type="text" name="name_of_owner" value="<?php echo $book->owner_name;?>" />
                <input type="hidden" name="liberary_id" value="<?php echo $book->liberary_id;?>" />
            </div>
            <label>Contact No.</label>
            <div class="formRight">
                <input type="text" name="contact" value="<?php echo $book->contact_no;?>" />
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem noborder">
            <label>Book Title</label>
            <div class="formRight">
                <input type="text" name="book_title" value="<?php echo $book->book_title;?>" />
            </div>
            <label>Author</label>
            <div class="formRight">
                <input type="text" name="author" value="<?php echo $book->book_author;?>" />
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem noborder">
            <label>Edition</label>
            <div class="formRight">
                <select name="edition">
                    <option value="">Select</option>
                    <?php for($i=1800; $i<2016;$i++){?>
                    <?php if($book->book_edition == $i){?>
                    <option value="<?php echo $i;?>" selected="selected"><?php echo $i;?></option>
                    <?php } else {?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php }} ?>
                </select>
            </div>
            <label >Category</label>
            <div class="formRight">
                <select name="category">
                    <option value="">Select</option>
                    <?php if($book->book_category == 'Law' ) {?>
                    <option value="Law" selected="selected">Law</option>
                    <option value="Science">Science</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Literature">Literature</option>
                    <option value="History">History</option>
                    <option value="Religion">Religion</option>
                    <option value="Other">Other</option>
                    <?php } else if($book->book_category == 'Science' ) {?>
                    <option value="Law" >Law</option>
                    <option value="Science" selected="selected">Science</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Literature">Literature</option>
                    <option value="History">History</option>
                    <option value="Religion">Religion</option>
                    <option value="Other">Other</option>
                    <?php } else if($book->book_category == 'Fiction' ) {?>
                    <option value="Law" >Law</option>
                    <option value="Science" >Science</option>
                    <option value="Fiction" selected="selected">Fiction</option>
                    <option value="Literature">Literature</option>
                    <option value="History">History</option>
                    <option value="Religion">Religion</option>
                    <option value="Other">Other</option>
                    <?php } else if($book->book_category == 'Literature' ) {?>
                    <option value="Law" >Law</option>
                    <option value="Science" >Science</option>
                    <option value="Fiction" >Fiction</option>
                    <option value="Literature" selected="selected">Literature</option>
                    <option value="History">History</option>
                    <option value="Religion">Religion</option>
                    <option value="Other">Other</option>
                    <?php } else if($book->book_category == 'History' ) {?>
                    <option value="Law" >Law</option>
                    <option value="Science" >Science</option>
                    <option value="Fiction" >Fiction</option>
                    <option value="Literature" >Literature</option>
                    <option value="History" selected="selected">History</option>
                    <option value="Religion">Religion</option>
                    <option value="Other">Other</option>
                    <?php } else if($book->book_category == 'Religion' ) {?>
                    <option value="Law" >Law</option>
                    <option value="Science" >Science</option>
                    <option value="Fiction" >Fiction</option>
                    <option value="Literature" >Literature</option>
                    <option value="History" >History</option>
                    <option value="Religion" selected="selected">Religion</option>
                    <option value="Other">Other</option>
                    <?php } else if($book->book_category == 'Other' ) {?>
                    <option value="Law" >Law</option>
                    <option value="Science" >Science</option>
                    <option value="Fiction" >Fiction</option>
                    <option value="Literature" >Literature</option>
                    <option value="History" >History</option>
                    <option value="Religion" >Religion</option>
                    <option value="Other" selected="selected">Other</option>
                    <?php } else  {?>
                    <option value="Law" >Law</option>
                    <option value="Science" >Science</option>
                    <option value="Fiction" >Fiction</option>
                    <option value="Literature" >Literature</option>
                    <option value="History" >History</option>
                    <option value="Religion" >Religion</option>
                    <option value="Other">Other</option>
                    <?php }?>
                   
                </select>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem noborder">
            <label>Pages</label>
            <div class="formRight">
                <input type="text" name="pages" value="<?php echo $book->pages;?>"/>
            </div>
            <label>Condition</label>
            <div class="formRight">
                <select name="condition">
                    <option value="">Select</option>
                    <?php if($book->book_condition == 'New'){?>
                    <option value="New" selected="selected">New</option>
                    <option value="Good">Good</option>
                    <option value="Old">Old</option>
                    <option value="Torn">Torn</option>
                    <?php } else if($book->book_condition == 'Good'){?>
                    <option value="New">New</option>
                    <option value="Good" selected="selected">Good</option>
                    <option value="Old">Old</option>
                    <option value="Torn">Torn</option>
                    <?php } else if($book->book_condition == 'Old'){?>
                    <option value="New">New</option>
                    <option value="Good" >Good</option>
                    <option value="Old" selected="selected">Old</option>
                    <option value="Torn">Torn</option>
                    <?php } else if($book->book_condition == 'Torn'){?>
                    <option value="New">New</option>
                    <option value="Good" >Good</option>
                    <option value="Old" >Old</option>
                    <option value="Torn" selected="selected">Torn</option>
                    <?php } else {?>
                    <option value="New">New</option>
                    <option value="Good" >Good</option>
                    <option value="Old" >Old</option>
                    <option value="Torn" >Torn</option>
                    <?php }?>
                    </select>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem noborder">
            <label>Almirah No</label>
            <div class="formRight">
                <input type="text" name="almirah_no" value="<?php echo $book->almirah_no;?>">
            </div>
            <label>Box No</label>
            <div class="formRight">
                <input type="text" name="box_no" value="<?php echo $book->box_no;?>">
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem noborder">
            <label>Status</label>
            <div class="formRight">
                <select name="status">
                    <option value="">Select</option>
                    <?php if($book->status == 'Hard') {?>
                    <option value="Hard" selected="selected">Hard</option>
                    <option value="Soft">Soft</option>
                    <option value="e-Book">e-Book</option>
                    <?php } else if($book->status == 'Soft') {?>
                    <option value="Hard" >Hard</option>
                    <option value="Soft" selected="selected">Soft</option>
                    <option value="e-Book">e-Book</option>
                    <?php } else if($book->status == 'e-Book') {?>
                    <option value="Hard" >Hard</option>
                    <option value="Soft" >Soft</option>
                    <option value="e-Book" selected="selected">e-Book</option>
                    <?php } else {?>
                    <option value="Hard">Hard</option>
                    <option value="Soft">Soft</option>
                    <option value="e-Book">e-Book</option>
                    <?php }?>
                </select>
            </div>
            <label>Price</label>
            <div class="formRight">
                <input type="text" name="price" value="<?php echo $book->price;?>">
            </div>
            <div class="fix"></div>
        </div>
       
        <div class="rowElem noborder">
            <label>Availability</label>
            <div class="formRight">
                <select name="availability">
                    <option value="">Select</option>
                    <?php if($book->availability == 'Public') {?>
                    <option value="Public" selected="selected">Public</option>
                    <option value="Restricted">Restricted</option>
                    <option value="Personal">Personal</option>
                    <?php } else if($book->availability == 'Restricted'){?>
                    <option value="Public" >Public</option>
                    <option value="Restricted" selected="selected">Restricted</option>
                    <option value="Personal">Personal</option>
                    <?php } else if($book->availability == 'Personal'){?>
                    <option value="Public" >Public</option>
                    <option value="Restricted" >Restricted</option>
                    <option value="Personal" selected="selected">Personal</option>
                    <?php } else {?>
                    <option value="Public" >Public</option>
                    <option value="Restricted" >Restricted</option>
                    <option value="Personal" >Personal</option>
                    <?php }?>
                </select>

            </div>
            <label>Note</label>
            <div class="formRight">
                <textarea rows="4" cols="" name="note"  placeholder=""  ><?php echo $book->note;?></textarea>
            </div>
            <div class="fix"></div>
        </div>
        <div class="rowElem  noborder">
            <label></label>
            <div class="formRight">
                <input type="submit"   name="submit" value="Update" class="basicBtn"  />
                <?php
                $attributes = array('class' => 'basicBtn a_button');
                echo anchor('liberary', 'Cancel', $attributes);
                ?>
            </div>
            <div class="fix"></div>
        </div>
    </div>


</fieldset>