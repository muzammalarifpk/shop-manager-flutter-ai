<html>
  <head>
    <title>Find products and shops nearby in <?=$path_info[0]?></title>
    <link rel="stylesheet" href="/css/world.css">
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
  </head>
  <body>
    <h1>MoqaMe</h1>
    <h2>Find Products and shops nearby from people you know in <?=$path_info[0]?>.</h2>
    <form class="findshop" action="" method="post">
      <label for=""></label>
      <input id="shopnumber" type="text" name="shopnumber" value="">
      <input id="submitbtn" type="submit" name="submit" value="Visit Shop">
    </form>
    <script type="text/javascript">
      $( ".findshop" ).submit(function( event ) {
          event.preventDefault();
          // alert( "Handler for .submit() called." );
          var number = $("#shopnumber").val();
          window.location.href = number + '/';
        });
    </script>
  </body>
</html>
