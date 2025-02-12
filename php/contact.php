<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data and sanitize
  $name = filter_var($_POST['name']);
  $contact = filter_var($_POST['contact']);
  $message = filter_var($_POST['message']);
  
  // Validate inputs
  $errors = [];
  if (empty($name)) {
      $errors[] = "Name is required";
  }
  if (empty($contact)) {
      $errors[] = "Email/Phone is required";
  }
  if (empty($message)) {
      $errors[] = "Message is required";
  }
  
  if (empty($errors)) {
      // Email setup
      $to = "Admin@Rigetszoo.com";
      $subject = "New Contact Form Submission";
      $email_message = "Name: $name\n";
      $email_message .= "Contact: $contact\n\n";
      $email_message .= "Message:\n$message";
      
      $headers = "From: $contact";
      
      // Send email
      if (mail($to, $subject, $email_message, $headers)) {
          $_SESSION['success'] = "Thank you for your message. We'll get back to you soon!";
      } else {
          $_SESSION['error'] = "Sorry, there was an error sending your message.";
      }
  } else {
      $_SESSION['error'] = implode("<br>", $errors);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  </head>
  <body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center py-12">
    <div class="container mx-auto max-w-4xl px-4">
      <div class="bg-white shadow-2xl rounded-2xl overflow-hidden grid md:grid-cols-2 divide-y md:divide-y-0 md:divide-x divide-gray-200">
        <!-- Contact Form Section -->
        <div class="p-10 space-y-6 bg-gray-50">
          <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Contact Us</h2>
          <form class="space-y-5">
            <div>
              <label class="block text-gray-700 mb-2">Name</label>
              <input 
                type="text" 
                placeholder="Enter your name" 
                class="w-full p-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
              />
            </div>
            <div>
              <label class="block text-gray-700 mb-2">Email/Phone</label>
              <input 
                type="text" 
                placeholder="How can we reach you?" 
                class="w-full p-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
              />
            </div>
            <div>
              <label class="block text-gray-700 mb-2">Message</label>
              <textarea 
                placeholder="How can we help you today?" 
                rows="5"
                class="w-full p-3 rounded-lg border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
              ></textarea>
            </div>
            <button 
              type="submit" 
              class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold shadow-md"
            >
              Send Message
            </button>
          </form>
        </div>

        <!-- Contact Information Section -->
        <div class="p-10 bg-blue-50 flex flex-col justify-center space-y-8">
          <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Contact Details</h2>
          <div class="space-y-6">
            <div class="flex items-center space-x-4">
              <i class="fas fa-phone text-blue-600 text-2xl w-10 text-center"></i>
              <div>
                <p class="text-gray-700 font-semibold">Phone</p>
                <p class="text-gray-600">01456 368268</p>
              </div>
            </div>
            
            <div class="flex items-center space-x-4">
              <i class="fas fa-envelope text-blue-600 text-2xl w-10 text-center"></i>
              <div>
                <p class="text-gray-700 font-semibold">Email</p>
                <p class="text-gray-600">Admin@Rigetszoo.com</p>
              </div>
            </div>
            
            <div class="flex items-center space-x-4">
              <i class="fas fa-map-marker-alt text-blue-600 text-2xl w-10 text-center"></i>
              <div>
                <p class="text-gray-700 font-semibold">Address</p>
                <p class="text-gray-600">
                  Rigets Zoo Adventures<br/>
                  Riget, Any County<br/>
                  United Kingdom RG23 2QD
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>