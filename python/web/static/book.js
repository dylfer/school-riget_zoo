function price() {
  // TODO when complete use to cacl points
}

function calculatePoints() {
  return 50;
}

function updateBooking() {
  window.booking = {
    start_date: document.getElementById("checkIn").value,
    end_date: document.getElementById("checkOut").value,
    points: calculatePoints(),
    applyPoints: document.getElementById("usePoints").checked,
    adults: document.getElementById("adults").value,
    children: document.getElementById("children").value,
  };
  document.cookie = `booking=${JSON.stringify(window.booking)}; `;
}

function hash() {
  let basketHash = sha256(window.basket);
  let bookingHash = sha256(window.booking);
  document.cookie = `signiture=${sha256(basketHash + bookingHash)}; `;
}

function avalibility() {
  // TODO combind check in and out to one date range input
  // check avalible dates and ticket amount
}

function updateBasket() {
  // create update booking to set booking cookie for the rest of the vales
  const startDate = document.getElementById("checkIn");
  const endDate = document.getElementById("checkOut");
  const type = document.getElementById("roomType").value;
  const start = new Date(startDate.value);
  const end = new Date(endDate.value);
  const nights = (end - start) / (1000 * 60 * 60 * 24);
  window.basket = [{ type: "room", room: type, amount: 1, nights: nights }];
  document.cookie = `basket=${JSON.stringify(basket)}; `;
  window.location.href = "/checkout";
}

function update() {
  updateBasket();
  updateBooking();
  hash();
}

document.getElementById("pay").addEventListener("click", updateBasket);
