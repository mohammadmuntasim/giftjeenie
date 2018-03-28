<div class="container minus-margin">
	<div class="row">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <?php $this->load->view('includes/left_menu'); ?>
            </div>
            <?php
                $attributes = array('class' => 'form-horizontal', 'id' => 'add_list','enctype'=>"multipart/form-data",'method'=>'post');
                echo form_open('admin/trends/list/' . $listdata->list_id . '/add_item', $attributes);
            ?>
            <div class="col-sm-9">
                <div class="main-content">
                    <div class="col-sm-12">
                        <div class="row">
                            <a href="<?php echo base_url() . 'admin/trends/list/' . $listdata->list_id . '/edit';  ?>">< <?php echo $listdata->list_name ?></a>
                        </div>
                        <div class="row">
                            <div class="data-table-2 table-responsive">
                                <div class="panel panel-primary">
                                    <div class="panel-heading"></div>
                                        <div class="panel-body">
                                            <table class="dataTable table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Product Name</th>
                                                        <th>Product Image</th>
                                                        <th>Product Category</th>
                                                        <th>Product Price</th>
                                                        <th>Trend Rating</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">
                                <button type="submit" name="submit" class="btn btn-product" style="width: 100%;">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<?php   
    $without = [];
    foreach($listdata->products as $product ) {
        $without[] = $product->product_id;
    }
?>
<script>
    $(document).ready(function() {
        var table = $('.dataTable').DataTable({

            "ajax": {
                url: "<?php echo base_url() ?>api/products-datatable/all/category/0",
                beforeSend: function(xhr){
                    xhr.setRequestHeader("Authorization", "Basic <?php echo $this->session->userdata('auth'); ?>");
                },
                data: function(data) {
                    data.without = '<?php echo implode(',', $without) ?>';
                }
            },
            "sorting": false,
            "processing": true,
            "serverSide": true,
            "columns": [
                 {
                    "data": 2,
                    "render": function (name, type, row) {
                        return name;
                    }
                },
                {
                    "data": 1,
                    "render": function (imageUrl) {
                        if(imageUrl.length) {
                            return '<img class="img-responsive" style="margin:auto;object-fit: contain;" src="'+imageUrl+'" />';
                        } else {
                            return '<img  class="img-responsive" style="margin:auto;" src="<?php echo base_url()?>images/profile-image-border.png" />';
                        }
                    }
                },
                
                {
                    "data": 0,
                    "render": function (category, type, row) {
                        return category;
                    }
                },
                {
                    "data": 3,
                    "render": function (price, type, row) {
                        return row[4] + ' ' + price;
                    }
                },
                {
                    "data":4,
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
                    "data": 7,
                    "render": function (name, type, row) {
                        var id = row.slice(-1)[0];
                        return '<input type="checkbox" data-productid="' + id + '" name="check[' + id + ']">';
                    }
                }
            ]
        });
    });
</script>