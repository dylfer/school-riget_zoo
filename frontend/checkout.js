// This is your test secret API key.
const stripe = Stripe(
  "pk_test_51Qk2Vf03GYTbO3NbKUpHQMU9vH9KGdvJe5u7R1RDRMKbeUDkZDwpCKKVaAw2If789FQ7wbmqUz3K0WxKg0MMze6900aNB6yd4C"
);

initialize();

// Create a Checkout Session
async function initialize() {
  const fetchClientSecret = async () => {
    const response = await fetch("/payment/create-checkout-session", {
      method: "POST",
    });
    const { clientSecret } = await response.json();
    return clientSecret;
  };

  const checkout = await stripe.initEmbeddedCheckout({
    fetchClientSecret,
  });

  // Mount Checkout
  checkout.mount("#checkout");
}
