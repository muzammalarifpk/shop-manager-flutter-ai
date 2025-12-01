<?php
// stripe-cancel.php

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>";
echo "<meta charset='UTF-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
echo "<title>Payment Cancelled</title>";
echo "</head>";
echo "<body>";
echo "<h1>Payment Cancelled</h1>";
echo "<p>Your payment process was not completed. If this was an error, please try again. If you continue to experience issues, please contact our customer support.</p>";
echo "<a href='https://shop-manager.roznamchaapp.com/c-membership.php'>Go back to Membership</a>";
?>
<script>
    // Function to redirect after a delay
    function redirectAfterDelay() {
        setTimeout(function() {
            window.location.href = 'https://shop-manager.roznamchaapp.com/c-membership.php';
        }, 5000); // 5000 milliseconds = 5 seconds
    }

    // Call the function to initiate the redirect
    redirectAfterDelay();
</script>

<?php
echo "</body>";
echo "</html>";
?>
