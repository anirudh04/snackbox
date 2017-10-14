<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Reviews Listing</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Review Id</th>
						<th>Plan Id</th>
						<th>User Id</th>
						<th>Timestamp</th>
						<th>Message</th>
						<th>Name</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($reviews as $r){ ?>
                    <tr>
						<td><?php echo $r['review_id']; ?></td>
						<td><?php echo $r['plan_id']; ?></td>
						<td><?php echo $r['user_id']; ?></td>
						<td><?php echo $r['timestamp']; ?></td>
						<td><?php echo $r['message']; ?></td>
						<td><?php echo $r['name']; ?></td>
						<td>
                            <a href="<?php echo site_url('review/edit/'.$r['review_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('review/remove/'.$r['review_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
