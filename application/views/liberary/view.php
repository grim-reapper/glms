
<script type="text/javascript" charset="utf-8">
    $(function() {
        $("a[rel^='prettyPhoto']").prettyPhoto({
            animation_speed: 'fast', /* fast/slow/normal */
            slideshow: 5000, /* false OR interval time in ms */
            autoplay_slideshow: false, /* true/false */
            opacity: 0.80, /* Value between 0 and 1 */
            show_title: true, /* true/false */
            allow_resize: true, /* Resize the photos bigger than viewport. true/false */
            default_width: 500,
            default_height: 344,
            counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
            theme: 'light_rounded', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
            horizontal_padding: 20, /* The padding on each side of the picture */
            hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
            wmode: 'opaque', /* Set the flash wmode attribute */
            autoplay: true, /* Automatically start videos: True/False */
            modal: false, /* If set to true, only the close button will close the window */
            deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
            overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
            keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
            changepicturecallback: function() {
            }, /* Called everytime an item is shown/changed */
            callback: function() {
            }, /* Called when prettyPhoto is closed */
            ie6_fallback: true,
        });

    });
</script>
<fieldset>  
    <div class="widget first_form"> 

        <div class="head " >
            <h5>Book Detail</h5>
            <?php
            $attributes = array('class' => 'basicBtn header_button');
            echo anchor('liberary', 'Close', $attributes);
            ?>
        </div>

    </div>

    <div class="body">
        <div class="rowElem Odd">
            <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>District Name</th>
                        <th>Ownership</th>
                        <th>Book Title &nbsp; &nbsp;
                            <?php if ($book->title_page == 'title_page_') { ?>
                                <a class="disable_link"  href="#" >View </a>
                            <?php } else { ?>
                                <a rel="prettyPhoto" href="<?php echo base_url() . 'uploads/' . $book->title_page; ?>" >View </a>
<?php } ?>
                        </th>
                        <th>Owner Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="text-align: center;">
                        <td><?php echo $book->district_name; ?></td>
                        <td><?php echo $book->ownership; ?></td>
                        <td><?php echo $book->book_title; ?> &nbsp; &nbsp;
                            <?php if ($book->contents == 'contents_') { ?>
                                <a class="disable_link"  href="#" >View Index</a>
                            <?php } else { ?>
                                <a rel="prettyPhoto" href="<?php echo base_url() . 'uploads/' . $book->contents; ?>" > View Index</a>
<?php } ?>

                        </td>
                        <td><?php echo $book->owner_name; ?></td>
                    </tr>
                </tbody>
            </table>


            <div class="rowElem Odd">
                <h3 style="background: white; color: #2B6893;">Details</h3>
            </div>
            <div class="rowElem">
                <div class="label">Author: </div>
                <div class="cotent"> <?php echo $book->book_author; ?> </div>
                <div class="label">Contact no: </div>
                <div class="cotent"> <?php echo $book->contact_no; ?> </div>

            </div>
            <div class="rowElem">
                <div class="label">Category: </div>
                <div class="cotent"> <?php echo $book->book_category; ?> </div>
                <div class="label">Edition: </div>
                <div class="cotent"> <?php echo $book->book_edition; ?> </div>

            </div>
            <div class="rowElem">
                <div class="label">Condition: </div>
                <div class="cotent"> <?php echo $book->book_condition; ?> </div>
                <div class="label">Pages: </div>
                <div class="cotent"> <?php echo $book->pages; ?> </div>

            </div>
            <div class="rowElem">
                <div class="label">Almirah no: </div>
                <div class="cotent"> <?php echo $book->almirah_no; ?> </div>
                <div class="label">Box no: </div>
                <div class="cotent"> <?php echo $book->box_no; ?> </div>

            </div>
            <div class="rowElem">
                <div class="label">Status: </div>
                <div class="cotent"> <?php echo $book->status; ?> </div>
                <div class="label">Price: </div>
                <div class="cotent"> <?php echo $book->price; ?> </div>

            </div>
            <div class="rowElem">
                <div class="label">Availability: </div>
                <div class="cotent"> <?php echo $book->availability; ?> </div>
                <div class="label">Note: </div>
                <div class="cotent"> <?php echo $book->note; ?> </div>
            </div>


            <div class="rowElem">


            </div>

            </fieldset>