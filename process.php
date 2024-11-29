<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
        $_SESSION['errorMessage'] = "Invalid submission. Please try again.";
    } else {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $phone = htmlspecialchars(trim($_POST['phone']));
        $serviceType = htmlspecialchars(trim($_POST['service_type']));
        $message = htmlspecialchars(trim($_POST['message']));

        if (empty($name) || empty($email) || empty($phone) || empty($serviceType)) {
            $_SESSION['errorMessage'] = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errorMessage'] = "Invalid email address.";
        } else {
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=giftem_db", "root", "");
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Check for duplicate submissions within 10 minutes
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM contact_submissions
                    WHERE email = :email AND message = :message AND created_at > NOW() - INTERVAL 10 MINUTE");
                $stmt->execute(['email' => $email, 'message' => $message]);

                if ($stmt->fetchColumn() > 0) {
                    $_SESSION['errorMessage'] = "You recently submitted a similar message. Please try again later.";
                } else {
                    // Insert the message into the database
                    $stmt = $pdo->prepare("INSERT INTO contact_submissions
                        (name, email, phone, service_type, message, created_at) 
                        VALUES (:name, :email, :phone, :service_type, :message, :created_at)");
                    $created_at = date('Y-m-d H:i:s');
                    $stmt->execute([
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'service_type' => $serviceType,
                        'message' => $message,
                        'created_at' => $created_at
                    ]);

                    // Send the email
                    $to = "info@giftemglobals.com";
                    $subject = "New Contact Submission";
                    $body = "
                        You have received a new message from the contact form on your website:\n\n
                        Name: $name\n
                        Email: $email\n
                        Phone: $phone\n
                        Service Type: $serviceType\n
                        Message:\n$message\n
                    ";
                    $headers = "From: no-reply@giftemglobals.com\r\n";
                    $headers .= "Reply-To: $email\r\n";

                    if (mail($to, $subject, $body, $headers)) {
                        $_SESSION['successMessage'] = "Your message has been sent successfully!";
                    } else {
                        $_SESSION['errorMessage'] = "There was an error sending your message via email.";
                    }
                }
            } catch (PDOException $e) {
                $_SESSION['errorMessage'] = "There was an error saving your message. Please try again.";
                error_log($e->getMessage());
            }
        }
    }

    // Redirect back to the form file
    header("Location: contact.php");
    exit();
}
?>
