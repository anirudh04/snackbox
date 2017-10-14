<div class="row">
    <div class="col-md-12">
      	<div class="box box-info">
            <div class="box-header with-border">
              	<h3 class="box-title">Plan Add</h3>
            </div>
            <?php echo form_open('plan/add'); ?>
          	<div class="box-body">
          		<div class="row clearfix">
					<div class="col-md-6">
						<label for="company_id" class="control-label">Company Id</label>
						<div class="form-group">
							<input type="text" name="company_id" value="<?php echo $this->input->post('company_id'); ?>" class="form-control" id="company_id" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="price_of_product" class="control-label">Price Of Product</label>
						<div class="form-group">
							<input type="text" name="price_of_product" value="<?php echo $this->input->post('price_of_product'); ?>" class="form-control" id="price_of_product" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="difficulty" class="control-label">Difficulty</label>
						<div class="form-group">
							<input type="text" name="difficulty" value="<?php echo $this->input->post('difficulty'); ?>" class="form-control" id="difficulty" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="name" class="control-label">Name</label>
						<div class="form-group">
							<input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="timestamp" class="control-label">Timestamp</label>
						<div class="form-group">
							<input type="text" name="timestamp" value="<?php echo $this->input->post('timestamp'); ?>" class="form-control" id="timestamp" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="expiry_date" class="control-label">Expiry Date</label>
						<div class="form-group">
							<input type="text" name="expiry_date" value="<?php echo $this->input->post('expiry_date'); ?>" class="has-datepicker form-control" id="expiry_date" />
						</div>
					</div>
					<div class="col-md-6">
						<label for="conversion" class="control-label">Conversion</label>
						<div class="form-group">
							<textarea name="conversion" class="form-control" id="conversion"><?php echo $this->input->post('conversion'); ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<label for="earn_per_conversion" class="control-label">Earn Per Conversion</label>
						<div class="form-group">
							<textarea name="earn_per_conversion" class="form-control" id="earn_per_conversion"><?php echo $this->input->post('earn_per_conversion'); ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<label for="training_kit" class="control-label">Training Kit</label>
						<div class="form-group">
							<textarea name="training_kit" class="form-control" id="training_kit"><?php echo $this->input->post('training_kit'); ?></textarea>
						</div>
					</div>
					<div class="col-md-6">
						<label for="about" class="control-label">About</label>
						<div class="form-group">
							<textarea name="about" class="form-control" id="about"><?php echo $this->input->post('about'); ?></textarea>
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