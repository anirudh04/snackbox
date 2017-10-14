<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">User Company Edit</h3>
            </div>
			<?php echo form_open('user_company/edit/'.$user_company['user_companies_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="company_id" class="control-label">Company Id</label>
						<div class="form-group">
							<input type="text" name="company_id" value="<?php echo ($this->input->post('company_id') ? $this->input->post('company_id') : $user_company['company_id']); ?>" class="form-control" id="company_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="user_id" class="control-label">User Id</label>
						<div class="form-group">
							<input type="text" name="user_id" value="<?php echo ($this->input->post('user_id') ? $this->input->post('user_id') : $user_company['user_id']); ?>" class="form-control" id="user_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="timestamp" class="control-label">Timestamp</label>
						<div class="form-group">
							<input type="text" name="timestamp" value="<?php echo ($this->input->post('timestamp') ? $this->input->post('timestamp') : $user_company['timestamp']); ?>" class="form-control" id="timestamp" />
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">
            	<button type="submit" class="btn btn-success">
					<i class="fa fa-check"></i> Save
				</button>
	        </div>				
			<?php echo form_close(); ?>
		</div>
    </div>
</div>