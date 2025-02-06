import sys
import os
from flask import Flask, request, jsonify
from routes import register_routes
from dotenv import load_dotenv

# Add the parent directory to sys.path
sys.path.append(os.path.abspath(os.path.join(os.path.dirname(__file__), '..')))

from database import DataBace  # Changed to absolute import

load_dotenv()

app = Flask(__name__, static_url_path='',
            static_folder='web/static', template_folder='web/templates')

DB = DataBace(database="zoo", type="mysql", host="localhost",
              port="3306", user="zoo", password=os.getenv("DB_PASSWORD"))

# print(DB.setup(["database/hotel_bookings.sql", "database/hotel_rooms.sql", "database/purchases.sql",
#          "database/sessions.sql", "database/users.sql", "database/zoo_bookings.sql"]))

register_routes(app, DB)

if __name__ == '__main__':
    app.run(debug=True, host="0.0.0.0", port=5000)
