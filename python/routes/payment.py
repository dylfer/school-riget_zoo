import os
from flask import Flask, jsonify, redirect, request, Blueprint
import stripe

stripe.api_key = os.getenv('STRIPE_KEY')

payment_router = Blueprint('Payment', __name__, url_prefix='/payment')

YOUR_DOMAIN = 'http://127.0.0.1:80'


@payment_router.route('/create-checkout-session', methods=['POST'])
def create_checkout_session():
    try:
        session = stripe.checkout.Session.create(
            ui_mode='embedded',
            line_items=[
                {
                    # Provide the exact Price ID (for example, pr_1234) of the product you want to sell
                    'price': '{{PRICE_ID}}',
                    'quantity': 1,
                },
            ],
            mode='payment',
            return_url=YOUR_DOMAIN + \
            '/return.html?session_id={CHECKOUT_SESSION_ID}',
        )
    except Exception as e:
        return str(e)

    return jsonify(clientSecret=session.client_secret)


@payment_router.route('/session-status', methods=['GET'])
def session_status():
    session = stripe.checkout.Session.retrieve(request.args.get('session_id'))

    return jsonify(status=session.status, customer_email=session.customer_details.email)
