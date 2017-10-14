<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Bank Details Listing</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Bank Id</th>
						<th>User Id</th>
						<th>Holder Name</th>
						<th>Bank Name</th>
						<th>Ifsc</th>
						<th>Account Number</th>
						<th>Pan Number</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($bank_details as $b){ ?>
                    <tr>
						<td><?php echo $b['bank_id']; ?></td>
						<td><?php echo $b['user_id']; ?></td>
						<td><?php echo $b['holder_name']; ?></td>
						<td><?php echo $b['bank_name']; ?></td>
						<td><?php echo $b['ifsc']; ?></td>
						<td><?php echo $b['account_number']; ?></td>
						<td><?php echo $b['pan_number']; ?></td>
						<td>
                            <a href="<?php echo site_url('bank_detail/edit/'.$b['bank_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('bank_detail/remove/'.$b['bank_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
