from flask import request, jsonify
from routes.auth import Define as Define_auth
from routes.genral import genral_router
from routes.payment import payment_router
from routes.book import Define as Define_book
from routes.rooms import room_router
from scripts.session import create, check, check_auth,clear
import jwt


def register_routes(app, DB):

    @app.before_request
    def before_request():
        session_id = request.cookies.get('session_id')
        if not session_id:
            session_id = create(DB, request.remote_addr, request.user_agent.string)
            response = jsonify({'message': 'create session'})
            response.set_cookie('session_id', session_id)
            return response, 102
        if not check(DB, session_id, request.remote_addr, request.user_agent.string):
            clear(DB, session_id)
            response = jsonify({'message': 'ip address or user agent changed'})
            response.delete_cookie('session_id')
            response.delete_cookie('token')
            response.set_cookie('auth', 'false')
            session_id = create(DB, request.remote_addr, request.user_agent.string)
            response.set_cookie('session_id', session_id)
            response.headers['Location'] = '/login'
            response.status_code = 302
            return response
        if request.path in ['/dashboard', "/orders", "/settings", "/bookings"]:
            token = request.cookies.get('token')
            if not token:
                return jsonify({'message': 'Missing token'}), 401
            token_secret = check_auth(DB, session_id, token)
            
            try: 
                jwt.decode(token, token_secret, algorithms=['HS256'])
            except jwt.ExpiredSignatureError:
                clear(DB, session_id)
                response = jsonify({'message': 'Expired token'})
                response.delete_cookie('token')
                response.delete_cookie('session_id')
                response.set_cookie('auth', 'false')
                session_id = create(DB, request.remote_addr, request.user_agent.string)
                response.set_cookie('session_id', session_id)
                response.headers['Location'] = '/login'
                response.status_code = 302
                return response
            except jwt.InvalidTokenError:
                clear(DB, session_id)
                response = jsonify({'message': 'Invalid token'})
                response.delete_cookie('token')
                response.delete_cookie('session_id')
                response.set_cookie('auth', 'false')
                session_id = create(DB, request.remote_addr, request.user_agent.string)
                response.set_cookie('session_id', session_id)
                response.headers['Location'] = '/login'
                response.status_code = 302
                return response


    app.register_blueprint(Define_auth(DB))
    app.register_blueprint(Define_book(DB))
    app.register_blueprint(payment_router)
    app.register_blueprint(genral_router)
    app.register_blueprint(room_router)
