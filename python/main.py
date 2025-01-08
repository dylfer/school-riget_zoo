from flask import Flask, request, jsonify
from routes import define_routes

app = Flask(__name__, static_url_path='',
            static_folder='static', template_folder='templates')


define_routes(app)

if __name__ == '__main__':
    app.run(debug=True, host="0.0.0.0", port=80)
