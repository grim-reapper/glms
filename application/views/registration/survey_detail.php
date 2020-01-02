<script type="text/javascript" charset="utf-8">
    $(function () {
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
            changepicturecallback: function () {
            }, /* Called everytime an item is shown/changed */
            callback: function () {
            }, /* Called when prettyPhoto is closed */
            ie6_fallback: true,

        });

    });
</script>

<fieldset>
    <div class="widget first_form">

        <div class="head ">
            <h5>Survey Detail</h5>
            <?php
            $attributes = array('class' => 'basicBtn header_button');
            echo anchor('registration', 'Close', $attributes);
            ?>
        </div>
    </div>

    <div class="body">
        <div class="rowElem Odd">
            <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                <tr>
                    <th>Name of housing scheme</th>
                    <th>Name of contact person</th>
                    <th>CNIC of Contact person</th>
                    <th>Phone of contact person</th>
                </tr>
                </thead>
                <tbody>
                <tr style="text-align: center;">
                    <td><?php echo $survey->housing_scheme; ?></td>
                    <td><?php echo $survey->contact_person_name; ?></td>
                    <td><?php echo $survey->contact_person_cnic; ?></td>
                    <td><?php echo $survey->contact_person_phone; ?></td>
                </tr>
                </tbody>
            </table>

            <div class="rowElem Odd">
                <h3 style="background: white; color: #2B6893;">Owners</h3>
            </div>
            <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                <tr>
                    <th>Owner name</th>
                    <th>Owner CNIC</th>
                    <th>Owner phone</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $owners = json_decode($survey->owners);
                foreach ($owners as $owner) {
                    ?>
                    <tr style="text-align: center;">
                        <td><?php echo $owner->name; ?></td>
                        <td><?php echo $owner->cnic; ?></td>
                        <td><?php echo $owner->contact; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="rowElem">
                <div class="label">Category of scheme:</div>
                <div class="cotent"> <?php echo $survey->scheme; ?> </div>
                <div class="label">Sanction status of shceme:</div>
                <div class="cotent"> <?php echo ucwords(str_replace('_', ' ', $survey->sanction_status)); ?> </div>
            </div>
            <div class="rowElem">
                <div class="label">Location:</div>
                <div class="cotent"> <?php echo $survey->location; ?> </div>
                <div class="label">Vacant Area:</div>
                <div class="cotent"> <?php echo $survey->vacant_area; ?> </div>
            </div>
            <br>
            <br>
            <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                <tr>
                    <th>Khasra no</th>
                    <th>Area (k-m-sqft)</th>
                    <th>Mouza</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $khasra_details = json_decode($survey->khasra_details);
                foreach ($khasra_details as $khasra) {
                    ?>
                    <tr style="text-align: center;">
                        <td><?php echo $khasra->khasra_no; ?></td>
                        <td><?php printf("%02d", $khasra->kanal);
                            echo '-';
                            printf("%02d", $khasra->marla);
                            echo '-';
                            printf("%03d", $khasra->sqft); ?></td>
                        <td><?php echo $khasra->mouza; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="rowElem">
                <div class="label">Previous background of Record:</div>
                <div class="cotent"> <?php echo ucwords(str_replace('_', ' ', $survey->pbo_land)); ?> </div>
                <div class="label">Khasra No:</div>
                <div class="cotent"> <?php echo $survey->khasra_no_land; ?> </div>
            </div>
            <div class="rowElem Odd">
                <h3 style="background: white; color: #2B6893;">Public area path</h3>
                <table class="tableStatic" width="100%" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th>Public Paths, Watercourses</th>
                        <th>Ownership</th>
                        <th>Khasra No</th>
                        <th>Area (K-M-Sqft)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $public_path = json_decode($survey->public_path);
                    foreach ($public_path as $path) {
                        ?>
                        <tr style="text-align: center;">
                            <td><?php echo ucwords(str_replace('_', ' ',
                                    $path->public_path)); ?></td>
                            <td><?php echo ucwords(str_replace('_', ' ',
                                    $path->public_path_ownership)); ?></td>
                            <td><?php echo $path->pp_khasra_no; ?></td>
                            <td><?php printf("%02d", $path->kanal);
                                echo '-';
                                printf("%02d", $path->marla);
                                echo '-';
                                printf("%03d", $path->sqft); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="rowElem">
                    <div class="label">Schedule Rate /Marla</div>
                    <div class="cotent"> <?php echo $survey->schedule_rate;?></div>
                    <div class="label">Market Price/Marla</div>
                    <div class="cotent"> <?php echo $survey->market_rate?></div>
                    <div class="label">DPAC Price/Marla</div>
                    <div class="cotent"> <?php echo $survey->dpac_rate?></div>
                </div>
            </div>
            <div class="rowElem Odd">
                <div class="label">Village Common Land Conversion to PG</div>
                <div class="cotent"> <?php echo ucwords(str_replace('_',' ',$survey->village_common_land));?></div>
            </div>
            <div class="rowElem Odd">
                <h3 style="background: white; color: #2B6893;">Alternate Land Offered</h3>
                <div class="rowElem">
                    <div class="label">Khasra No</div>
                    <div class="cotent"> <?php echo $survey->alt_khasra_no;?></div>
                    <div class="label">Area (K-M-Sqft)</div>
                    <div class="cotent"> <?php printf("%02d", $survey->alt_kanal);
                        echo '-';
                        printf("%02d", $survey->alt_marla);
                        echo '-';
                        printf("%03d", $survey->alt_sqft); ?></div>
                </div>
                <div class="rowElem">
                    <div class="label">Schedule Rate /Marla</div>
                    <div class="cotent"> <?php echo $survey->alt_schedule_rate;?></div>
                    <div class="label">Market Price/Marla</div>
                    <div class="cotent"> <?php echo $survey->alt_market_price?></div>
                    <div class="label">DPAC Price/Marla</div>
                    <div class="cotent"> <?php echo $survey->alt_dpac_price?></div>
                </div>
                <div class="rowElem">
                    <div class="label">Notes</div>
                    <div class="cotent"> <?php echo $survey->notes;?></div>
                </div>
                <div class="rowElem">
                    <div class="label">Status of Exchange Approval</div>
                    <div class="cotent"> <?php echo ucwords(str_replace('_', ' ', $survey->exchange_approval));?></div>
                </div>
            </div>

            <div class="fix"></div>

           <!--  <div class="widget">
                <div class="head " style="background: white;">
                    <h5 style="background: white;">PROPERTY profile</h5>
                    <div id="profile_options">
                        <?php if ($survey->copy_of_plan != '') { ?>
                            <a rel="prettyPhoto"
                               href="<?php echo base_url().'uploads/'.$survey->copy_of_plan; ?>">
                                Copy of plan </a>
                        <?php } ?>
                        <?php if ($survey->copy_of_mutation != "") { ?>
                            <a rel="prettyPhoto"
                               href="<?php echo base_url().'uploads/'.$survey->copy_of_mutation; ?>">
                                Copy of Mutation</a>
                        <?php } ?>

                        <?php if ($survey->fard_file != '') { ?>
                            <a rel="prettyPhoto"
                               href="<?php echo base_url().'uploads/'.$survey->fard_file; ?>">
                                Fard File </a>
                        <?php } ?>
                        <?php if ($survey->alt_site_plan != '') { ?>
                            <a rel="prettyPhoto"
                               href="<?php echo base_url().'uploads/'.$survey->alt_site_plan; ?>">
                                Site plan </a>
                        <?php } ?>
                        <?php if ($survey->alt_fard != '') { ?>
                            <a rel="prettyPhoto"
                               href="<?php echo base_url().'uploads/'.$survey->alt_fard; ?>">
                                Alternative Fard file </a>
                        <?php } ?>
                        <?php if ($survey->ref_to_bor != '') { ?>
                            <a rel="prettyPhoto"
                               href="<?php echo base_url().'uploads/'.$survey->ref_to_bor; ?>">
                                Reference to BOR </a>
                        <?php } ?>
                    </div>
                </div>
            </div> -->
            <div class="fix"></div>
        </div>
    </div>


</fieldset>




