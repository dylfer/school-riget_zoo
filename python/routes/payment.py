import os
from flask import Flask, jsonify, redirect, request, Blueprint
import stripe
import json

stripe.api_key = os.getenv('STRIPE_KEY')

payment_router = Blueprint('Payment', __name__, url_prefix='/payment')

YOUR_DOMAIN = 'http://127.0.0.1'

rooms = {
    "single": [{"unit_amount":70,"product":"prod_Rdf2dSsmr2PX7Z"}, {"unit_amount":130,"product":"prod_Rdf2dSsmr2PX7Z"}, {"unit_amount":200,"product":"prod_Rdf2dSsmr2PX7Z"}, {"unit_amount":300,"product":"prod_Rdf2dSsmr2PX7Z"}, {"unit_amount":400,"product":"prod_Rdf2dSsmr2PX7Z"},{"unit_amount":600,"product":"prod_Rdf2dSsmr2PX7Z"}],
    "double": [{"unit_amount":85,"product":"prod_Rdf507HCmznypm"}, {"unit_amount":160,"product":"prod_Rdf507HCmznypm"}, {"unit_amount":250,"product":"prod_Rdf507HCmznypm"}, {"unit_amount":350,"product":"prod_Rdf507HCmznypm"}, {"unit_amount":500,"product":"prod_Rdf507HCmznypm"}, {"unit_amount":650,"product":"prod_Rdf507HCmznypm"}],
    "family": [{"unit_amount":100,"product":"prod_Rdf8BA17EFe3cO"}, {"unit_amount":190,"product":"prod_Rdf8BA17EFe3cO"}, {"unit_amount":290,"product":"prod_Rdf8BA17EFe3cO"}, {"unit_amount":420,"product":"prod_Rdf8BA17EFe3cO"}, {"unit_amount":550,"product":"prod_Rdf8BA17EFe3cO"}, {"unit_amount":700,"product":"prod_Rdf8BA17EFe3cO"}],
    "suite": [{"unit_amount":200,"product":"prod_RdfF0hJUtB0Oqr"}, {"unit_amount":390,"product":"prod_RdfF0hJUtB0Oqr"}, {"unit_amount":590,"product":"prod_RdfF0hJUtB0Oqr"}, {"unit_amount":850,"product":"prod_RdfF0hJUtB0Oqr"}, {"unit_amount":1150,"product":"prod_RdfF0hJUtB0Oqr"}, {"unit_amount":1450,"product":"prod_RdfF0hJUtB0Oqr"}]
}


@payment_router.route('/create-checkout-session', methods=['POST'])
def create_checkout_session():
    basket = json.loads(request.cookies.get("basket"))
    items = []
    # TODO get token and get points and if points are aplied 
    for item in basket:

        items.append(
            {"price_data": rooms[item["type"]][item["nights"]-1], "quantity": item["amount"]})
    try:
        session = stripe.checkout.Session.create(
            ui_mode='embedded',
            line_items=items,
            mode='payment',
            return_url=YOUR_DOMAIN +
            '/return?session_id={CHECKOUT_SESSION_ID}',
        )
    except Exception as e:
        return str(e)

    return jsonify(clientSecret=session.client_secret)


@payment_router.route('/session-status', methods=['GET'])
def session_status():
    session = stripe.checkout.Session.retrieve(request.args.get('session_id'))

    return jsonify(status=session.status, customer_email=session.customer_details.email)
