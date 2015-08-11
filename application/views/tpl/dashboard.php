<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php
if ($is_logged)
{
    if ($this->flexi_auth->is_privileged('Users'))
    {
        ?>
        <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Users
                </div>
                <div class="panel-body">
                    <div class="panel-group" id="user_accordion"><?php
                        if ($this->flexi_auth->is_privileged('View Users'))
                        {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#user_accordion" href="#view_user_panel">View</a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse in" id="view_user_panel">
                                    <div class="panel-body">
                                        <h3>View Users</h3>

                                        <p>Here you can view users.</p>
                                        <a href="<?php echo site_url('module/users/view'); ?>">View Users</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        if ($this->flexi_auth->is_privileged('Add Users'))
                        {
                            ?>
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#user_accordion" href="#add_user_panel">Add</a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="add_user_panel">
                                    <div class="panel-body">
                                        <h3>Add Users</h3>

                                        <p>Here you can add users.</p>
                                        <a href="<?php echo site_url('module/users/add'); ?>">Add Users</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div><?php
    }
    if ($this->flexi_auth->is_privileged('Groups'))
    {
        ?>
        <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Groups
                </div>
                <div class="panel-body">
                    <div class="panel-group" id="group_accordion"><?php
                        if ($this->flexi_auth->is_privileged('View Groups'))
                        {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#group_accordion" href="#view_group_panel">View</a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse in" id="view_group_panel">
                                    <div class="panel-body">
                                        <h3>View Groups</h3>

                                        <p>Here you can view groups.</p>
                                        <a href="<?php echo site_url('module/groups/view'); ?>">View groups</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        if ($this->flexi_auth->is_privileged('Add Groups'))
                        {
                            ?>
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#group_accordion" href="#add_group_panel">Add</a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="add_group_panel">
                                    <div class="panel-body">
                                        <h3>Add Groups</h3>

                                        <p>Here you can add groups.</p>
                                        <a href="<?php echo site_url('module/groups/add'); ?>">Add groups</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div><?php
    }
    if ($this->flexi_auth->is_privileged('Privileges'))
    {
        ?>
        <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Privileges
                </div>
                <div class="panel-body">
                    <div class="panel-group" id="privileges_accordion"><?php
                        if ($this->flexi_auth->is_privileged('View Privileges'))
                        {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#privileges_accordion" href="#view_privileges_panel">View</a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse in" id="view_privileges_panel">
                                    <div class="panel-body">
                                        <h3>View Privileges</h3>

                                        <p>Here you can view privileges.</p>
                                        <a href="<?php echo site_url('module/privileges/view'); ?>">View Privileges</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        if ($this->flexi_auth->is_privileged('Add Privileges'))
                        {
                            ?>
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#privileges_accordion" href="#add_privileges_panel">Add</a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="add_privileges_panel">
                                    <div class="panel-body">
                                        <h3>Add Privileges</h3>

                                        <p>Here you can add privileges.</p>
                                        <a href="<?php echo site_url('module/privileges/add'); ?>">Add Privileges</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div><?php
    }
    if ($this->flexi_auth->is_privileged('Manifests'))
    {
        ?>
        <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manifests
                </div>
                <div class="panel-body">
                    <div class="panel-group" id="manifest_accordion"><?php
                        if ($this->flexi_auth->is_privileged('View Manifests'))
                        {
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#manifest_accordion" href="#view_manifest_panel">View</a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse in" id="view_manifest_panel">
                                    <div class="panel-body">
                                        <h3>View Manifests</h3>

                                        <p>Here you can view manifests.</p>
                                        <a href="<?php echo site_url('module/manifests/view'); ?>">View Manifests</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        if ($this->flexi_auth->is_privileged('Add Manifests'))
                        {
                            ?>
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#manifest_accordion" href="#add_manifest_panel">Add</a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="add_manifest_panel">
                                    <div class="panel-body">
                                        <h3>Add Manifests</h3>

                                        <p>Here you can add manifests.</p>
                                        <a href="<?php echo site_url('module/manifests/add'); ?>">Add Manifests</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div><?php
    }
}