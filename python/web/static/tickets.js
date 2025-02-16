const tickets = {
  adults: {
    value: 1,
    max: 40,
    min: 1,
  },
  children: {
    value: 0,
    max: 50,
    min: 0,
  },
};
// Point values
const POINTS_PER_ADULT = 273;
const POINTS_PER_CHILD = 118;

function incrementValue(id) {
  const display = document.getElementById(id);
  const currentValue = tickets[id].value;
  if (currentValue < tickets[id].max) {
    tickets[id].value = currentValue + 1;
    display.innerHTML = tickets[id].value;
  }
}

function decrementValue(id) {
  const display = document.getElementById(id);
  const currentValue = tickets[id].value;
  if (currentValue > tickets[id].min) {
    tickets[id].value = currentValue - 1;
    display.innerHTML = tickets[id].value;
  }
}

function price() {
  // TODO when complete use to cacl points
}

function calculatePoints() {
  const adults = tickets.adults.value || 1;
  const children = tickets.adults.value || 0;

  return adults * POINTS_PER_ADULT + children * POINTS_PER_CHILD;
}

function updateBasket() {
  window.basket = [
    { type: "ticket", ticket: "adult", amount: tickets.adults.value },
  ];
  if (tickets.children.value != 0) {
    basket.push({
      type: "ticket",
      ticket: "child",
      amount: tickets.children.value,
    });
  }
  document.cookie = `basket=${JSON.stringify(window.basket)}; `;
  window.location.href = "/checkout";
}

function updateBooking() {
  window.booking = {
    date: document.getElementById("checkIn").value,
    points: calculatePoints(),
    applyPoints: document.getElementById("usePoints").checked,
  };

  document.cookie = `booking=${JSON.stringify(window.booking)}; `;
}

function hash() {
  let basketHash = sha256(window.basket);
  let bookingHash = sha256(window.booking);
  document.cookie = `signiture=${sha256(basketHash + bookingHash)}; `;
}

function update() {
  updateBasket();
  updateBooking();
  hash();
}

function avalibility() {
  // check avalible dates and ticket amount
}

function accountPoints() {
  // get token and request if user has points then display the usepoints
}

document.getElementById("pay").addEventListener("click", update);
