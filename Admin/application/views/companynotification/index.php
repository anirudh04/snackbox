<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Companynotifications Listing</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Cn Id</th>
						<th>Company Id</th>
						<th>Cn Notification</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($companynotifications as $c){ ?>
                    <tr>
						<td><?php echo $c['cn_id']; ?></td>
						<td><?php echo $c['company_id']; ?></td>
						<td><?php echo $c['cn_notification']; ?></td>
						<td>
                            <a href="<?php echo site_url('companynotification/edit/'.$c['cn_id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('companynotification/remove/'.$c['cn_id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
