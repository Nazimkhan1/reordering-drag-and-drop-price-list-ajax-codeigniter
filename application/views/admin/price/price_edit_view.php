<style>
	.error{color:red;}
  </style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><?php echo $heading;?></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $heading;?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         
          <!-- /.col -->
          <div class="col-md-12">
            <div class="card">
             
              <div class="card-body">
                <div class="tab-content">
                  
				  
				  
				
                  <!-- /.tab-pane -->

                  <div class="active tab-pane" id="activity">
                     <form role="form"  method="POST" action="<?php echo base_url();?>admin/edit_price/<?php echo $priceRow->id;?>" enctype="multipart/form-data">
						<div class="card-body">
						    <div class="row">
							<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Page Title<span class="error">*</span></label>
							<input type="text" class="form-control" id="model_price" name="model_price" placeholder="Enter Price Name" value="<?php echo $priceRow->price;?>">
							<?php echo form_error('model_price','<span class="help-block" style="color:red;"">','</span>'); ?>
							<span style="color:red;"><?php echo $this->session->flashdata('error'); ?></span>
                            </div>
                            </div>
						</div>
						</div>
					<!-- /.card-body -->

						<div class="card-footer">
						<button type="submit" name="priceUp"  value="priceUp" class="btn btn-primary">Submit</button>
						<button class="btn btn-default"> <a href="<?php echo site_url('admin/model_prices/'); ?>" >Back</a></button>
						</div>
					</form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

 