<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">States</h1>
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
        <?php if ($this->flexi_auth->is_privileged('Add States'))
        { ?>
            <a href="<?php echo site_url('module/states/add') ?>">Add a state...</a>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                States
            </div>
            <!-- /.panel-heading -->
            <form action="<?php echo current_url(); ?>" method="POST">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="data_table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Abbreviation</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <?php if (!empty($states))
                            { ?>
                                <tbody>
                                <?php foreach ($states as $state)
                                { ?>
                                    <tr>
                                        <td>
                                            <?php if ($this->flexi_auth->is_privileged('Edit States'))
                                            { ?>
                                                <a href="<?php echo site_url("module/states/edit/" . $state['id']); ?>">
                                                    <?php echo $state['name']; ?>
                                                </a>
                                            <?php }
                                            else
                                            { ?>
                                                <?php echo $state['name']; ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php echo $state['abbreviation']; ?>
                                        </td>
                                        <td class="align_ctr">
                                            <?php if ($this->flexi_auth->is_privileged('Delete States'))
                                            { ?>
                                                <input type="checkbox" name="delete_state[<?php echo $state['id']; ?>]" value="1"/>
                                            <?php }
                                            else
                                            { ?>
                                                <input type="checkbox" disabled="disabled"/>
                                                <small>Not Privileged</small>
                                                <input type="hidden" name="delete_state[<?php echo $state['id']; ?>]" value="0"/>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Update States" name="update_states"/>
                </div>
            </form>
        </div>
    </div>
</div>