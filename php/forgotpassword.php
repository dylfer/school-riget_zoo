<?php
    include 'components/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div class="flex w-dvw h-dvh justify-center items-center bg-slate-700">
      <form
        class="flex flex-col items-center justify-center bg-white bg-opacity-90 rounded-lg p-6 max-w-md w-full"
      >
        <h1 class="text-2xl text-center m-2 p-1">Forgot Password</h1>
        <!-- <img
          src="Black_and_White_Simple_Modern_Minimalist_Animals_Zoo_Station_Circle_Logo-removebg-preview.png"
          alt="Logo"
          class="block mx-auto w-3/5 h-auto"
        /> -->
        <p class="text-center m-2 p-1">
          Enter you'r email or username and you will get sent a email with a
          password reset link.
        </p>
        <div class="relative w-full h-12 my-8 rounded-full">
          <input
            type="text"
            placeholder=" "
            name="username"
            required
            class="input-login w-full p-2 rounded-lg border-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-300"
          />
          <span class="placholder-login bg-white text-gray-500 rounded-lg"
            >username/email</span
          >
          <i
            class="bx bx-user absolute right-5 top-1/2 transform -translate-y-1/2 text-xl"
          ></i>
        </div>
        <button type="submit" class="text-white bg-blue-600 p-2 m-1 rounded-lg">
          Send
        </button>
      </form>
    </div>
    <script src="forgotpassword.js"></script>
  </body>
  <?php
    include 'components/footer.php';
?>
</html>
