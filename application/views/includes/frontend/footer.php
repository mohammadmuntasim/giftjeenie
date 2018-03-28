</div>
<script src="<?php echo base_url()?>assets/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
<script src="<<?php echo base_url()?>assets/js/modernizr.min.js"></script>
<script src="<?php echo base_url()?>assets/js/retina.min.js"></script>
<script src="<?php echo base_url()?>assets/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url()?>assets/js/custom.js"></script>
<script>
if ($.browser.webkit) {
 var ht = $(".container").height() +100;
  
    $("#main").addClass("clsmain");
    //$("#main").css("height",ht.toString() + "px");
} else if ( $.browser.safari ) {
   var ht = $(".container").height() +100;
   
    $("#main").addClass("clsmain");
    //$("#main").css("height",ht.toString() + "px");
// Opera CSS
} else if ( $.browser.opera ) {
  var ht = $( window ).height();
// Internet Explorer CSS
} else if ( $.browser.msie ) {
   var ht = $( window ).height();
// Mozilla FireFox CSS
} else if ( $.browser.mozilla ) {
   var ht = $( window ).height();
   $("#main").css("height",ht.toString() + "px");
// Normal Revert, careful and note your the use of !important
} else {
   var ht = $( window ).height();
  
   
}
</script>
</body>
</html>