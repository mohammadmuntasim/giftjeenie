        <style type="text/css">    
            .pg-normal {
                color: black;
                font-weight: normal;
                text-decoration: none;    
                cursor: pointer;    
            }
            .pg-selected {
                color: black;
                font-weight: bold;        
                text-decoration: underline;
                cursor: pointer;
            }
            .table img{
                border: 2px solid #ff2525;
                border-radius: 99px;
                max-height: 100px;
                padding: 2px;
                width: 100px;
            }
        </style>
<section>
<div class="container minus-margin">
  <div class="row">
    <div class="col-sm-12">
        <div class="col-sm-3">
          <?php $this->load->view('includes/left_menu'); ?>
        </div>
        
        <div class="col-sm-9">
          <div class="main-content">            
            <div class="col-sm-12">
              <div class='overlay'>
              </div>
                    <?php if($this->session->flashdata('success_msg')) 
                        {
                            echo "<div class='alert alert-success'>";
                            //echo '<a class="close" data-dismiss="alert">×</a>';
                            echo $this->session->flashdata('success_msg');
                            echo " </div>";
                        } 
                    ?>
              <div class="data-table-2 table-responsive">

                  <div class="panel panel-primary">
                      <div class="panel-heading">Brand Management</div>
                      <div class="panel-body">
                          <table class="dataTable table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>Brand</th>
                                      <th>Brand Image</th>
                                      <th>Total Items</th>
                                      <th>Edit</th>
                                      <th>Delete</th>
                                  </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table>
                      </div>
                  </div>

              </div>
             <div class="pull-right"><?php //echo $this->pagination->create_links(); ?></div> 
        </div>
      </div>        
    </div>
  </div>
</div>
</section>


<div class="modal fade" id="myModal" role="dialog" >
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      
      <div class="modal-body">
      
              <p>Brand deleted successfully.</p>
       
      </div>
      <div class="modal-footer">
       
        <div class="row">
        
          <button type="button" class="btn btn-default btn-block" data-dismiss="modal"  onclick="rload()" style="width: 100%;
background-color: transparent; border: medium; border-width: 0px 0px 0px 1px;">Ok</button>

        </div>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        var table = $('.dataTable').DataTable({

            "ajax": {
                url: "<?php echo base_url() ?>api/deals/brands",
                beforeSend: function(xhr){
                    xhr.setRequestHeader("Authorization", "Basic <?php echo $this->session->userdata('auth'); ?>");
                }
            },

            "processing": true,
            "serverSide": true,
            "columns": [
                {
                    "data": "brand_name",
                },
                {
                    "data": "brand_image",
                    "render": function (brand_image) {
                        if(brand_image.length) {
                            return '<img class="img-responsive" style="margin:auto;object-fit: contain;" src="'+brand_image+'" />';
                        } else {
                            return '<img  class="img-responsive" style="margin:auto;" src="<?php echo base_url()?>images/profile-image-border.png" />';
                        }
                    }
                },
                {
                    "data": "total_items",
                },
                {
                    "data": "brand_id",
                    "render": function(brand_id, type, row) {
                        return '<a href="<?php echo base_url() ?>admin/dailydeals/brand/' + brand_id + '/edit" class="btn btn-info btn-sm">Edit</a>';
                    }
                },
                {
                    "data": "brand_id",
                    "render": function(brand_id, type, row) {
                        return '<a href="#" id="delete_brand" data-id="' + brand_id + '" class="btn btn-danger btn-sm">Remove</a>';
                    }
                },
            ]
        });
        $('body').delegate('#delete_brand', 'click', function() {
            var brand_id = $(this).data('id');
            if (confirm("Are You Sure?")){
            $.ajax({
                type: 'DELETE',
                url: '<?php echo API_BASE; ?>' + '/deals/brands/' + brand_id,
                headers: {
                    'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
                },
                success: function(data) {
                    $("#myModal").modal();
                }
            });
            }else {
                return false;
              }
        });

    });

    function rload()
    {
     location.reload();
    }
</script>
