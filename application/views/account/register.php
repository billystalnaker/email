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
    <input name="upro_city" type="text" class="form-control" placeholder="City" value="<?php echo set_value('upro_city'); ?>">
    <input name="upro_state" type="text" class="form-control" placeholder="State" value="<?php echo set_value('upro_state'); ?>">
    <label>Headshot Image</label><input type="file" name="headshot_image"/>
    <label>Body Image</label> <input type="file" name="body_image"/>
    <input type="submit" name="register_user" class="btn btn-lg btn-primary btn-block" value="Register"/>
<?php
echo form_close();
?>