<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="Black_and_White_Simple_Modern_Minimalist_Animals_Zoo_Station_Circle_Logo-removebg-preview.png"/>
    <title>Educational Visit</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="bg-gradient-to-br from-green-50 to-blue-50 min-h-screen">
    <main class="container mx-auto px-4 py-12 max-w-7xl">
        <!-- Main Image Section -->
        <section class="mb-12 relative">
            <div class="w-full aspect-video bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-green-600/90 to-blue-600/90 flex items-center justify-center">
                    <div class="text-center text-white">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">Discover Wildlife</h1>
                        <p class="text-xl md:text-2xl opacity-90">Experience nature's wonders up close</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Title Section -->
        <h2 class="text-3xl font-bold mb-8 text-gray-800 flex items-center">
            <span class="mr-3">Everything you need to know</span>
            <div class="h-1 flex-grow bg-gradient-to-r from-green-500 to-blue-500 rounded-full"></div>
        </h2>

        <!-- Information Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="aspect-video bg-green-100 relative">
                    <i class="fa fa-clock-o absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-4xl text-green-600"></i>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-2 text-gray-800">Opening Hours</h3>
                    <p class="text-gray-600">Mon - Sun: 9:00 AM - 6:00 PM</p>
                    <p class="text-gray-600">Last entry: 5:00 PM</p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="aspect-video bg-blue-100 relative">
                    <i class="fa fa-ticket absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-4xl text-blue-600"></i>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-2 text-gray-800">Admission</h3>
                    <p class="text-gray-600">Adults: £25</p>
                    <p class="text-gray-600">Children: £15</p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                <div class="aspect-video bg-yellow-100 relative">
                    <i class="fa fa-map-marker absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-4xl text-yellow-600"></i>
                </div>
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-2 text-gray-800">Location</h3>
                    <p class="text-gray-600">123 Zoo Avenue</p>
                    <p class="text-gray-600">Nature City, NC 12345</p>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
              <div class="aspect-video bg-purple-100 relative">
                  <i class="fa fa-calendar absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-4xl text-purple-600"></i>
              </div>
              <div class="p-6">
                  <h3 class="font-bold text-lg mb-2 text-gray-800">Events</h3>
                  <p class="text-gray-600">Daily animal talks</p>
                  <p class="text-gray-600">Feeding demonstrations</p>
              </div>
            </div>
            

        <!-- Call to Action -->
        <div class="mt-12 text-center">
            <button class="bg-blue-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:shadow-lg transform transition-all duration-300 hover:-translate-y-1">
                Plan Your Visit
            </button>
        </div>
    </main>
</body>
</html>