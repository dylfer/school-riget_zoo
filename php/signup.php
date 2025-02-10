<?php
include 'components/navbar.php';
include 'scripts/DB_conect.php';

// Function to generate a random string for token_secret and 2fa_secret
function generateRandomString($length = 32) {
    return bin2hex(random_bytes($length));
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = uniqid();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $educational = isset($_POST['educational']) ? 1 : 0;
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $token_secret = generateRandomString();
    $two_fa_secret = generateRandomString();

    $sql = "INSERT INTO users (id, username, email, password, educational, token_secret, 2fa_secret, first_name, last_name, phone)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisssss", $id, $username, $email, $password, $educational, $token_secret, $two_fa_secret, $first_name, $last_name, $phone);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="icon"
      href="Black_and_White_Simple_Modern_Minimalist_Animals_Zoo_Station_Circle_Logo-removebg-preview.png"
    />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>Sign Up</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body
    class="flex justify-center items-center min-h-screen bg-cover bg-center"
    style="background-image: url('SignUp_bg.png')"
  >
    <script src="login.js"></script>
    <div class="login">
      <div
        class="wrapper w-96 bg-white bg-opacity-90 text-black rounded-lg p-8"
      >
        <form action="">
          <h1 class="text-2xl text-center">Sign Up</h1>
          <div>
            <!-- Logo -->
            <img
              src="Black_and_White_Simple_Modern_Minimalist_Animals_Zoo_Station_Circle_Logo-removebg-preview.png"
              alt="Logo"
              class="block mx-auto w-3/5 h-auto"
            />
          </div>
          <div
            class="input-box relative w-full h-12 bg-white my-6 mt-5 rounded-full"
          >
          <!-- Username -->
            <input
              type="text"
              placeholder=" "
              name="username"
              required
              class="input-signup w-full h-full bg-transparent border-none outline-none border-2 border-black rounded-full text-base text-black px-5 py-2.5"
            />
            <span class="placholder-signup bg-white text-gray-500 rounded-lg"
              >Username</span
            >
            <i
              class="bx bx-user absolute right-5 top-1/2 transform -translate-y-1/2 text-xl"
            ></i>
          </div>
          <div
            class="input-box relative w-full h-12 bg-white my-6 mt-5 rounded-full"
          >
          <!-- User Email -->
            <input
              type="Email"
              name="email"
              placeholder=" "
              required
              class="input-signup w-full h-full bg-transparent border-none outline-none border-2 border-black rounded-full text-base text-black px-5 py-2.5"
            />
            <span class="placholder-signup bg-white text-gray-500 rounded-lg"
              >Email</span
            >
            <i
              class="bx bx-envelope absolute right-5 top-1/2 transform -translate-y-1/2 text-xl"
            ></i>
          </div>
          <div
            class="input-box relative w-full h-12 bg-white my-6 mt-5 rounded-full"
          >
          <!-- User Password -->
            <input
              type="password"
              placeholder=" "
              name="password"
              required
              class="input-signup w-full h-full bg-transparent border-none outline-none border-2 border-black rounded-full text-base text-black px-5 py-2.5"
            />
            <span class="placholder-signup bg-white text-gray-500 rounded-lg"
              >Password</span
            >
            <i
              class="bx bx-lock-alt absolute right-5 top-1/2 transform -translate-y-1/2 text-xl"
            ></i>
          </div>
          <div
            class="input-box relative w-full h-12 bg-white my-6 mt-5 rounded-full"
          >
          <!-- Password Confirmation -->
            <input
              type="password"
              placeholder=" "
              name="password"
              required
              class="input-signup w-full h-full bg-transparent border-none outline-none border-2 border-black rounded-full text-base text-black px-5 py-2.5"
            />
            <span class="placholder-signup bg-white text-gray-500 rounded-lg"
              >Confirm Password</span
            >
            <i
              class="bx bx-lock-alt absolute right-5 top-1/2 transform -translate-y-1/2 text-xl"
            ></i>
          </div>
          <div class="tc text-sm text-center my-5">
            <label
              ><input type="checkbox" /> I have read and agree to the
              <a href="T&C.html" class="underline hover:text-blue-700"
                >Terms and Conditions</a
              ></label
            >
          </div>
          <button
            type="submit"
            class="btn w-full h-11 bg-white border-none outline-none rounded-full shadow-md cursor-pointer text-base text-black font-semibold mt-5 mb-4"
          >
          <!-- Sign Up Button -->
            Sign Up
          </button>
          <div class="text-sm text-center my-5">
            <!-- Link to Login Page -->
            <p>
              Alredy have an account?
              <a
                href="login.html"
                class="text-black font-semibold hover:underline"
                >Login</a
              >
            </p>
          </div>
        </form>
      </div>
    </div>
  </body>
  <?php
    include 'components/footer.php';
 ?>
</html>
