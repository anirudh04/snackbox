<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">My Plans Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('my_plan/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Plan Reg Id</th>
						<th>Plan Id</th>
						<th>User Id</th>
						<th>Status</th>
						<th>Timestamp</th>
						<th>Amount</th>
						<th>Company Id</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($my_plans as $m){ ?>
                    <tr>
						<td><?php echo $m['plan_reg_id']; ?></td>
						<td><?php echo $m['plan_id']; ?></td>
						<td><?php echo $m['user_id']; ?></td>
						<td><?php echo $m['status']; ?></td>
						<td><?php echo $m['timestamp']; ?></td>
						<td><?php echo $m['amount']; ?></td>
						<td><?php echo $m['company_id']; ?></td>
						<td>
                            <a href="<?php echo site_url('my_plan/edit/'.$m['plan_reg_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('my_plan/remove/'.$m['plan_reg_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
