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
       <!--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/dt-1.10.9/datatables.min.css"/>
 
 <script type="text/javascript" src="https://cdn.datatables.net/r/dt/dt-1.10.9/datatables.min.js"></script>
 
 <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script> -->
<section>
<!-- <div class="container minus-margin"> -->
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
                      <div class="panel-heading">Trend Management</div>
                      <div class="panel-body">
                          <table class="dataTable table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>Title</th>
                                      <th>Image</th>
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
      
              <p>List deleted successfully.</p>
       
      </div>
      <div class="modal-footer">
       
        <div class="row">
        
          <button type="button" class="btn btn-default btn-block" data-dismiss="modal" onclick="rload()" style="width: 100%;
background-color: transparent; border: medium; border-width: 0px 0px 0px 1px;">Ok</button>

        </div>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        var table = $('.dataTable').DataTable({
// alert (table);
            "ajax": {
                url: "<?php echo base_url() ?>api/trends/lists",
                beforeSend: function(xhr){
                    xhr.setRequestHeader("Authorization", "Basic <?php echo $this->session->userdata('auth'); ?>");
                }
            },

            "processing": true,
            "serverSide": true,
            "columns": [
                {
                    "data": "list_name",

                },
                {
                    "data": "list_image",
                    "render": function (list_image) {
                        if(list_image.length) {
                            return '<img class="img-responsive" style="margin:auto;object-fit: contain;" src="'+list_image+'" />';
                        } else {
                            return '<img  class="img-responsive" style="margin:auto;" src="<?php echo base_url()?>images/profile-image-border.png" />';
                        }
                    }
                },
                {
                    "data": "total_items",
                },
                {
                    "data": "list_id",
                    "render": function(list_id, type, row) {
                        return '<a href="<?php echo base_url() ?>admin/trends/list/' + list_id + '/edit" class="btn btn-info btn-sm">Edit</a>';
                    }
                },
                {
                    "data": "list_id",
                    "render": function(list_id, type, row) {
                        return '<a href="#" id="delete_list" data-id="' + list_id + '" class="btn btn-danger btn-sm">Remove</a>';
                    }
                },
            ]

            //  "columnDefs": [
            //     {
            //         "targets": 1,
            //         "render": function (list_name) {
            //             return row[1] + ' ' + price;
            //     },
            //      {
            //         "targets": 2,
            //        "render": function (list_image) {
            //             if(list_image.length) {
            //                 return '<img class="img-responsive" style="margin:auto;object-fit: contain;" src="'+list_image+'" />';
            //             } else {
            //                 return '<img  class="img-responsive" style="margin:auto;" src="<?php echo base_url()?>images/profile-image-border.png" />';
            //             }
            //         }
            //     },
            //     {
            //         "targets": 3,
            //         "render": function (total_items) {
            //             return row[3] + ' ' + price;
            //         }
            //     },
            //    {
            //         "targets": 4,
            //        "render": function(list_id, type, row) {
            //             return '<a href="<?php echo base_url() ?>admin/trends/list/' + list_id + '/edit" class="btn btn-info btn-sm">Edit</a>';
            //         }
            //     },
            //     {
            //         "targets": 5,
            //          "render": function(list_id, type, row) {
            //             return '<a href="#" id="delete_list" data-id="' + list_id + '" class="btn btn-danger btn-sm">Remove</a>';
            //         }
            //         }
            // ]
        });
    // alert (table);    
        $('body').delegate('#delete_list', 'click', function() {
          if (confirm("Are You Sure?")){
           var list_id = $(this).data('id');

            $.ajax({
                type: 'DELETE',
                url: '<?php echo API_BASE; ?>' + '/trends/lists/' + list_id,
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
