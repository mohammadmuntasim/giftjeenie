<section style="padding:60px; background-color:#161616;">

</section>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!--<script src="--><?php //echo base_url();?><!--assets/js/wysihtml5-0.3.0.min.js"></script>-->
<script src="<?php echo base_url();?>assets/js/jquery-dateFormat.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<!--<script src="--><?php //echo base_url();?><!--assets/js/toggles.min.js"></script>-->
<!--<script src="--><?php //echo base_url();?><!--assets/js/jquery.sparkline.min.js"></script>-->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/bootstrap-wysihtml5.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.cookies.js"></script>
<script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>


<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

<script src="<?php echo base_url()?>assets/js/custom.js"></script>
<!--<script src="--><?php //echo base_url()?><!--assets/js/paging.js"></script>-->

<script type="text/javascript">
    $(function(){
        $("#upload_link").on('click', function(e){
            e.preventDefault();
            $("#upload:hidden").trigger('click');
        });
    });

</script>

<script type="text/javascript">
    $('#setting').click(function() {
        $('#settings_li').addClass('active-menu');
        $('.overlay').addClass('dark-overlay');
    });
    $('#setting').blur(function() {
        $('.overlay').removeClass('dark-overlay');
    })
</script>
<!--header page navigations-->

</body>
</html>



        




