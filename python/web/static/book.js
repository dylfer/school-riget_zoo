function calculatePoints() {
  return 50;
}

function updateBooking() {}

function updateBasket() {
  // create update booking to set booking cookie for the rest of the vales
  const points = calculatePoints();
  const startDate = document.getElementById("checkIn");
  const endDate = document.getElementById("checkOut");
  const applyPoints = document.getElementById("usePoints").checked;
  const type = document.getElementById("roomType").value;
  const adults = document.getElementById("adults").value;
  const children = document.getElementById("children").value;
  const start = new Date(startDate.value);
  const end = new Date(endDate.value);
  const nights = (end - start) / (1000 * 60 * 60 * 24);
  const basket = [{ type: "room", room: type, amount: 1, nights: nights }];
  document.cookie = `basket=${JSON.stringify(basket)}; `;
  window.location.href = "/checkout";
}

document.getElementById("pay").addEventListener("click", updateBasket);
