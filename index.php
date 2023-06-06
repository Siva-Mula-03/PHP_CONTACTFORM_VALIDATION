<?php
  $error = "";
  $successMessage = "";
  
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST["email"])) {
      $error .= "An email address is required.<br>";
    }
    if (empty($_POST["content"])) {
      $error .= "Content is required.<br>";
    }
    if (empty($_POST["subject"])) {
      $error .= "Subject is required.<br>";
    }
    
    if (!empty($_POST["email"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $error .= "The email address is invalid.<br>";
    }
    
    if ($error === "") {
      $emailTo = "me@mydomain.com";
      $subject = $_POST["subject"];
      $content = $_POST["content"];
      $headers = "From: " . $_POST["email"];
      
      if (mail($emailTo, $subject, $content, $headers)) {
        $successMessage = '<div class="alert alert-success" role="alert">Your message was sent, we\'ll get back to you ASAP!</div>';
      } else {
        $error = '<div class="alert alert-danger" role="alert">Your message couldn\'t be sent - please try again later.</div>';
      }
    } else {
      $error = '<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>' . $error . '</div>';
    }
  }
  ?>