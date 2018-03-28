

<section>
<!-- <div class="container minus-margin"> -->
	<div class="row">
    <div class="col-sm-12">
		  <div class="col-sm-3">
        <?php $this->load->view('includes/left_menu'); ?>
      </div>

        <div class="col-sm-9">
        	<div class="main-content">


            </div>
        <!--search-->

<div class="col-sm-12">
 <?php if($this->session->flashdata('success_msg'))
                        {
                            echo "<div class='alert alert-success'>";
                            echo $this->session->flashdata('success_msg');
                            echo " </div>";
                        }
                    ?>
   </div>

        <!--end search-->
            <div class="col-sm-12">
              <div class='overlay'>
              </div>
            	<div class="data-table table-responsive">

                    <div class="panel panel-primary">
                        <div class="panel-heading">Users Management</div>
                        <div class="panel-body" style="overflow: auto;  ">
                            <table class="dataTable table  table-striped table-bordered" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Wishlist</th>
                                    <th width="200">Registration Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>


                    <!-- Modal -->
                                        <div class="modal fade" id="myModal" role="dialog">
                                          <div class="modal-dialog modal-sm">
                                            <div class="modal-content">

                                              <div class="modal-body">

                                                      <p>Are you sure you wish to change status to Inactive?</p>

                                              </div>
                                              <div class="modal-footer">
                                                <div class="col-sm-6 col-xs-6">

                                <a href="" id="button123" class="btn btn-info" role="button" style="width: 100%;
                                background-color: transparent; border: medium; color:#333;">Yes</a>

                                                   </div>
                                                   <div class="col-sm-6 col-xs-6">
                                                    <button type="button" class="btn btn-default btn-block" data-dismiss="modal" style="width: 100%;
                                background-color: transparent; border: medium; border-width: 0px 0px 0px 1px;">Cancel</button>
                                                   </div>

                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                         <div class="modal fade" id="myModal2" role="dialog">
                                          <div class="modal-dialog modal-sm">
                                            <div class="modal-content">

                                              <div class="modal-body">

                                                      <p>Are you sure you wish to change status to Active?</p>

                                              </div>
                                              <div class="modal-footer">
                                                <div class="col-sm-6 col-xs-6">


                                <a href="" id="button456" class="btn btn-info" role="button" style="width: 100%;
                                background-color: transparent; border: medium; color:#333;">Yes</a>

                                                   </div>
                                                   <div class="col-sm-6 col-xs-6">
                                                    <button type="button" class="btn btn-default btn-block" data-dismiss="modal" style="width: 100%;
                                background-color: transparent; border: medium;border-width: 0px 0px 0px 1px;">Cancel</button>
                                                   </div>

                                              </div>
                                            </div>
                                          </div>
                                        </div>

                </div>
            </div>
             <div class="pull-right"><?php //echo $this->pagination->create_links(); ?></div>
        </div>



    </div>
    </div>
</div>
</section>

<style type="text/css">
.btn-info {
  background-color: transparent;
     border-color: transparent;
}
</style>

<script type="text/javascript">
    function user_wishlist(id)
    {
        window.location.href = "<?php echo site_url('admin_wishlist/user_wishlist'); ?>"+"/"+id;
    }
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>



