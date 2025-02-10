<?php
    include 'components/navbar.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <link
      rel="icon"
      href="Black_and_White_Simple_Modern_Minimalist_Animals_Zoo_Station_Circle_Logo-removebg-preview.png"
    />
    <title>Thanks for your order!</title>
    <link rel="stylesheet" href="style.css" />
    <script src="return.js" defer></script>
  </head>
  <body>
    <section id="success" class="hidden">
      <p>
        We appreciate your business! A confirmation email will be sent to
        <span id="customer-email"></span>. If you have any questions, please
        email <a href="mailto:orders@example.com">help@Rigetszoo.com</a>.
      </p>
    </section>
  </body>
  <?php
    include 'components/footer.php';
  ?>
</html>
