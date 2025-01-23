from flask import Flask, request, jsonify
from routes import register_routes
from dotenv import load_dotenv

load_dotenv()


app = Flask(__name__, static_url_path='',
            static_folder='../frontend', template_folder='../frontend')


register_routes(app)

if __name__ == '__main__':
    app.run(debug=True, host="0.0.0.0", port=80)
