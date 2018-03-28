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
<?php
// var_dump($productdata);
?>
                  <div class="panel panel-primary">
                      <div class="panel-heading">Products Management</div>
                      <div class="panel-body">
                          <table class="dataTable table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>Product Category</th>
                                      <th>Product Image</th>
                                      <th>Product Name</th>
                                      <th>Price</th>
                                      <th>Currency</th>
                                      <th>Trend Rating</th>
                                      <th>Product URL</th>
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
      
              <p>Product deleted successfully.</p>
       
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

            "ajax": {
                url: "<?php echo base_url() ?>api/products-datatable/all/category/0",
                beforeSend: function(xhr){
                    xhr.setRequestHeader("Authorization", "Basic <?php echo $this->session->userdata('auth'); ?>");
                }
            },

            "processing": true,
            "serverSide": true,
            "columnDefs": [
                {
                    "targets": 1,
                    "render": function (imageUrl) {
                        if(imageUrl.length) {
                            return '<img class="img-responsive" style="margin:auto;object-fit: contain;" src="'+imageUrl+'" />';
                        } else {
                            return '<img  class="img-responsive" style="margin:auto;" src="<?php echo base_url()?>images/profile-image-border.png" />';
                        }
                    }
                },
                {
                    "targets": 2,
                    "render": function (name, type, row) {
                        var id = row.slice(-1)[0];
                        // alert (id);
                        var productUpdateURL = '<?php echo site_url("admin/product/update"); ?>';
                        return '<a href="'+productUpdateURL+'/' + id + '">' + name.substr(0,20) + '..</a>';
                    }
                },
                {
                    "targets": 3,
                    "render": function (price, type, row) {
                        return row[4] + ' ' + price;
                    }
                },
                {
                    "targets": 4,
                    "visible": false
                },
                {
                    "targets": 5,
                    "render": function (trend_rating, type, row) {
                        var id = row.slice(-1)[0];
                        var stars = '';
                        for(var i=1; i<=5; i++) {
                            if( i <= trend_rating )
                                stars += '<span data-rating="' + i + '" data-pid="' + id + '" class="glyphicon glyphicon-large glyphicon-star" style="color: #ffd203; font-size: 1.2em;" id="' + i + '-' + id +  '"></span>';
                        else
                            stars += '<span data-rating="' + i + '" data-pid="' + id + '" class="glyphicon glyphicon-large glyphicon-star-empty" style="color: #ffd203; font-size: 1.2em;" id="' + i + '-' + id +  '"></span>';
                        }

                        return '<div class="trend-rating" style="text-align:center; vertical-align: middle;min-width: 150px;"><input type="hidden" data-pid="' + id + '" id="trend_rating" value="' + trend_rating + '"/>' + stars + '</div>';
                    }
                },
                {
                    "targets": 6,
                    "render": function (url, type, row) {
                        return '<a href="'+url+'">Link</a>';
                    }
                },
                {
                    "targets": 7,
                    "render": function (name, type, row) {
                        var id = row.slice(-1)[0];
                        // alert (name);
                        return '<a href="javascript:delete_product('+id+')" class="btn btn-danger btn-sm" >Remove</a>';
                        // data-toggle="modal" data-target="#myModal"
                          // return '<a href="#" id="delete_item" data-id="' + product_id + '" class="btn btn-danger btn-sm">Remove</a>';
                    }
                    // {
                    //      // "targets": 7,
                    // "data": "product_id",
                    // "render": function(product_id, type, row) {
                    //     return '<a href="#" id="delete_item" data-id="' + product_id + '" class="btn btn-danger btn-sm">Remove</a>';
                    // }
                }
            ]
        });
    });
</script>

<script type="text/javascript">
    $(document).on( 'click', '.trend-rating span', function() {
        var new_rating = $(this).attr('data-rating');
        var pid = $(this).attr('data-pid');
        // alert (pid);
        $('#trend_rating' + '[data-pid="' + pid + '"]').attr('value', new_rating);
        for( var i = 1; i <=5; i++ )
        {
            if( i <= new_rating )
                $('#' + i).removeClass().addClass('glyphicon glyphicon-star');
            else
                $('#' + i).removeClass().addClass('glyphicon glyphicon-star-empty');
        }
        $.ajax({

            type: 'PUT',
            url: '<?php echo API_BASE; ?>' + '/products/' + pid + '/trend_rating/' + new_rating,
            headers: {
                'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
            },
            success: function(data) {
                alert("Trend Rating Updated.");
            }
        });
    });

    $(document).on('mouseenter', '.trend-rating span', function() {
        var new_rating = $(this).attr('data-rating');
        var pid = $(this).attr('data-pid');
        for( var i = 1; i <=5; i++ )
        {
            if( i <= new_rating )
                $('#' + i + '-' + pid).removeClass().addClass('glyphicon glyphicon-star');
            else
                $('#' + i + '-' + pid).removeClass().addClass('glyphicon glyphicon-star-empty');
        }
    });

    $(document).on('mouseleave', '.trend-rating span', function() {
        var pid = $(this).attr('data-pid');
        var new_rating = $('#trend_rating' + '[data-pid="' + pid + '"]').attr('value');
        for( var i = 1; i <=5; i++ )
        {
            if( i <= new_rating )
                $('#' + i + '-' + pid).removeClass().addClass('glyphicon glyphicon-star');
            else
                $('#' + i + '-' + pid).removeClass().addClass('glyphicon glyphicon-star-empty');
        }
    });
// alert (product_id);
// $('body').delegate('#delete_item', 'click', function() {
//             var product_id = $(this).data('id');
    function delete_product(product_id) {
        if (confirm("Are You Sure?")){
        $.ajax({
            type: 'DELETE',
            url: '<?php echo API_BASE; ?>' + '/products/' + product_id,
            headers: {
                'Authorization': 'Basic ' + '<?php echo $this->session->userdata('auth'); ?>',
            },
            success: function(data) {
                $("#myModal").modal()               
            }
        });
        }else {
            return false;
        }
    }

function rload()
{
location.reload();
}
</script>
<style>
    .trend-rating span {
        font-size: 18px;
        padding-right: 3px;
        cursor: pointer;
    }
</style>
