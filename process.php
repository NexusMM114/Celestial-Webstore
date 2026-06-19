<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Get the data from the HTML form
    $ign = htmlspecialchars($_POST['ign']);
    $userEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $package = htmlspecialchars($_POST['package']);
    $transaction = htmlspecialchars($_POST['transaction']);

    // --- EMAIL SETUP ---
    $subject = "Order Received - CelestialMc";
    
    // The upgraded HTML email message
    $message = "
    <html>
    <head>
        <title>Order Received</title>
    </head>
    <body style='margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #2e1065;'>
        
        <!-- Background Wrapper with Purple Gradient -->
        <table width='100%' cellpadding='0' cellspacing='0' border='0' style='background-color: #2e1065; background-image: linear-gradient(135deg, #1e1b4b 0%, #4c1d95 100%); padding: 50px 20px;'>
            <tr>
                <td align='center'>
                    
                    <!-- Main Content Card -->
                    <table width='100%' cellpadding='0' cellspacing='0' border='0' style='max-width: 500px; background-color: #0f172a; border-radius: 16px; border: 1px solid #c084fc; box-shadow: 0 10px 25px rgba(0,0,0,0.5);'>
                        <tr>
                            <td align='center' style='padding: 40px 30px;'>
                                
                                <!-- Server Logo -->
                                <img src='https://i.ibb.co/Y40tL1QM/file-00000000c02c720893f224de887d0b14.png' alt='CelestialMc Logo' style='max-width: 220px; height: auto; margin-bottom: 25px;'>
                                
                                <h2 style='color: #c084fc; margin-top: 0; font-size: 24px;'>Hello, $ign!</h2>
                                <p style='color: #f8fafc; font-size: 16px; line-height: 1.6; margin-bottom: 20px;'>Your order for the <strong style='color: #a855f7;'>$package</strong> has been successfully received.</p>
                                
                                <!-- Transaction Box -->
                                <div style='background-color: #020617; padding: 20px; border-radius: 10px; margin: 25px 0; border: 1px solid #334155; text-align: center;'>
                                    <p style='color: #94a3b8; font-size: 14px; margin: 0; text-transform: uppercase; letter-spacing: 1px;'>Transaction ID</p>
                                    <p style='color: #f8fafc; font-size: 18px; font-weight: bold; margin: 8px 0 0 0; letter-spacing: 1px;'>$transaction</p>
                                </div>
                                
                                <p style='color: #cbd5e1; font-size: 15px; line-height: 1.6;'><strong>We will review your payment and deliver your package soon.</strong> Please allow up to 24 hours for manual review.</p>
                                
                                <hr style='border: 0; border-top: 1px solid #334155; margin: 30px 0;'>
                                
                                <p style='color: #94a3b8; font-size: 13px; margin: 0;'>Thank you for supporting CelestialMc!</p>
                                <p style='color: #64748b; font-size: 12px; margin-top: 5px;'>play.celestialnet.fun</p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>

    </body>
    </html>
    ";

    // Headers required for sending HTML emails safely
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // Replace this with your actual server support email so players know who sent it!
    $headers .= 'From: support@celestialnet.fun' . "\r\n"; 

    // Send the email
    if(mail($userEmail, $subject, $message, $headers)) {
        // If email sends successfully, show this success page
        echo "<body style='background: #020617; color: #f8fafc; font-family: sans-serif; text-align: center; padding-top: 20%;'>";
        echo "<h1 style='color: #a3e635;'>✅ Payment Submitted!</h1>";
        echo "<p>Please check your email <b>($userEmail)</b> for confirmation.</p>";
        echo "<a href='index.html' style='color: #c084fc; text-decoration: none; font-weight: bold; margin-top: 20px; display: inline-block;'>Return to Home</a>";
        echo "</body>";
    } else {
        // If server fails to send email
        echo "<body style='background: #020617; color: #f8fafc; font-family: sans-serif; text-align: center; padding-top: 20%;'>";
        echo "<h1 style='color: #ef4444;'>❌ Error Sending Email</h1>";
        echo "<p>We received your order, but our server failed to send the confirmation email. Please contact us on Discord.</p>";
        echo "<a href='index.html' style='color: #c084fc; text-decoration: none; font-weight: bold; margin-top: 20px; display: inline-block;'>Return to Home</a>";
        echo "</body>";
    }
} else {
    // If someone tries to access process.php directly without filling the form
    header("Location: payment.html");
    exit();
}
?>

