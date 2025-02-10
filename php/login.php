<?php
include 'components/navbar.php';
include 'scripts/DB_conect.php';

// Function to sanitize user inputs
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize user inputs
    $username = sanitize_input($_POST['username']);
    $password = $_POST['password'];
    echo $username . " " . $password;
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start a new session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // If remember me is checked
            if (isset($_POST['remember']) && $_POST['remember'] == 'on') {
                // Set cookies for 30 days
                setcookie("user_login", $user['username'], time() + (30 * 24 * 60 * 60));
            }
            
            // Redirect to dashboard or home page
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Invalid password";
        }
    } else {
        $error_message = "User not found";
    }
    
    $stmt->close();
}

$conn->close();

// If there's an error, send it back to the login page
if (isset($error_message)) {
    $_SESSION['error'] = $error_message;
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link href="static/style.css" rel="stylesheet" />
    <link
      rel="icon"
      href="Black_and_White_Simple_Modern_Minimalist_Animals_Zoo_Station_Circle_Logo-removebg-preview.png"
    />
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body
    class="min-h-screen bg-cover bg-center"
    style="background-image: url('images/Login_bg.png')"
  >
  <div class="min-h-screen flex flex-col justify-center items-center gap-8">
    <?php
    if (isset($_SESSION['error'])) {
      if ($_SESSION['error']) {
        echo "<div class='error-message text-red-600 bg-gray-200 text-center w-fit p-8 rounded-lg'>" . $_SESSION['error'] . "</div>";
        unset($_SESSION['error']);
      }
    }
    ?>
    <script src="login.js"></script>
    <div class="login">
      <div class="w-96 bg-white bg-opacity-90 text-black rounded-lg p-8">
        <form action="login.php" method="POST">
          <h1 class="text-2xl text-center">Login</h1>
          <div>
            <img
              src="images/Black_and_White_Simple_Modern_Minimalist_Animals_Zoo_Station_Circle_Logo-removebg-preview.png"
              alt="Logo"
              class="block mx-auto w-3/5 h-auto"
            />
          </div>
          <div class="relative w-full h-12 my-8 rounded-full">
            <input
              type="text"
              placeholder=" "
              name="username"
              required
              class="input-login w-full p-1.5 rounded-lg border-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-300"
            />
            <span class="placholder-login bg-white text-gray-500 rounded-lg"
              >Username/email</span
            >
            <i
              class="bx bx-user absolute right-5 top-1/2 transform -translate-y-1/2 text-xl"
            ></i>
          </div>
          <div class="relative w-full h-12 my-8 rounded-full">
            <input
              type="password"
              placeholder=" "
              name="password"
              required
              class="input-login w-full p-1.5 rounded-lg border-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-300"
            />
            <span class="placholder-login bg-white text-gray-500 rounded-lg"
              >Password</span
            >
            <i
              class="bx bx-lock-alt absolute right-5 top-1/2 transform -translate-y-1/2 text-xl"
            ></i>
          </div>
          <div class="flex justify-between text-sm my-4">
            <label class="flex items-center"
              ><input type="checkbox" class="accent-black mr-1.5" name="remember" />Remember
              me</label
            >
            <a href="forgotpassword.php" class="text-green-700 hover:underline"
              >Forgot password?</a
            >
          </div>
          <button
            type="submit"
            class="w-full h-11 bg-white border-none rounded-full shadow-md cursor-pointer text-base font-semibold text-black my-5"
          >
            Login
          </button>
          <div class="text-sm text-center my-5">
            <p>
              Don't have an account?
              <a
                href="signup.php"
                class="text-black font-semibold hover:underline"
                >Signup</a
              >
            </p>
          </div>
        </form>
      </div>
    </div>
</div>
  </body>
  <?php
    include 'components/footer.php';
?>
</html>
