<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User Companies Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('user_company/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>User Companies Id</th>
						<th>Company Id</th>
						<th>User Id</th>
						<th>Timestamp</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($user_companies as $u){ ?>
                    <tr>
						<td><?php echo $u['user_companies_id']; ?></td>
						<td><?php echo $u['company_id']; ?></td>
						<td><?php echo $u['user_id']; ?></td>
						<td><?php echo $u['timestamp']; ?></td>
						<td>
                            <a href="<?php echo site_url('user_company/edit/'.$u['user_companies_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('user_company/remove/'.$u['user_companies_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
