<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('user/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>User Id</th>
						<th>User Name</th>
						<th>Gender</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Address</th>
						<th>Degree</th>
						<th>Status</th>
						<th>Google Id</th>
						<th>College</th>
						<th>Cv</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($user as $u){ ?>
                    <tr>
						<td><?php echo $u['user_id']; ?></td>
						<td><?php echo $u['user_name']; ?></td>
						<td><?php echo $u['gender']; ?></td>
						<td><?php echo $u['email']; ?></td>
						<td><?php echo $u['phone']; ?></td>
						<td><?php echo $u['address']; ?></td>
						<td><?php echo $u['degree']; ?></td>
						<td><?php echo $u['status']; ?></td>
						<td><?php echo $u['google_id']; ?></td>
						<td><?php echo $u['college']; ?></td>
						<td><?php echo $u['cv']; ?></td>
						<td>
                            <a href="<?php echo site_url('user/edit/'.$u['user_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('user/remove/'.$u['user_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
