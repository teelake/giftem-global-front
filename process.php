
 

<?php
session_start();

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['errorMessage'] = "Invalid CSRF token. Please try again.";
        header("Location: contact.php");
        exit;
    }

    // Process form fields
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $serviceType = htmlspecialchars(trim($_POST['service_type']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($serviceType) || empty($message)) {
        $_SESSION['errorMessage'] = "All fields are required.";
        header("Location: contact.php");
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errorMessage'] = "Invalid email address.";
        header("Location: contact.php");
        exit;
    }

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=giftem_db", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check for duplicate submissions
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM contact_submissions
            WHERE email = :email AND message = :message AND created_at > NOW() - INTERVAL 10 MINUTE");
        $stmt->execute(['email' => $email, 'message' => $message]);

        if ($stmt->fetchColumn() > 0) {
            $_SESSION['errorMessage'] = "You recently submitted a similar message. Please try again later.";
        } else {
            // Insert into database
            $stmt = $pdo->prepare("INSERT INTO contact_submissions (name, email, phone, service_type, message, created_at)
                                   VALUES (:name, :email, :phone, :service_type, :message, :created_at)");
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'service_type' => $serviceType,
                'message' => $message,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Send email notification
            $to = "info@giftemglobals.com";
            $subject = "New Contact Submission";
            $body = "Name: $name\nEmail: $email\nPhone: $phone\nService Type: $serviceType\nMessage:\n$message";
            $headers = "From: no-reply@giftemglobals.com\r\nReply-To: $email\r\n";

            if (mail($to, $subject, $body, $headers)) {
                $_SESSION['successMessage'] = "Your message has been sent successfully!";
            } else {
                $_SESSION['errorMessage'] = "Error sending your message via email.";
            }
        }
    } catch (PDOException $e) {
        $_SESSION['errorMessage'] = "Database error: " . $e->getMessage();
    }
    header("Location: contact.php");
    exit;
}
