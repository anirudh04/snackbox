<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User Registrationnotification Listing</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Ur Id</th>
						<th>User Id</th>
						<th>User Reg Notification</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($user_registrationnotification as $u){ ?>
                    <tr>
						<td><?php echo $u['ur_id']; ?></td>
						<td><?php echo $u['user_id']; ?></td>
						<td><?php echo $u['user_reg_notification']; ?></td>
						<td>
                            <a href="<?php echo site_url('user_registrationnotification/edit/'.$u['ur_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('user_registrationnotification/remove/'.$u['ur_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
