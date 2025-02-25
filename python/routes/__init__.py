from flask import request, jsonify, render_template, make_response
from routes.auth import Define as Define_auth
from routes.genral import genral_router
from routes.payment import Define as Define_payment
from routes.book import Define as Define_book
from routes.rooms import room_router
from scripts.session import create, check, check_auth,clear

import jwt


def register_routes(app, DB):

    @app.before_request
    def before_request():
        if request.path.split('.')[-1] not in ['html', 'css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'ico']:
            session_id = request.cookies.get('session_id')
            if not session_id:
                session_id = create(DB, request.remote_addr, request.user_agent.string)
                response = make_response(render_template('base.html', content_template='index.html', title='Home'))
                response.set_cookie('session_id', session_id)
                response.headers['Refresh'] = '0; url=' + request.url
                response.status_code = 200
                return response, 200
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
            if request.path in ['/dashboard', "/tickets", "/settings", "/book"]:
                token = request.cookies.get('token')
                if not token:
                    response = jsonify({'message': 'Missing token'})
                    response.headers['Location'] = '/login'
                    response.status_code = 302
                    return response
                res,token_secret,_ = check_auth(DB, session_id, token)
                if not res:
                    response = jsonify({'message': 'Invalid authentication'})
                    response.delete_cookie('token')
                    response.delete_cookie('auth')
                    response.headers['Location'] = '/login'
                    response.status_code = 302
                    return response
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
    app.register_blueprint(Define_payment(DB))
    app.register_blueprint(genral_router)
    app.register_blueprint(room_router)
