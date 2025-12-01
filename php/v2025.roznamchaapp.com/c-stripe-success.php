<?php
require_once('includes/libs/stripe/vendor/autoload.php');
require_once("c-change-password.config.php");
$meta['info']['title']='Membership Center';
$meta['info']['des']='Customer Love Center';
require_once("includes/head.php");
require_once("includes/libs/form.cls.php");
require_once("includes/libs/table.cls.php");

$mode = 'test';

if($mode=='test')
{
  // Stripe test API key - set via environment variable
  $stripe_secret_key = getenv('STRIPE_TEST_SECRET_KEY') ?: 'YOUR_STRIPE_TEST_SECRET_KEY_HERE';
}else {
  // Stripe live API key - set via environment variable
  $stripe_secret_key = getenv('STRIPE_LIVE_SECRET_KEY') ?: 'YOUR_STRIPE_LIVE_SECRET_KEY_HERE';
}


function updateMembership($session, $db) {
    try {
        // Assuming the user's 'number' (username) is linked to the Stripe customer ID
        $userNumber = $_SESSION['sess_bp_username'];

        // Determine the membership type based on the price ID
        $membershipType = '';
        foreach ($session->line_items->data as $item) {
            if ($item->price->id == 'yourMonthlyPriceId') {
                $membershipType = 'monthly';
            } elseif ($item->price->id == 'yourYearlyPriceId') {
                $membershipType = 'yearly';
            } elseif ($item->price->id == 'yourLifetimePriceId') {
                $membershipType = 'lifetime';
            }
        }

        // Update the user's membership details in your database
        $query = "UPDATE users SET membership_type = :membershipType WHERE number = :userNumber";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':membershipType', $membershipType);
        $stmt->bindParam(':userNumber', $userNumber);
        $stmt->execute();

        // Update session data if needed
        $_SESSION['sess_bp_type'] = $membershipType;

        return true;

    } catch (Exception $e) {
        // Handle any exceptions (such as database errors)
        error_log("Error updating membership: " . $e->getMessage());
        return false;
    }
}


?>

<style>
.block12{width: 100% !important;}
.block11{width: 91.63% !important;}
.block10{width: 83.33% !important;}
.block9{width: 75% !important;}
.block8{width: 66.64% !important;}
.block7{width: 58.31% !important;}
.block6{width: 50% !important;}
.block5{width: 41.65% !important;}
.block4{width: 33.32% !important;}
.block3{width: 25% !important;}
.block2{width: 16.66% !important;}
.block1{width: 8.33% !important;}
.form-horizontal{width: 100%;}
.form-horizontal .row{ margin-top: 10px; margin-bottom: 10px;}
</style>
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor"><?=$meta['info']['title']?></h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="dashboard.php"><?=$string['g']['home']?></a></li>
                    </ol>
                </div>
                <div  class="hide">
                    <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->

            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->

              <div class="row">
                <div class="col-12">
                  <div class="card" style="background:#fff;">
                    <div class="card-body">
                      <?php
                      \Stripe\Stripe::setApiKey($stripe_secret_key);

                        // Checking if the session ID is passed
                        if (isset($_GET['session_id'])) {
                            $session_id = $_GET['session_id'];

                            try {
                                // Retrieve the checkout session with expanded line items
                                $session = \Stripe\Checkout\Session::retrieve($session_id, ['expand' => ['line_items']]);

                                // Verify the transaction
                                if ($session->payment_status === 'paid') {
                                    // The transaction was successful

                                    // Identify the purchased package
                                    $purchasedItems = [];
                                    if ($session->line_items && $session->line_items->data) {
                                        foreach ($session->line_items->data as $item) {
                                          $purchasedItems[] = [
                                              'price_id' => $item->price->id,
                                              'amount' => $item->amount_total,
                                              'currency' => $item->currency,
                                              'quantity' => $item->quantity
                                          ];
                                        }
                                      } else {
                                        // Handle the case where line_items is null
                                        echo "No line items found.";
                                    }

                                    // Usage of the function
                                    // Assuming $session is the Stripe session object you retrieved earlier and $db is your PDO database connection
                                    if(updateMembership($session, $db)) {
                                        echo "Membership updated successfully.";
                                    } else {
                                        echo "Failed to update membership.";
                                    }

                                    // Show success message to the customer
                                    echo "<h1>Payment Successful</h1>";
                                    echo "<p>Thank you for your payment. Your transaction has been completed successfully.</p>";
                                    echo "<a href='https://shop-manager.roznamchaapp.com/c-membership.php'>Go back to Membership</a>";

                                    echo '<hr />';

                                    // echo '<h2>Stripe Data</h2>';
                                    // print_r($session);
                                    // echo '<h2>Our Data</h2>';
                                    // print_r($_SESSION);


                                } else {
                                    // Payment status not paid
                                    // Handle according to your business logic
                                    echo "Payment not successful.";
                                }
                            } catch (\Stripe\Exception\ApiErrorException $e) {
                                // Handle error
                                echo "Error: " . $e->getMessage();
                            }
                        } else {
                            // Session ID was not passed
                            echo "Session ID is missing.";
                        }
                      ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <?php require_once("includes/right.php"); ?>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer"><?=$footer_note?></footer>
<!-- ============================================================== -->
<!-- End footer -->
<!-- ============================================================== -->
</div>
<?php
require_once("includes/footer.php");
echo $meta['footer']['script'];
?>
