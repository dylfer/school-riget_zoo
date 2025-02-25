<?php
  include 'components/navbar.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $adults = $_POST['adults'];
    $children = $_POST['children'];
    $room_type = $_POST['room_type'];
    $use_points = isset($_POST['use_points']) ? 1 : 0;

    include 'scripts/DB_conect.php';

    // Check if the room type is available
    $sql = "SELECT COUNT(*) as count FROM hotel_bookings WHERE type = ? AND cleaned = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $room_type);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
      // Redirect to checkout.php
      header("Location: checkout.php?room_type=$room_type&check_in_date=$check_in_date&check_out_date=$check_out_date");
      exit();
    } else {
      echo "<script>Swal.fire('Sorry', 'The selected room type is not available. Please choose another type.', 'error');</script>";
    }

    $stmt->close();
    $conn->close();
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking Page</title>
    <link rel="icon" href="Black_and_White_Simple_Modern_Minimalist_Animals_Zoo_Station_Circle_Logo-removebg-preview.png"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
  <body class="min-h-screen bg-[url('book-bg.png')] bg-no-repeat bg-cover bg-fixed">
    <div class="min-h-screen flex items-center justify-center">
    <section class="bg-white/60 rounded-lg p-8 max-w-2xl shadow-lg relative w-full mx-4">
      <!-- Logo -->
      <div class="absolute top-8 right-8">
        <img src="images/Black_and_White_Simple_Modern_Minimalist_Animals_Zoo_Station_Circle_Logo-removebg-preview.png" 
             alt="Logo" 
             class="w-16 h-16 object-contain">
      </div>

      <h1 class="text-3xl font-bold mb-8 text-center text-gray-800">Book your visit</h1>
      
      <!-- Points Display -->
      <div class="mb-6 p-4 bg-blue-50 rounded-lg">
        <p class="text-blue-800 font-semibold text-center">
          Points you will earn: <span id="pointsDisplay">0</span>
        </p>
      </div>

      <form class="space-y-6" id="bookingForm" action="book.php" method="POST">
        <div class="grid grid-cols-2 gap-6">
          <!-- First Name & Last Name -->
          <div>
            <label class="block text-gray-700 mb-2" for="firstName">First Name</label>
            <input type="text" id="firstName" name="first_name" class="w-full p-2 border rounded-lg" required>
          </div>
          <div>
            <label class="block text-gray-700 mb-2" for="lastName">Last Name</label>
            <input type="text" id="lastName" name="last_name" class="w-full p-2 border rounded-lg" required>
          </div>
          
          <!-- Check in & Check out dates -->
          <div>
            <label class="block text-gray-700 mb-2" for="checkIn">Check in date</label>
            <input type="date" id="checkIn" name="check_in_date" class="w-full p-2 border rounded-lg" required>
          </div>
          <div>
            <label class="block text-gray-700 mb-2" for="checkOut">Check out date</label>
            <input type="date" id="checkOut" name="check_out_date" class="w-full p-2 border rounded-lg" required>
          </div>
          
          <!-- Number of guests & children -->
          <div>
            <label class="block text-gray-700 mb-2" for="adults">Number of Adults</label>
            <input type="number" id="adults" name="adults" min="1" value="1" class="w-full p-2 border rounded-lg" required>
          </div>
          <div>
            <label class="block text-gray-700 mb-2" for="children">Number of Children</label>
            <input type="number" id="children" name="children" min="0" value="0" class="w-full p-2 border rounded-lg" required>
          </div>
        </div>
        
        <!-- Room Type -->
        <div>
          <label class="block text-gray-700 mb-2" for="roomType">Room Type</label>
          <select id="roomType" name="room_type" class="w-full p-2 border rounded-lg" required>
            <option value="">Select a room type</option>
            <option value="standard">Single Room</option>
            <option value="deluxe">Double Room</option>
            <option value="suite">Suite</option>
            <option value="family">Family Room</option>
          </select>
        </div>

        <!-- Points Redemption -->
        <div class="flex items-center space-x-2 bg-green-50 p-4 rounded-lg">
          <input type="checkbox" id="usePoints" name="use_points" class="w-4 h-4 text-blue-600">
          <label for="usePoints" class="text-gray-700">
            Use available points for discount (1000 points = £1 off)
          </label>
        </div>
        
        <!-- Submit Button -->
        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors">
          Submit Booking
        </button>
      </form>
    </section>

    <script>
      // Point values
      const POINTS_PER_ADULT = 50;
      const POINTS_PER_CHILD = 25;

      // Get DOM elements
      const adultsInput = document.getElementById('adults');
      const childrenInput = document.getElementById('children');
      const pointsDisplay = document.getElementById('pointsDisplay');
      const form = document.getElementById('bookingForm');
      const usePointsCheckbox = document.getElementById('usePoints');
      const pointsToRedeemInput = document.getElementById('pointsToRedeem');

      // Function to calculate total points
      function calculatePoints() {
        const adults = parseInt(adultsInput.value) || 0;
        const children = parseInt(childrenInput.value) || 0;
        
        const totalPoints = (adults * POINTS_PER_ADULT) + (children * POINTS_PER_CHILD);
        pointsDisplay.textContent = totalPoints;
      }

      // Toggle points redemption input
      usePointsCheckbox.addEventListener('change', function() {
        pointsToRedeemInput.disabled = !this.checked;
        if (!this.checked) {
          pointsToRedeemInput.value = '';
        }
      });

      // Add event listeners
      adultsInput.addEventListener('input', calculatePoints);
      childrenInput.addEventListener('input', calculatePoints);

      // Calculate initial points
      calculatePoints();

      // Handle form submission
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        const pointsEarned = pointsDisplay.textContent;
        const pointsRedeemed = usePointsCheckbox.checked ? pointsToRedeemInput.value : 0;
        const discount = pointsRedeemed / 100; // £1 per 100 points
        
      });
    </script>
    </div>
  </body>
<?php
    include 'components/footer.php';
?>
</html>