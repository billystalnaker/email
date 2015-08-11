<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Manifests</h1>
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

<form action="<?php echo site_url('/module/manifests/edit/' . $manifest['id']); ?>" method="POST">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-md-3">Title:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa fa-edit"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_manifest_title', $manifest['title']) ?>" name="update_manifest_title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Date of Show:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-calendar fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_manifest_date_of_show', $manifest['date_of_show']) ?>" name="update_manifest_date_of_show">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Content:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-envelope-o fa"></i></span>
                        <textarea class="form-control" name="update_manifest_content"><?php echo set_value('update_manifest_content', $manifest['content']) ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Date of Last Blast:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-calendar fa"></i></span>
                        <input disabled class="form-control" type="text" value="<?php echo $manifest['date_of_last_blast'] ?>" name="update_manifest_date_of_last_blast">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Content of Last Blast:</label>

                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-envelope-o fa"></i></span>
                        <textarea class="form-control" disabled><?php echo $manifest['content_of_last_blast'] ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control btn btn-primary" type="submit" id="" name="update_group_submit">
                </div>

            </div>
        </div>
</form>