import os
from flask import Flask, jsonify, redirect, request, Blueprint
import stripe
import json
import hashlib
from scripts.session import check_auth





YOUR_DOMAIN = 'http://127.0.0.1'


discounts = ["qoqi1SMnj9tKTcoMAyKdJELrzb1yMaQYpw63ieBMB8M0AY2VvRJI0EfZSQyrW5VDdEtPfw","7zxWzKQDqWrqgPT2QcHUz0nSnmXWBcEYo3Q8MPOiF6qNlXBU6QiFOzRM5X5wwo7yh0J85U","qkScGzbJuGcXxhJUoSt56lxPD5asNk9Jx3qkBUo17Kxa3MQQmGtboaOVIuct16VSeiPOit","QRAOsOkOpqPvpmbbilPyyMCNLtrnAROtChjuj9uUt6YtK8bHgiOviRevoVp2DrrsWpg7oF","JYNgvcuEB6WBlcFmHdbgbfdQHKy1dx5uNojhGxmorPVrMT4aHMe0RBMBVZOkrvQZsAbw58","2i2TzWk9WP78L6NBulalU6uW4JQBdOBn6DNAgPhUKZNRvZ4TlCwSofpU5oEqZfBJul93na"]
rooms = {
    "single": [{"unit_amount":7000,"product":"prod_Rdf2dSsmr2PX7Z"}, {"unit_amount":13000,"product":"prod_Rdf2dSsmr2PX7Z"}, {"unit_amount":20000,"product":"prod_Rdf2dSsmr2PX7Z"}, {"unit_amount":30000,"product":"prod_Rdf2dSsmr2PX7Z"}, {"unit_amount":40000,"product":"prod_Rdf2dSsmr2PX7Z"},{"unit_amount":60000,"product":"prod_Rdf2dSsmr2PX7Z"}],
    "double": [{"unit_amount":8500,"product":"prod_Rdf507HCmznypm"}, {"unit_amount":16000,"product":"prod_Rdf507HCmznypm"}, {"unit_amount":25000,"product":"prod_Rdf507HCmznypm"}, {"unit_amount":35000,"product":"prod_Rdf507HCmznypm"}, {"unit_amount":50000,"product":"prod_Rdf507HCmznypm"}, {"unit_amount":65000,"product":"prod_Rdf507HCmznypm"}],
    "family": [{"unit_amount":10000,"product":"prod_Rdf8BA17EFe3cO"}, {"unit_amount":19000,"product":"prod_Rdf8BA17EFe3cO"}, {"unit_amount":29000,"product":"prod_Rdf8BA17EFe3cO"}, {"unit_amount":42000,"product":"prod_Rdf8BA17EFe3cO"}, {"unit_amount":55000,"product":"prod_Rdf8BA17EFe3cO"}, {"unit_amount":70000,"product":"prod_Rdf8BA17EFe3cO"}],
    "suite": [{"unit_amount":20000,"product":"prod_RdfF0hJUtB0Oqr"}, {"unit_amount":39000,"product":"prod_RdfF0hJUtB0Oqr"}, {"unit_amount":59000,"product":"prod_RdfF0hJUtB0Oqr"}, {"unit_amount":85000,"product":"prod_RdfF0hJUtB0Oqr"}, {"unit_amount":115000,"product":"prod_RdfF0hJUtB0Oqr"}, {"unit_amount":145000,"product":"prod_RdfF0hJUtB0Oqr"}]
}
ticket = {
    "adult": "price_1QpdYg03GYTbO3Nbm94ieSrf",
    "child" : "price_1QpdZV03GYTbO3NbH66TFJSn"
}

def sha256_hash(data):
            return hashlib.sha256(data.encode()).hexdigest()

def Define(DB):
    stripe.api_key = os.getenv('STRIPE_KEY')
    payment_router = Blueprint('Payment', __name__, url_prefix='/payment')
    @payment_router.route('/create-checkout-session', methods=['POST'])
    def create_checkout_session():
        basket = request.cookies.get("basket")
        booking = request.cookies.get("booking")
        signiture = request.cookies.get("signiture")
        metaData = {"booking": booking, "basket": basket, "signiture": signiture}
        items = []
        if basket is not None:
            basket = json.loads(basket)
        
            # TODO get token and get points and if points are aplied 
            # TODO add point discount to total
            for item in basket:
                if item["type"] == "room":
                    price_data = rooms[item["room"]][item["nights"]-1]
                    price_data.update({"currency": "gbp"})
                    items.append(
                        {"price_data": price_data, "quantity": item["amount"]})
                else:
                    items.append(
                        {"price": ticket[item["ticket"]], "quantity": item["amount"]})
        try:
            print(items)
            session = stripe.checkout.Session.create(
                ui_mode='embedded',
                line_items=items,
                mode='payment',
                submit_type='book',
                return_url=YOUR_DOMAIN +
                '/return?session_id={CHECKOUT_SESSION_ID}',
                metadata=metaData
            )
        except Exception as e:
            return str(e)

        return jsonify(clientSecret=session.client_secret)


    @payment_router.route('/session-status', methods=['GET'])
    def session_status():
        session = stripe.checkout.Session.retrieve(request.args.get('session_id'))
        if session.payment_status == "complete":
            session_id = request.cookies.get("session_id")
            basket = session.metadata.get("basket")
            booking = session.metadata.get("booking")
            signiture = session.metadata.get("signiture")
            cookie_signiture = request.cookies.get("signiture")
            # this validate the data so it can't have been tampered with
            if cookie_signiture != signiture:
                return jsonify({"error": "Invalid cookie hash"}), 400
            basket_hash = sha256_hash(basket)
            booking_hash = sha256_hash(booking)
            expected_signiture = sha256_hash(basket_hash + booking_hash)
            if cookie_signiture != expected_signiture:
                return jsonify({"error": "Invalid cookie hash"}), 400
            points = session.amount_total * 2.38
            _,_,user_id = check_auth(DB, session_id, request.cookies.get("token"))
            DB.update("users",f"points={points}",f"id =  {user_id}")
            if basket.get("type") == "room":
                if basket[0]["type"] == "room":# TODO fillin the sql with corect data
                    DB.insert("hotel_bookings", (basket[0]["room"], basket[0]["nights"], basket[0]["amount"], user_id), ["room", "nights", "amount", "user_id"])
                else:
                    DB.insert("zoo_bookings", (basket[0]["ticket"], 1, basket[0]["amount"], user_id), ["ticket", "nights", "amount", "user_id"])
            # TODO email booking to user 
            # TODO insert into payments table
            # TODO update checkout sesion so this requesct cant dupe the booking 
        print(session)

        return jsonify(status=session.status, customer_email=session.customer_details.email)
    return payment_router
