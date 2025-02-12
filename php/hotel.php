<?php
    include 'components/navbar.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Rooms</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gradient-to-br from-orange-50 to-orange-200 min-h-screen">
    <div class="min-h-screen container mx-auto max-w-4xl px-4 py-12">
      <h1 class="text-center font-bold text-4xl md:text-5xl text-gray-800 mb-12 border-b-4 border-orange-400 pb-4">
        View Our Hotel Rooms
      </h1>
      <div class="space-y-8">
        <!-- Single Room Card -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden transform transition hover:scale-[1.02] hover:shadow-xl">
          <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 h-64 md:h-auto">
              <img
                class="w-full h-full object-cover"
                src="images/Single.png"
                alt="Single Room"
              />
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between">
              <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Single Room</h2>
                <p class="text-gray-600 mb-4">
                  Cozy and comfortable single room perfect for solo travelers. Enjoy modern amenities and a peaceful retreat after a day of exploration.
                </p>
              </div>
              <div class="flex justify-between items-center">
                <div>
                  <p class="text-gray-600">Capacity: 2 People</p>
                  <p class="text-xl font-semibold text-orange-600">£70 per night</p>
                </div>
                <button class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition">
                  Book Now
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Double Room Card -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden transform transition hover:scale-[1.02] hover:shadow-xl">
          <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 h-64 md:h-auto">
              <img
                class="w-full h-full object-cover"
                src="images/double.png"
                alt="Double Room"
              />
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between">
              <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Double Room</h2>
                <p class="text-gray-600 mb-4">
                  Spacious double room ideal for couples or friends. Featuring comfortable beds and stunning interior design.
                </p>
              </div>
              <div class="flex justify-between items-center">
                <div>
                  <p class="text-gray-600">Capacity: 4 People</p>
                  <p class="text-xl font-semibold text-orange-600">£85 per night</p>
                </div>
                <button class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition">
                  Book Now
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Family Room Card -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden transform transition hover:scale-[1.02] hover:shadow-xl">
          <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 h-64 md:h-auto">
              <img
                class="w-full h-full object-cover"
                src="images/family.png"
                alt="Family Room"
              />
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between">
              <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Family Room</h2>
                <p class="text-gray-600 mb-4">
                  Generous family room with ample space for everyone. Includes multiple beds and family-friendly amenities.
                </p>
              </div>
              <div class="flex justify-between items-center">
                <div>
                  <p class="text-gray-600">Capacity: 5 People</p>
                  <p class="text-xl font-semibold text-orange-600">£100 per night</p>
                </div>
                <button class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition">
                  Book Now
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Suite Room Card -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden transform transition hover:scale-[1.02] hover:shadow-xl">
          <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 h-64 md:h-auto">
              <img
                class="w-full h-full object-cover"
                src="images/suite.png"
                alt="Suite Room"
              />
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between">
              <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Suite Room</h2>
                <p class="text-gray-600 mb-4">
                  Luxurious suite with premium amenities and expansive living space. Perfect for large groups or special occasions.
                </p>
              </div>
              <div class="flex justify-between items-center">
                <div>
                  <p class="text-gray-600">Capacity: 10 People</p>
                  <p class="text-xl font-semibold text-orange-600">£200 per night</p>
                </div>
                <button class="bg-orange-500 text-white px-6 py-2 rounded-md hover:bg-orange-600 transition">
                  Book Now
                </button>
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