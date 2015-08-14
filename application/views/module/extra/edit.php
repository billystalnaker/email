<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Extra</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php
if (!empty($message))
{
    ?>
    <div id="message">
        <?php echo $message; ?>
    </div>
<?php } ?>

<?php echo validation_errors("<div class='row'> <div class='alert alert-danger col-md-6'>", "</div><div class='col-md-6'></div></div>"); ?>

<form action="<?php echo site_url('/module/extras/edit/' . $user[$this->flexi_auth->db_column('user_acc', 'id')]); ?>" method="POST" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-md-3">Email:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_email', $user['uacc_email']) ?>" name="update_user_email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">User Name:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-user fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_user_name', $user['uacc_username']) ?>" disabled name="update_user_user_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">First Name:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-user fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_first_name', $user['upro_first_name']) ?>" name="update_user_first_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Last Name:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-user fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_last_name', $user['upro_last_name']) ?>" name="update_user_last_name">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">City:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_city', $user['upro_city']) ?>" name="update_user_city">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">State:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-map-marker fa"></i></span>

                        <select name="update_user_state_id" class="form-control">
                            <?php foreach ($states as $state_id => $state)
                            {
                                ?>
                                <option value="<?php echo $state_id?>" <?php echo set_value('update_user_state_id', $user['upro_state_id']) == $state_id ? 'SELECTED' : ''?>><?php echo $state?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Head Shot:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-image fa"></i></span>
                        <input class="form-control" type="file" value="<?php echo set_value('headshot_image') ?>" name="headshot_image">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Current Head Shot:</label>

                    <div class="col-md-9">
                        <img src="<?php echo site_url('/images/' . $user['upro_headshot_image_id']) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Body Shot:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-image fa"></i></span>
                        <input class="form-control" type="file" value="<?php echo set_value('body_image') ?>" name="body_image">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Current Body Shot</label>

                    <div class="col-md-9">
                        <img src="<?php echo site_url('/images/' . $user['upro_body_image_id']) ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Address Line 1:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_address_line1', $user['upro_address_line1']) ?>" name="update_user_address_line1">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Address Line 2:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_address_line2', $user['upro_address_line2']) ?>" name="update_user_address_line2">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Race:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-user fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_race', $user['upro_race']) ?>" name="update_user_race">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Height:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-long-arrow-up fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_height', $user['upro_height']) ?>" name="update_user_height">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Weight:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-heart fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_weight', $user['upro_weight']) ?>" name="update_user_weight">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Shoe Size:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-cogs fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_shoe_size', $user['upro_shoe_size']) ?>" name="update_user_shoe_size">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-3">Shirt Size:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-cogs fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_shirt_size', $user['upro_shirt_size']) ?>" name="update_user_shirt_size">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-3">Jacket Size:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-cogs fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_jacket_size', $user['upro_jacket_size']) ?>" name="update_user_jacket_size">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-3">Pant Size:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-cogs fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_user_pant_size', $user['upro_pant_size']) ?>" name="update_user_pant_size">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Pet:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-cogs fa"></i></span>
                        <?php
                        echo form_dropdown('update_user_pet', array('None' => 'None', 'Dog' => 'Dog', 'Cat' => 'Cat', 'Other' => 'Other'), set_value('update_user_pet', $user['upro_pet']), "class='form-control'");
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control btn btn-primary" type="submit" id="" name="update_user_submit">
                </div>

            </div>
        </div>
    </div>
</form>