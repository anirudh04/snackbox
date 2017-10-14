<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">User Edit</h3>
            </div>
			<?php echo form_open('user/edit/'.$user['user_id']); ?>
			<div class="box-body">
				<div class="row clearfix">
					<div class="col-md-6">
						<label for="user_name" class="control-label">User Name</label>
						<div class="form-group">
							<input type="text" name="user_name" value="<?php echo ($this->input->post('user_name') ? $this->input->post('user_name') : $user['user_name']); ?>" class="form-control" id="user_name" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="gender" class="control-label">Gender</label>
						<div class="form-group">
							<input type="text" name="gender" value="<?php echo ($this->input->post('gender') ? $this->input->post('gender') : $user['gender']); ?>" class="form-control" id="gender" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="email" class="control-label">Email</label>
						<div class="form-group">
							<input type="text" name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $user['email']); ?>" class="form-control" id="email" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="phone" class="control-label">Phone</label>
						<div class="form-group">
							<input type="text" name="phone" value="<?php echo ($this->input->post('phone') ? $this->input->post('phone') : $user['phone']); ?>" class="form-control" id="phone" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="address" class="control-label">Address</label>
						<div class="form-group">
							<input type="text" name="address" value="<?php echo ($this->input->post('address') ? $this->input->post('address') : $user['address']); ?>" class="form-control" id="address" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="degree" class="control-label">Degree</label>
						<div class="form-group">
							<input type="text" name="degree" value="<?php echo ($this->input->post('degree') ? $this->input->post('degree') : $user['degree']); ?>" class="form-control" id="degree" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="status" class="control-label">Status</label>
						<div class="form-group">
							<input type="text" name="status" value="<?php echo ($this->input->post('status') ? $this->input->post('status') : $user['status']); ?>" class="form-control" id="status" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="google_id" class="control-label">Google Id</label>
						<div class="form-group">
							<input type="text" name="google_id" value="<?php echo ($this->input->post('google_id') ? $this->input->post('google_id') : $user['google_id']); ?>" class="form-control" id="google_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="college" class="control-label">College</label>
						<div class="form-group">
							<textarea name="college" class="form-control" id="college"><?php echo ($this->input->post('college') ? $this->input->post('college') : $user['college']); ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<label for="cv" class="control-label">Cv</label>
						<div class="form-group">
							<textarea name="cv" class="form-control" id="cv"><?php echo ($this->input->post('cv') ? $this->input->post('cv') : $user['cv']); ?></textarea>
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