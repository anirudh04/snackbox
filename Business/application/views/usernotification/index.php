<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Usernotifications Listing</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Un Id</th>
						<th>Plan Reg Id</th>
						<th>User Id</th>
						<th>Company Id</th>
						<th>Un Notification</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($usernotifications as $u){ ?>
                    <tr>
						<td><?php echo $u['un_id']; ?></td>
						<td><?php echo $u['plan_reg_id']; ?></td>
						<td><?php echo $u['user_id']; ?></td>
						<td><?php echo $u['company_id']; ?></td>
						<td><?php echo $u['un_notification']; ?></td>
						<td>
                            <a href="<?php echo site_url('usernotification/edit/'.$u['un_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('usernotification/remove/'.$u['un_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
