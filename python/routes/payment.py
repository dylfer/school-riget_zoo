import os
from flask import Flask, jsonify, redirect, request, Blueprint
import stripe
import json

stripe.api_key = os.getenv('STRIPE_KEY')

payment_router = Blueprint('Payment', __name__, url_prefix='/payment')

YOUR_DOMAIN = 'http://127.0.0.1'

rooms = {
    "single": ["price_1QkNi703GYTbO3NbU35BkI2K", "price_1QkOJZ03GYTbO3NbuGBhvlSF", "price_1QkOXB03GYTbO3NbmmSUcrS0", "price_1QkOXv03GYTbO3NbVlkFhbEe", "price_1QkOYN03GYTbO3NblHoEkUo7", "price_1QkOZT03GYTbO3Nbcz6cwQ7V"],
    "double": ["price_1QkNli03GYTbO3NbRK04BH1M", "price_1QkOIw03GYTbO3NbyN4JzLdC", "price_1QkOcU03GYTbO3NbwlQpmANF", "price_1QkOco03GYTbO3NbGdljCl7J", "price_1QkOdZ03GYTbO3NbEJv3avSV", "price_1QkOdo03GYTbO3NblTnH8NVm"],
    "family": ["price_1QkNnq03GYTbO3NbZHgceQUi", "price_1QkOAA03GYTbO3NbRIFCHimM", "price_1QkOg403GYTbO3NbksEWivVX", "price_1QkOgU03GYTbO3NbpXYjdgN5", "price_1QkOgw03GYTbO3NbBJBv89RH", "price_1QkOhL03GYTbO3Nbqt291Fce"],
    "suite": ["price_1QkNv503GYTbO3Nb9En854AP", "price_1QkO9I03GYTbO3NbKlYabqGh", "price_1QkOjl03GYTbO3NbvRHT48MY", "price_1QkOkB03GYTbO3NbVIWD8DMC", "price_1QkOkg03GYTbO3NbTs5VtLXA", "price_1QkOl603GYTbO3NbKCXgi7op"]
}


@payment_router.route('/create-checkout-session', methods=['POST'])
def create_checkout_session():
    basket = json.loads(request.cookies.get("basket"))
    items = []
    print(type(basket))
    for item in basket:

        items.append(
            {"price": rooms[item["type"]][item["nights"]-1], "quantity": item["amount"]})
    try:
        session = stripe.checkout.Session.create(
            ui_mode='embedded',
            line_items=items,
            mode='payment',
            return_url=YOUR_DOMAIN +
            '/return.html?session_id={CHECKOUT_SESSION_ID}',
        )
    except Exception as e:
        return str(e)

    return jsonify(clientSecret=session.client_secret)


@payment_router.route('/session-status', methods=['GET'])
def session_status():
    session = stripe.checkout.Session.retrieve(request.args.get('session_id'))

    return jsonify(status=session.status, customer_email=session.customer_details.email)
