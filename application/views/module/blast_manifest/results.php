<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Results</h1>
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
                Results
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Email</th>
                            <th>Success/Fail</th>
                        </tr>
                        </thead>
                        <?php if (!empty($results))
                        { ?>
                            <tbody>
                            <?php foreach ($results as $type => $result)
                        {
                            foreach ($result as $email => $message)
                            {
                                { ?>
                                    <tr>
                                        <td>
                                            <?php echo $email; ?>
                                        </td>
                                        <td>
                                            <?php if ($type == 'success')
                                            {
                                                ?>
                                                <span class="badge label-success"><i class="fa fa-thumbs-o-up"></i></span><?php
                                            }
                                            else
                                            {
                                                ?>
                                                <span class="badge badge-danger">
                                                <i class="fa fa-thumbs-o-down"></i> <?php echo $message?></span><?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            <?php }
                        }
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>