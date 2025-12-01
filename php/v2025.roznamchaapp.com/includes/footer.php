<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
</div>

<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.21.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.21.0/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyBrI9TAHm4QnCT9xuWU64rBMq-xnAl7Y6A",
    authDomain: "shop-manager-cloud.firebaseapp.com",
    databaseURL: "https://shop-manager-cloud.firebaseio.com",
    projectId: "shop-manager-cloud",
    storageBucket: "shop-manager-cloud.appspot.com",
    messagingSenderId: "391497365346",
    appId: "1:391497365346:web:1030b5ce01597a51249e3b",
    measurementId: "G-05XJ4CVZQH"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122818105-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-122818105-2');

/*

function check_net()
{
  var isOnline = window.navigator.onLine;
  var theme_status = $("#theme").attr('href');
  if (isOnline && theme_status=='css/colors/red.css') {
    $("#theme").attr('href','css/colors/blue.css');
    console.log('online');
  }else if(!isOnline)
  {
    $("#theme").attr('href','css/colors/red.css');
    console.log('offline');
  }
}
  setInterval(function(){ check_net();}    , 3000);
*/
</script>

<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

    <?php


      foreach ($meta['footer']['js'] as $key => $value) {

      ?>

      <!-- <?=$key?>  -->
      <script src="<?=$value?>"></script>



      <?php
      }
      require_once('services/close_dbc.php');

    ?>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.left-sidebar').removeClass('hide');
      });
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
