<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Manifest Users</h1>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                Update Users for Manifest '<?php echo $manifest['title']; ?>'
            </div>
            <form action="<?php echo current_url(); ?>" method="POST">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="data_table">
                            <thead>
                            <tr>
                                <th class="tooltip_trigger"
                                    title="The name of the user."/>
                                User Name
                                </th>
                                <th class="tooltip_trigger"
                                    title="The email address on record for this user."/>
                                User Email
                                </th>
                                <th class="tooltip_trigger"
                                    title="The user has already confirmed receiving this manifest."/>
                                Confirmed
                                </th>
                                <th class="spacer_150 align_ctr tooltip_trigger"
                                    title="If checked, the user will be added to the manifest."/>
                                Manifest Contains User
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($extras as $extra)
                            {
                                $manifest_user_id = array_search($extra['uacc_id'], $manifest_users);
                                $confirmed = NULL;
                                if ($manifest_user_id)
                                {
                                    $manifests_user = $manifest_users_raw[$manifest_user_id];
                                    $confirmed = $manifests_user['confirmed'];
                                }
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="update[<?php echo $extra['uacc_id']; ?>][id]" value="<?php echo $extra['uacc_id']; ?>"/>
                                        <?php echo $extra['upro_first_name'] . ' ' . $extra['upro_last_name']; ?>
                                    </td>
                                    <td><?php echo $extra['uacc_email']; ?></td>

                                    <td><?php
                                        if (is_null($confirmed))
                                        {
                                            echo '--';
                                        }
                                        elseif ($confirmed)
                                        {
                                            echo '<i class="fa fa-thumbs-up"></i>';
                                        }
                                        else
                                        {
                                            echo '<i class="fa fa-thumbs-down"></i>';
                                        }
                                        ?></td>
                                    <td class="align_ctr">
                                        <?php
                                        // Define form input values.
                                        $current_status = (in_array($extra['uacc_id'], $manifest_users)) ? 1 : 0;
                                        $new_status = (in_array($extra['uacc_id'], $manifest_users)) ? 'checked="checked"' : NULL;
                                        ?>
                                        <input type="hidden" name="update[<?php echo $extra['uacc_id']; ?>][current_status]" value="<?php echo $current_status ?>"/>
                                        <input type="hidden" name="update[<?php echo $extra['uacc_id']; ?>][new_status]" value="0"/>
                                        <input type="checkbox" name="update[<?php echo $extra['uacc_id']; ?>][new_status]" value="1" <?php echo $new_status ?>/>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3">
                                    <input type="submit" name="update_manifest_user" value="Update Manifest Users" class="link_button large"/>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>