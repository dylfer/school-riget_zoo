<?php
session_start();
include 'components/navbar.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize user inputs
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $visit_date = $_POST['visit_date'];
    $adults = intval($_POST['adults']);
    $children = intval($_POST['children']);
    $use_points = isset($_POST['use_points']) ? 1 : 0;

    // Store ticket information in session
    $_SESSION['ticket'] = [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'visit_date' => $visit_date,
        'adults' => $adults,
        'children' => $children,
        'use_points' => $use_points
    ];

    // Redirect to checkout.php
    header("Location: checkout.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ticket Page</title>
    <link
      rel="icon"
      href="images/Black_and_White_Simple_Modern_Minimalist_Animals_Zoo_Station_Circle_Logo-removebg-preview.png"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body
    class="min-h-screen bg-[url('images/book-bg.png')] bg-no-repeat bg-cover bg-fixed "
  >
  <div class="min-h-screen flex items-center justify-center">
    <section
      class="bg-white/80 rounded-lg p-8 max-w-2xl shadow-lg relative w-full mx-4"
    >
      <!-- Logo -->
      <div class="absolute top-8 right-8">
        <img
          src="images/Black_and_White_Simple_Modern_Minimalist_Animals_Zoo_Station_Circle_Logo-removebg-preview.png"
          alt="Logo"
          class="w-16 h-16 object-contain"
        />
      </div>

      <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">
        Book your visit
      </h1>

      <!-- Points Display -->
      <div class="mb-6 p-4 bg-blue-50 rounded-lg">
        <p class="text-blue-800 font-semibold text-center">
          Points you will earn: <span id="pointsDisplay">50</span>
        </p>
      </div>

      <form class="space-y-6" id="ticketForm" action="tickets.php" method="POST">
        <div class="grid grid-cols-2 gap-6">
          <!-- First Name & Last Name -->
          <div class="flex items-center gap-2">
            <input
              type="text"
              id="firstName"
              name="first_name"
              class="flex-1 p-2 border rounded-lg"
              placeholder="First Name"
              required
            />
          </div>
          <div class="flex items-center gap-2">
            <input
              type="text"
              id="lastName"
              name="last_name"
              class="flex-1 p-2 border rounded-lg"
              placeholder="Last Name"
              required
            />
          </div>
        </div>

        <!-- Visit Date -->
        <div>
          <label class="block text-gray-700 mb-2" for="checkIn">Visit Date</label>
          <input
            type="date"
            id="checkIn"
            name="visit_date"
            class="w-full p-2 border rounded-lg"
            required
          />
        </div>
        <!-- Number of Adults & Children -->
        <div class="space-y-4">
          <div class="flex items-center gap-2">
            <label class="text-gray-700 w-96">Number of Adult Tickets</label>
            <div class="ml-4 flex items-center gap-4">
              <button
                type="button"
                onclick="decrementValue('adults')"
                class="w-10 h-10 rounded-lg bg-gray-200 text-gray-600 hover:bg-gray-300 flex items-center justify-center text-xl font-bold"
              >
                -
              </button>
              <input
                type="number"
                id="adults"
                name="adults"
                min="1"
                value="1"
                max="40"
                class="w-20 p-2 border rounded-lg text-center"
                required
              />
              <button
                type="button"
                onclick="incrementValue('adults')"
                class="w-10 h-10 rounded-lg bg-gray-200 text-gray-600 hover:bg-gray-300 flex items-center justify-center text-xl font-bold"
              >
                +
              </button>
            </div>
          </div>

          <div class="flex items-center gap-2">
            <label class="text-gray-700 w-96">Number of Children Tickets</label>
            <div class="ml-4 flex items-center gap-4">
              <button
                type="button"
                onclick="decrementValue('children')"
                class="w-10 h-10 rounded-lg bg-gray-200 text-gray-600 hover:bg-gray-300 flex items-center justify-center text-xl font-bold"
              >
                -
              </button>
              <input
                type="number"
                id="children"
                name="children"
                min="0"
                value="0"
                max="300"
                class="w-20 p-2 border rounded-lg text-center"
                required
              />
              <button
                type="button"
                onclick="incrementValue('children')"
                class="w-10 h-10 rounded-lg bg-gray-200 text-gray-600 hover:bg-gray-300 flex items-center justify-center text-xl font-bold"
              >
                +
              </button>
            </div>
          </div>
        </div>

        <!-- Points Redemption -->
        <div class="flex items-center space-x-2 bg-green-50 p-4 rounded-lg">
          <input type="checkbox" id="usePoints" name="use_points" class="w-4 h-4 text-blue-600">
          <label for="usePoints" class="text-gray-700">
            Use available points for discount (100 points = £1 off)
          </label>
        </div>

        <!-- Submit Button -->
        <button
          type="submit"
          class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors"
        >
          Add to basket
        </button>
      </form>
    </section>
    </div>
  </body>
  <?php
    include 'components/footer.php';
  ?>
</html>