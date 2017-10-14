<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Plans Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('plan/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Plan Id</th>
						<th>Company Id</th>
						<th>Price Of Product</th>
						<th>Difficulty</th>
						<th>Name</th>
						<th>Timestamp</th>
						<th>Expiry Date</th>
						<th>Conversion</th>
						<th>Earn Per Conversion</th>
						<th>Training Kit</th>
						<th>About</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($plans as $p){ ?>
                    <tr>
						<td><?php echo $p['plan_id']; ?></td>
						<td><?php echo $p['company_id']; ?></td>
						<td><?php echo $p['price_of_product']; ?></td>
						<td><?php echo $p['difficulty']; ?></td>
						<td><?php echo $p['name']; ?></td>
						<td><?php echo $p['timestamp']; ?></td>
						<td><?php echo $p['expiry_date']; ?></td>
						<td><?php echo $p['conversion']; ?></td>
						<td><?php echo $p['earn_per_conversion']; ?></td>
						<td><?php echo $p['training_kit']; ?></td>
						<td><?php echo $p['about']; ?></td>
						<td>
                            <a href="<?php echo site_url('plan/edit/'.$p['plan_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('plan/remove/'.$p['plan_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
