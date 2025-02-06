from flask import request, jsonify
import jwt
from routes.auth import Define
from routes.genral import genral_router
from routes.payment import payment_router


def register_routes(app, DB):

    @app.before_request
    def before_request():
        if request.path in ['/dashboard', "/orders", "/settings", "/bookings"]:
            token = request.cookies.get('token')
            # if not token:
            #     return jsonify({'message': 'Missing token'}), 401
            # try:  # TODO get secret from db
            #     jwt.decode(token, 'secret', algorithms=['HS256'])
            # except jwt.ExpiredSignatureError:
            #     return jsonify({'message': 'Expired token'}), 401
            # except jwt.InvalidTokenError:
            #     return jsonify({'message': 'Invalid token'}), 401

    app.register_blueprint(Define(DB))
    app.register_blueprint(payment_router)
    app.register_blueprint(genral_router)
