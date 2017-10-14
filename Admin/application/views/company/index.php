<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Companies Listing</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Company Id</th>
						<th>Status</th>
						<th>Password</th>
						<th>Rating</th>
						<th>Type</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Enrolled</th>
						<th>Timestamp</th>
						<th>Logo</th>
						<th>About</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($companies as $c){ ?>
                    <tr>
						<td><?php echo $c['company_id']; ?></td>
						<td><?php echo $c['status']; ?></td>
						<td><?php echo $c['password']; ?></td>
						<td><?php echo $c['rating']; ?></td>
						<td><?php echo $c['type']; ?></td>
						<td><?php echo $c['name']; ?></td>
						<td><?php echo $c['email']; ?></td>
						<td><?php echo $c['phone']; ?></td>
						<td><?php echo $c['enrolled']; ?></td>
						<td><?php echo $c['timestamp']; ?></td>
						<td><?php echo $c['logo']; ?></td>
						<td><?php echo $c['about']; ?></td>
						<td>
                            <a href="<?php echo site_url('company/edit/'.$c['company_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('company/remove/'.$c['company_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
