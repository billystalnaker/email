<?php if (!empty($message))
{ ?>
    <div id="message">
        <?php echo $message; ?>
    </div>
<?php }
if (!empty($errors))
{
    ?>
    <div class="error-messages row"><?php
    foreach ($errors as $error)
    {
        ?>
        <div class="alert alert-danger"><?php echo $error?></div><?php
    }?></div><?php

}
$attributes = array(
    'method'  => 'POST',
    'role'    => 'form',
    'class'   => 'form-center',
    'enctype' => 'multipart/form-data'

);
echo form_open(current_url(), $attributes);
?>
    <h3 class="form-register-heading">Please Register or <a href="<?php echo site_url('account/login'); ?>">Sign In</a>
    </h3>
    <input name="login_email" type="text" class="form-control" placeholder="Email Address" autofocus="" value="<?php echo set_value('login_email'); ?>">
    <input name="login_identity" type="text" class="form-control" placeholder="Username" autofocus="" value="<?php echo set_value('login_identity'); ?>">
    <input name="login_password" type="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>">
    <input name="login_password_confirm" type="password" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('confirm_password'); ?>">
    <input name="upro_first_name" type="text" class="form-control" placeholder="First Name" value="<?php echo set_value('upro_first_name'); ?>">
    <input name="upro_last_name" type="text" class="form-control" placeholder="Last Name" value="<?php echo set_value('upro_last_name'); ?>">
    <input name="upro_address_line1" type="text" class="form-control" placeholder="Address Line 1" value="<?php echo set_value('upro_address_line1'); ?>">
    <input name="upro_address_line2" type="text" class="form-control" placeholder="Address Line 2" value="<?php echo set_value('upro_address_line2'); ?>">
    <input name="upro_city" type="text" class="form-control" placeholder="City" value="<?php echo set_value('upro_city'); ?>">
    <select name="upro_state_id" class="form-control">
        <?php foreach ($states as $state_id => $state)
        {
            ?>
            <option value="<?php echo $state_id?>" <?php echo set_value('upro_state_id') == $state_id ? 'SELECTED' : ''?>><?php echo $state?></option>
        <?php
        } ?>
    </select>
    <input name="upro_race" type="text" class="form-control" placeholder="Race" value="<?php echo set_value('upro_race'); ?>">
    <input name="upro_height" type="text" class="form-control" placeholder="Height" value="<?php echo set_value('upro_height'); ?>">
    <input name="upro_weight" type="text" class="form-control" placeholder="Weight" value="<?php echo set_value('upro_weight'); ?>">
    <input name="upro_shoe_size" type="text" class="form-control" placeholder="Shoe Size" value="<?php echo set_value('upro_shoe_size'); ?>">
    <input name="upro_shirt_size" type="text" class="form-control" placeholder="Shirt Size" value="<?php echo set_value('upro_shirt_size'); ?>">
    <input name="upro_jacket_size" type="text" class="form-control" placeholder="Jacket Size" value="<?php echo set_value('upro_jacket_size'); ?>">
    <input name="upro_pant_size" type="text" class="form-control" placeholder="Pant Size" value="<?php echo set_value('upro_pant_size'); ?>">
    <select name="upro_pet" class="form-control">
        <?php foreach (array('None', 'Dog', 'Cat', 'Other') as $pet)
        {
            ?>
            <option value="<?php echo $pet?>" <?php echo set_value('upro_pet') == $pet ? 'SELECTED' : ''?>><?php echo $pet?></option>
        <?php
        } ?>
    </select>
    <label>Headshot Image</label><input type="file" name="headshot_image"/>
    <label>Body Image</label> <input type="file" name="body_image"/>
    <input type="submit" name="register_user" class="btn btn-lg btn-primary btn-block" value="Register"/>
<?php
echo form_close();
?>