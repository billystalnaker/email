<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Users</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php if (!empty($message))
{ ?>
    <div id="message">
        <?php echo $message; ?>
    </div>
<?php } ?>

<div class="row">
    <div class="col-lg-12">
        <?php if ($this->flexi_auth->is_privileged('Add Users'))
        { ?>
            <a href="<?php echo site_url('module/users/add') ?>">Add a user...</a>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Users
            </div>
            <!-- /.panel-heading -->
            <form action="<?php echo current_url(); ?>" method="POST">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="data_table">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Head Shot</th>
                                <th>Body Shot</th>
                                <th>Address Line 1</th>
                                <th>Address Line 2</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Race</th>
                                <th>Height</th>
                                <th>Weight</th>
                                <th>Shoe Size</th>
                                <th>Shirt Size</th>
                                <th>Jacket Size</th>
                                <th>Pant Size</th>
                                <th>Pet</th>
                                <th>Group</th>
                                <th>Privileges</th>
                                <th>Reset Password</th>
                                <th>Add to Manifest</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <?php if (!empty($users))
                            { ?>
                                <tbody>
                                <?php foreach ($users as $user)
                                { ?>
                                    <tr>
                                        <td>
                                            <?php if ($this->flexi_auth->is_privileged('Edit Users'))
                                            {
                                                $edit_url = site_url("module/users/edit/" . $user[$this->flexi_auth->db_column('user_acc', 'id')]);
                                                if ($user['ugrp_id'] == 2)
                                                {
                                                    $edit_url = site_url("module/extras/edit/" . $user[$this->flexi_auth->db_column('user_acc', 'id')]);
                                                } ?>
                                                <a href="<?php echo $edit_url; ?>">
                                                    <?php echo $user[$this->flexi_auth->db_column('user_acc', 'username')]; ?>
                                                </a>
                                            <?php }
                                            else
                                            { ?>
                                                <?php echo $user[$this->flexi_auth->db_column('user_acc', 'username')]; ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo $user[$this->flexi_auth->db_column('user_acc', 'email')]; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['upro_first_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['upro_last_name']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $head_url = base_url('/public/img/shadow-profile.png');
                                            $head_class = 'prevent';
                                            if ($user['upro_headshot_image_id'] > 0)
                                            {
                                                $head_url = site_url('/images/' . $user['upro_headshot_image_id']);
                                                $head_class = 'view-image';
                                            }

                                            ?>
                                            <a href="<?php echo $head_url;?>" class="<?php echo $head_class?>">
                                                <img src="<?php echo $head_url;?>" width="50px"/>
                                            </a>
                                        </td>
                                        <td>
                                            <?php
                                            $body_url = base_url('/public/img/shadow-profile.png');
                                            $body_class = 'prevent';
                                            if ($user['upro_body_image_id'] > 0)
                                            {
                                                $body_url = site_url('/images/' . $user['upro_body_image_id']);
                                                $body_class = 'view-image';
                                            }

                                            ?>
                                            <a href="<?php echo $body_url?>" class="<?php echo $body_class?>">
                                                <img src="<?php echo $body_url;?>" width="50px"/>
                                            </a>
                                        </td>

                                        <td>
                                            <?php echo $user['upro_address_line1']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['upro_address_line2']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['upro_city']; ?>
                                        </td>
                                        <td>
                                            <?php echo isset($states[$user['upro_state_id']]) ? $states[$user['upro_state_id']] : 'No State'; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['upro_race']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['upro_height']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['upro_weight']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['upro_shoe_size']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['upro_shirt_size']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['upro_jacket_size']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['upro_pant_size']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['upro_pet']; ?>
                                        </td>
                                        <td class="align_ctr">
                                            <?php echo $user[$this->flexi_auth->db_column('user_group', 'name')]; ?>
                                        </td>
                                        <td class="align_ctr">
                                            <?php if ($this->flexi_auth->is_privileged('User Privileges'))
                                            { ?>
                                                <a href="<?php echo site_url("module/user_privileges/" . $user[$this->flexi_auth->db_column('user_acc', 'id')]); ?>">Manage</a>
                                            <?php }
                                            else
                                            { ?>
                                                <small>Not Privileged</small>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <span data-identifier="<?php echo $user[$this->flexi_auth->db_column('user_acc', 'username')]; ?>" class="btn btn-link reset-password">Reset Password</span>
                                        </td>

                                        <td class="align_ctr">
                                            <?php
                                            if ($this->flexi_auth->is_privileged('Manifest Users') && $user['ugrp_id'] == 2)
                                            { ?>
                                                <input class="update-manifest-user" type="checkbox" name="update_manifest_user[]" value="<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')]; ?>"/>
                                            <?php }
                                            else
                                            { ?>
                                                <input type="checkbox" disabled="disabled"/>
                                                <small>Not Privileged</small>
                                            <?php } ?>
                                        </td>
                                        <td class="align_ctr">
                                            <?php if ($this->flexi_auth->is_privileged('Delete Users'))
                                            { ?>
                                                <input type="checkbox" name="delete_user[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')]; ?>]" value="1"/>
                                            <?php }
                                            else
                                            { ?>
                                                <input type="checkbox" disabled="disabled"/>
                                                <small>Not Privileged</small>
                                                <input type="hidden" name="delete_user[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')]; ?>]" value="0"/>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Update Users" name="update_users"/>
                    <a class="add-selected-users-to-manifest btn btn-primary">Add Selected Users to a Manifest</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var update_manifest_users = [];
    var update_user_url = '<?php echo site_url('/api/add_manifest_users')?>';
    $(document).ready(function () {
        $('.prevent').click(function (e) {
            e.preventDefault();
        });
        $('.view-image').magnificPopup({
            type: 'image',
            image: {
                verticalFit: false
            }
        });
    });
    $('.add-selected-users-to-manifest').click(function () {
        update_manifest_users = [];
        $(".update-manifest-user:checked").each(function () {
            update_manifest_users.push($(this).val());
        });
        if (update_manifest_users.length > 0) {
            bootbox.dialog({
                    title: "Please Choose a Manifest.",
                    message: '<div class="row">  ' +
                    '<div class="col-md-6"> ' +
                    '<form>' +
                    '<div class="form-group">' +
                    '<label for="admin_manifest_id" class="control-label">Choose a Manifest</label>' +
                    '<select id="admin_manifest_id" class="form-control">' +
                    <?php foreach($manifests as $manifest){
                            echo "'<option value=\"".$manifest['id']."\">".$manifest['title']."</option>'+";
                    }?>
                    '</select>' +
                    '</div>' +
                    '</form> </div>  </div>',
                    buttons: {
                        success: {
                            label: "Save",
                            className: "btn-success",
                            callback: function () {
                                var manifest_id = $('#admin_manifest_id').val();
                                var data = {};
                                data['user_ids'] = update_manifest_users;
                                data['manifest_id'] = manifest_id;
                                $.post(update_user_url, data, function (data) {
                                    redirect(data);
                                });
                            }
                        }
                    }
                }
            );
        } else {
            bootbox.alert('<h2>Error!</h2><p>You must select at least one user to add to a manifest...</p>');
        }
    });
</script>