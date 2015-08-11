<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Manifests</h1>
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
        <?php if ($this->flexi_auth->is_privileged('Add Manifests'))
        { ?>
            <a href="<?php echo site_url('module/manifests/add') ?>">Add a manifest...</a>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Manifests
            </div>
            <!-- /.panel-heading -->
            <form action="<?php echo current_url(); ?>" method="POST">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="data_table">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Date of Show
                                <th>Users</th>
                                <th>Blast</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <?php if (!empty($manifests))
                            { ?>
                                <tbody>
                                <?php foreach ($manifests as $manifest)
                                { ?>
                                    <tr>
                                        <td>
                                            <?php if ($this->flexi_auth->is_privileged('Edit Manifests'))
                                            { ?>
                                                <a href="<?php echo site_url("module/manifests/edit/" . $manifest['id']); ?>">
                                                    <?php echo $manifest['title']; ?>
                                                </a>
                                            <?php }
                                            else
                                            { ?>
                                                <?php echo $manifest['title']; ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo $manifest['content']; ?>
                                        </td>
                                        <td>
                                            <?php echo $manifest['date_of_show']; ?>
                                        </td>
                                        <td class="align_ctr">
                                            <?php if ($this->flexi_auth->is_privileged('Manifest Users'))
                                            { ?>
                                                <a href="<?php echo site_url("module/manifest_users/" . $manifest['id']); ?>">Manage</a>
                                            <?php }
                                            else
                                            { ?>
                                                <small>Not Privileged</small>
                                            <?php } ?>
                                        </td>

                                        <td class="align_ctr">
                                            <?php if ($this->flexi_auth->is_privileged('Blast Manifest'))
                                            { ?>
                                                <a href="<?php echo site_url("module/blast_manifest/" . $manifest['id']); ?>"><i class="fa fa-forward"></i> Blast</a>
                                            <?php }
                                            else
                                            { ?>
                                                <small>Not Privileged</small>
                                            <?php } ?>
                                        </td>
                                        <td class="align_ctr">
                                            <?php if ($this->flexi_auth->is_privileged('Delete Manifests'))
                                            { ?>
                                                <input type="checkbox" name="delete_manifest[<?php echo $manifest['id']; ?>]" value="1"/>
                                            <?php }
                                            else
                                            { ?>
                                                <input type="checkbox" disabled="disabled"/>
                                                <small>Not Privileged</small>
                                                <input type="hidden" name="delete_manifest[<?php echo $manifest['id']; ?>]" value="0"/>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Update Manifests" name="update_manifests"/>
                </div>
            </form>
        </div>
    </div>
</div>