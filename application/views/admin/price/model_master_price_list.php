
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
      <div class="col-md-4 row">
	  <h1>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $heading;?></h1>
	  
	   </div>
	   <div class="col-md-6">
	   <h5 style="color:green;" id="message"><?php echo $this->session->flashdata('message'); ?></h5>
	   </div>
	  </div>
      
    </section>

    <!-- Main content -->
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
			   <a class="btn btn" style="background-color:#fd7e14; color:white;" href="<?php echo site_url('admin/add_price'); ?>" ><i class="fa fa-pencil-o"></i>Add  Price</a><br/><br/>
			    <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No.</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody class="row_position">
				  <?php 
				  if(!empty($model_prices)){
				  
				        $status='';
					    $color='';
					    $i=0; $url=''; foreach($model_prices as $value) {
						
                        $i++;
						if($value['status']==1){
						$status='Active';
						$css='success';
						}
						else
						{
						$status='Inactive';
						$css='warning';
						}
						
					
				  
				  ?>
                  <tr id="<?php echo $value['id']; ?>">
				  
				  
                    <td><?php echo $i;?></td>
					<td><?php echo $value['price'];?></td>
					<td> 
					<div class="btn-group" style="float:righttt;">

						



						
						<a title="Delete SEO" class="btn btn-danger" onclick="return areyousure();" href="<?php echo base_url();?>admin/delete_price/<?php echo $value['id']; ?>"><i class="fa fa-trash"></i></a>
						
					
						<a title="Edit SEO" class="btn btn-primary" href="<?php echo base_url();?>admin/edit_price/<?php echo $value['id']; ?>"><i class="fas fa-edit"></i></a>
						
						
						<a class="btn btn-<?php echo $css;?>" href="<?php echo base_url();?>admin/status_price/<?php echo $value['id'].'/'.$value['status']; ?>" ><?php echo $status ?></a>
						
						
						</div>
					</td> 
                  </tr>
				  <?php } } else { ?>
				  <tr>
				  <td><span class="badge <?php echo $color;?>"><?php echo $status;?></span></td>
				  </tr>
				  <?php } ?>
                  
                  
                  </tbody>
             
                </table>
				
				
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
  <script>
    function areyousure(){
		return confirm('Are you sure you want to delete?');
   }
  </script>
  <script type="text/javascript">
    $( ".row_position" ).sortable({
        delay: 150,
        stop: function() {
            var selectedData = new Array();
            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });
            updateOrder(selectedData);
        }
    });


    function updateOrder(data) {
        $.ajax({
            url:"<?php echo base_url();?>Ajax/reorder_price_list",
            type:'post',
            data:{position:data},
            success:function(response){
				console.log(response);
				$('#message').empty();
				$('#message').html('Model price order changed successfully');
                //alert('your change successfully saved');
            }
        })
    }
</script>