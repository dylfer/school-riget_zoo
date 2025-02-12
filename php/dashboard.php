<?php
    include 'components/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body class="bg-white min-h-screen">
  <div class="min-h-screen">
  <div class="container mx-auto my-auto px-4 py-8">
    <div class="bg-gradient-to-br from-gray-50 to-gray-200 p-2 sm:p-12 rounded-lg ">
      <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard</h1>
      <div class="grid md:grid-cols-2 gap-8">
        <!-- Welcome Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
          <div class="p-6 bg-blue-50">
            <div class="flex justify-between items-center">
              <h2 class="text-2xl font-bold text-gray-800">Welcome, User</h2>
              <a href="settings.php"><button class="text-gray-600 hover:text-gray-800 transition">
                <i class="fas fa-cog text-xl"></i>
              </button></a>
            </div>
          </div>
          <div class="p-6">
            <div class="bg-gray-100 rounded-lg p-4 max-h-80 overflow-y-auto">
              <h3 class="text-lg font-semibold text-gray-700 mb-4">Your Bookings</h3>
              <div class="divide-y divide-gray-200">
                <div class="grid grid-cols-4 gap-2 py-2 text-sm auto-rows-[h-fit]">
                  <p class="font-bold text-gray-600">Type</p>
                  <p class="font-bold text-gray-600">Date</p>
                  <p class="font-bold text-gray-600">Quantity</p>
                  <p class="font-bold text-gray-600">Ticket Type</p>
                  
                  <p>Zoo</p>
                  <p>27.03.25 - 28.03.25</p>
                  <p>4</p>
                  <p>Single</p>
                  
                  <p>Hotel</p>
                  <p>27.03.25 - 31.03.25</p>
                  <p>1</p>
                  <p>Family Room</p>
                  
                  <p>Zoo</p>
                  <p>27.03.25 - 28.03.25</p>
                  <p>2</p>
                  <p>Single</p>
                  
                  <p>Hotel</p>
                  <p>27.03.25 - 31.03.25</p>
                  <p>1</p>
                  <p>Family Room</p>
                </div>
                
              </div>
            </div>
          </div>
        </div>
        
        <!-- Donations Card -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
          <div class="p-6 bg-green-50">
            <h2 class="text-2xl font-bold text-gray-800">Donation Impact</h2>
          </div>
          <div class="p-6 space-y-6">
            <div>
              <p class="text-4xl font-bold text-green-600 mb-2">£12.60</p>
              <p class="text-gray-600">Every £1 helps save 1 animal</p>
              <p class="text-sm text-gray-500">Donations are appreciated but not required</p>
            </div>
            <div class="grid grid-cols-2 gap-4">
              <div>
                <p class="font-semibold text-gray-700">Points to Spend</p>
                <p class="text-2xl font-bold text-blue-600">360</p>
              </div>
              <div>
                <p class="font-semibold text-gray-700">Total Points</p>
                <p class="text-2xl font-bold text-green-600">1450</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<?php
    include 'components/footer.php';
?>
</html>