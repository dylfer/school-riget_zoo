from flask import Blueprint, request, jsonify
import jwt
import datetime
import os


def Define(DB):
    auth_router = Blueprint('auth', __name__, url_prefix='/api/auth')

    def Phash(password):
        return password

    @auth_router.route("/login", methods=["POST"])
    def login():
        data = request.json
        username = data.get("username")
        password = data.get("password")
        if not username:
            email = data.get("email")
            res = DB.select()
            if not res:
                return jsonify({"error": "User not found"}), 404
        else:
            res = DB.query()
            if not res:
                return jsonify({"error": "User not found"}), 404
        if Phash(password) == res[0]["password"]:
            token = jwt.encode({"username": res[0]["username"], "session_id": request.cookies.get(
                "session_id")}, os.getenv('SECRET_KEY'), algorithm="HS256")
            return jsonify({"message": "Login successful", "token": token}), 200
        return jsonify({"error": "Invalid password"}), 401

    @auth_router.route("/register", methods=["POST"])
    def register():
        data = request.json
        username = data.get("username")
        password = data.get("password")
        email = data.get("email")
        if not username or not password or not email:
            return jsonify({"error": "Invalid data"}), 400
        res = DB.query()
        if res:
            return jsonify({"error": "User already exists"}), 409
        DB.insert({"username": username, "password": Phash(
            password), "email": email})
        return jsonify({"message": "User created"}), 201
    return auth_router
