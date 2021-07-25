 <div id="tmpDiv"></div><!-- For model pop up -->
  <a id="back-to-top" href="#" class="btn btn-danger btn-lg back-to-top" role="button"><i class="fa fa-chevron-up"></i></a>
  <div class="se-pre-con"></div>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

</body>
</html>

<script type="text/javascript">

   $(window).on('load', function(){ 

    $(".se-pre-con").fadeOut("slow");

   });


	$(document).ready(function(){

  $(window).scroll(function () {
      if ($(this).scrollTop() > 50) {
        $('#back-to-top').fadeIn();
      } else {
        $('#back-to-top').fadeOut();
      }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
      $('body,html').animate({
        scrollTop: 0
      }, 400);
      return false;
     });
	})


</script>
