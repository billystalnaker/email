<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Extras</h1>
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

<form action="<?php echo current_url(); ?>" method="POST" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-md-3">Email:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_email') ?>" name="insert_user_email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">User Name:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-user fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_user_name') ?>" name="insert_user_user_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">First Name:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-user fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_first_name') ?>" name="insert_user_first_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Last Name:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-user fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_last_name') ?>" name="insert_user_last_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Password:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-key fa"></i></span>
                        <input class="form-control" type="password" value="<?php echo set_value('insert_user_password') ?>" name="insert_user_password">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Password Confirmation:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-lock fa"></i></span>
                        <input class="form-control" type="password" value="<?php echo set_value('insert_user_password_confirmation') ?>" name="insert_user_password_confirmation">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">City:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_city') ?>" name="insert_user_city">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">State:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_state') ?>" name="insert_user_state">
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
                    <label class="col-md-3">Body Shot:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-image fa"></i></span>
                        <input class="form-control" type="file" value="<?php echo set_value('body_image') ?>" name="body_image">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Address Line 1:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_address_line1') ?>" name="insert_user_address_line1">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Address Line 2:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_address_line2') ?>" name="insert_user_address_line2">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Race:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-user fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_race') ?>" name="insert_user_race">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Height:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-long-arrow-up fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_height') ?>" name="insert_user_height">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Weight:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-heart fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_weight') ?>" name="insert_user_weight">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Shoe Size:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-cogs fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_shoe_size') ?>" name="insert_user_shoe_size">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Shirt Size:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-cogs fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_shirt_size') ?>" name="insert_user_shirt_size">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3">Jacket Size:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-cogs fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_jacket_size') ?>" name="insert_user_jacket_size">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-3">Pant Size:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-cogs fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_user_pant_size') ?>" name="insert_user_pant_size">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-3">Pet:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-cogs fa"></i></span>
                        <?php
                        echo form_dropdown('insert_user_pet', array('None' => 'None', 'Dog' => 'Dog', 'Cat' => 'Cat', 'Other' => 'Other'), set_value('insert_user_pet'), "class='form-control'");
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control btn btn-primary" type="submit" id="" name="insert_user_submit">
                </div>

            </div>
        </div>
</form>