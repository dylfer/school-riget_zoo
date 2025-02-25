<?php
  include 'components/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link
      rel="icon"
      href="Black_and_White_Simple_Modern_Minimalist_Animals_Zoo_Station_Circle_Logo-removebg-preview.png"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>

    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-200 font-sans">
    <div class="bg-white shadow-md rounded-lg mx-4 my-8 md:mx-8 md:my-12">
      <div
        class="px-6 py-8 md:px-12 md:py-12 bg-cover bg-center h-[75dvh] flex flex-col justify-between"
        style="background-image: url('images/Homepage.jpg')"
      >
        <div class="text-center">
          <h1 class="text-3xl font-bold text-teal-500 mb-4">
            Rigets Zoo Adventure
          </h1>
          <p class="text-gray-50 mb-8">
            Experience the thrill of exploring our world-class zoo.
          </p>
        </div>
        <div class="text-center">
          <a
            href="tickets.php"
            class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-3 px-6 rounded-full inline-block"
            >Buy Tickets now</a
          >
        </div>
      </div>
      <div
        class="bg-teal-500 text-white px-6 py-8 md:px-12 md:py-12 rounded-b-lg"
      >
        <h2 class="text-2xl font-bold mb-4">A Quick About Us</h2>
        <p class="mb-4">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua.
        </p>
        <a
          href="about.php"
          class="bg-white hover:bg-gray-200 text-teal-500 font-bold py-3 px-6 rounded-full inline-block"
          >Find out more</a
        >
      </div>
    </div>

    <div class="relative mx-4 my-8 md:mx-8 md:my-12">
      <div class="flex flex-row gap-6 w-full overflow-hidden">
        <button
          class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-teal-500 text-white p-2 rounded-full z-10"
          onclick="scrollLeft()"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="48"
            height="48"
            viewBox="0 0 48 48"
          >
            <path
              fill="none"
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="4"
              d="M31 36L19 24l12-12"
            />
          </svg>
        </button>
        <div
          class="flex flex-row gap-6 w-full transition-transform duration-500"
          id="card-container"
        >
          <div class="bg-white shadow-md rounded-lg p-6 min-w-[300px]">
            <h3 class="text-xl font-bold text-teal-500 mb-4">
              Educational Visits
            </h3>
            <p class="text-gray-600 mb-4">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <a href="#" class="text-teal-500 hover:text-teal-600 font-bold"
              >Learn More</a
            >
          </div>
          <div class="bg-white shadow-md rounded-lg p-6 min-w-[300px]">
            <h3 class="text-xl font-bold text-teal-500 mb-4">Guided Tours</h3>
            <p class="text-gray-600 mb-4">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <a href="#" class="text-teal-500 hover:text-teal-600 font-bold"
              >Learn More</a
            >
          </div>
          <div class="bg-white shadow-md rounded-lg p-6 min-w-[300px]">
            <h3 class="text-xl font-bold text-teal-500 mb-4">
              Animal Experiences
            </h3>
            <p class="text-gray-600 mb-4">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <a href="#" class="text-teal-500 hover:text-teal-600 font-bold"
              >Learn More</a
            >
          </div>
          <div class="bg-white shadow-md rounded-lg p-6 min-w-[300px]">
            <h3 class="text-xl font-bold text-teal-500 mb-4">Zoo Membership</h3>
            <p class="text-gray-600 mb-4">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <a href="#" class="text-teal-500 hover:text-teal-600 font-bold"
              >Learn More</a
            >
          </div>
          <div class="bg-white shadow-md rounded-lg p-6 min-w-[300px]">
            <h3 class="text-xl font-bold text-teal-500 mb-4">Special Events</h3>
            <p class="text-gray-600 mb-4">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <a href="#" class="text-teal-500 hover:text-teal-600 font-bold"
              >Learn More</a
            >
          </div>
          <div class="bg-white shadow-md rounded-lg p-6 min-w-[300px]">
            <h3 class="text-xl font-bold text-teal-500 mb-4">
              Volunteer Programs
            </h3>
            <p class="text-gray-600 mb-4">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit.
            </p>
            <a href="#" class="text-teal-500 hover:text-teal-600 font-bold"
              >Learn More</a
            >
          </div>
        </div>
        <button
          class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-teal-500 text-white p-2 rounded-full z-10"
          onclick="scrollRight()"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="48"
            height="48"
            viewBox="0 0 48 48"
          >
            <path
              fill="none"
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="4"
              d="m19 12l12 12l-12 12"
            />
          </svg>
        </button>
      </div>
    </div>
  </body>
  <?php
    include 'components/footer.php';
  ?>

</html>