<script>
  function change() // no ';' here
  {
      var elem = document.getElementById("go");

         elem.value = "Close";

         document.getElementById("go").innnerText="Close";
         $("#go").attr('value', 'Close');



  }

  function Fun_1(obj)
  {
    //alert($(obj).data('id') );
     $('#button123').attr("href", $(obj).data('id')  );
          $('#myModal').modal('show');

  }

  function Fun_2(obj)
  {

     $('#button456').attr("href", $(obj).data('id')  );

      $('#myModal2').modal('show');

  }

  $(document).ready(function()
  {


      var table = $('.dataTable').DataTable({
          "ajax": {
              url: "<?php echo base_url() ?>api/users-datatable",
              beforeSend: function(xhr){
                  xhr.setRequestHeader("Authorization", "Basic <?php echo $this->session->userdata('auth'); ?>");
              }
          },
          "columnDefs": [
              {
                  "targets": 3,
                  "render": function ( status, type, row ) {
                      var id = row.slice(-1)[0];
                      var link = '<?php echo site_url('user/change_status'); ?>' + '/' + id + '/' + status;

                      if(status == 2) {
                          return '<button type="button" data-id="' + link + '" class="btn btn-success btn-sm open-active1" onClick="Fun_1(this);" data-toggle="modal" data-target="#myModal">Active</button>';
                      } else {
                          return '<button type="button" data-id="' + link + '" class="btn btn-danger btn-sm open-active2" onClick="Fun_2(this);" data-toggle="modal" data-target="#myModal2">Inactive</button>';
                      }
                  }
              },
              {
                  "targets": 4,
                  "render": function ( wishlists, type, row ) {

                      if(wishlists == 0) {
                          return '<h4><span class="label label-danger open-active1" >0 items</span></h4>';
                      } else {
                          return '<h4><span class="label label-success open-active1" >' + wishlists + ' items</span></h4>';
                      }
                  }
              },
              {
                  "targets": 0,
                  "render": function ( firstName, type, row ) {
                      var id = row.slice(-1)[0];
                      return '<a href="javascript:user_wishlist('+id+')">'+firstName+'</a>';
                  }
              },
              {
                  "targets": 1,
                  "render": function ( lastName, type, row ) {
                      var id = row.slice(-1)[0];
                      return '<a href="javascript:user_wishlist('+id+')">'+lastName+'</a>';
                  }
              }
          ]
      });

      $('.dataTable').on( 'click', ' .user-status', function () {
          var data = table.row( $(this).parents('tr') ).data();
          console.log(data);
      } );

//    document.getElementById("search_query").value = "";


    $(".open-active1").click(function ()
    {

        $('#button123').attr("href", $(this).data('id') );

        $('#myModal').modal('show');

    });


    $(".open-active2").click(function ()
    {

        $('#button456').attr("href", $(this).data('id') );

        $('#myModal2').modal('show');

    });


   $('#search_query').keyup(function()
   {
        var elem = document.getElementById("go");
        elem.value = "Close";

        var searchField = $('#search_query').val();
        var regex = new RegExp(searchField, "i");
        var output = '';
        var count = 1;

        var elem = document.getElementById("go");
        // elem.value = "Close";
         document.getElementById("go").innnerText="Close";
         $("#go").attr('value', 'Close');
         elem.href="<?php echo site_url('user/home'); ?>";
          //$("#go").attr("href", "<?php echo site_url('user/home'); ?>");
          //elem.onclick = function() {  location.reload();  }

        if(searchField!=""){

        $.getJSON('<?php echo site_url('user/search'); ?>', function(data) {
          $.each(data, function(key, val){
           if ((val.first_name.search(regex) != -1) || (val.last_name.search(regex) != -1) || (val.email.search(regex) != -1)) {
              output += '<tr>';


              output += '<td><a href="javascript:user_wishlist('+val.id+')">' + val.first_name + '</a></td>';
              output += '<td><a href="javascript:user_wishlist('+val.id+')">' + val.last_name + '</a></td>';
       output += '<td>' + val.email + '</td>';

       var link = '<?php echo site_url('user/change_status'); ?>' + '/' + val.id + '/' + val.status;

      if(val.status==2)
        {
          output +='<td><button type="button" data-id="' + link + '" class="btn btn-info btn-sm open-active1" onClick="Fun_1(this);" data-toggle="modal" data-target="#myModal" style="background-color: transparent; color: #4b156d;" >Active</button></td>';
        }else
          {
          output +='<td><button type="button" data-id="' + link + '" class="btn btn-info btn-sm open-active2" onClick="Fun_2(this);" data-toggle="modal" data-target="#myModal2" style="background-color: transparent; color: red;" >Inactive</button></td>';
          }

           //var datedip = new Date(val.created_on);

            function pad(s) { return (s < 10) ? '0' + s : s; }
            var d = new Date(val.created_on);
            var datedip = [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/');

       output += '<td>' + datedip + '</td>';

              output += '</tr>';

              /*if(count%2 == 0){
                output += '</div><div class="row">'
              }*/
              count++;
            }

          });

          //output += '</div>';
          $('#userdata').html(output);
        });

      }
      else
      {
        location.reload();
      }


    });
  });

</script>



