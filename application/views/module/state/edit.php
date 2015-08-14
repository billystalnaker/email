<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">States</h1>
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

<form action="<?php echo site_url('/module/states/edit/' . $state['id']); ?>" method="POST">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-md-3">Abbreviation:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa fa-font"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_state_abbreviation', $state['abbreviation']) ?>" name="update_state_abbreviation">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Name:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-ellipsis-h fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_state_name', $state['name']) ?>" name="update_state_name">
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control btn btn-primary" type="submit" id="" name="update_state_submit">
                </div>

            </div>
        </div>
</form>