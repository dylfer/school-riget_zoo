from flask import Blueprint, request, jsonify
import hashlib
import jwt
import datetime
import os
import re
import uuid



def Define(DB):
    auth_router = Blueprint('auth', __name__, url_prefix='/api/auth')

    def Phash(password):
        for _ in range(3):
            password = hashlib.sha256(password.encode()).hexdigest()
        return password

    @auth_router.route("/login", methods=["POST"])
    def login():
        data = request.json
        username = data.get("username")
        password = data.get("password")
        if not username:
            email = data.get("email")
            res = DB.select("users","password, username",f"email = {email}")
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
        session_id = request.cookies.get("session_id") 
        first_name = data.get("first_name")
        last_name = data.get("last_name")
        username = data.get("username")
        password = data.get("password")
        email = data.get("email")
        TandC = data.get("TandC")
        mfa = data.get("MFA")
        if not TandC:
            return jsonify({"error": "You must accept the terms and conditions"}), 400
        if not username or not password or not email or not first_name or not last_name or not mfa:
            return jsonify({"error": "Missing data"}), 400
        if len(username) < 3 or len(password) < 6 or not any(c.isupper() for c in password):
            return jsonify({"error": "Username must be at least 3 characters and password at least 6 characters long"}), 400
        email_regex = r'^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$'
        if not re.match(email_regex, email):
            return jsonify({"error": "Invalid email address"}), 400
        res = DB.select("users","username",f"username = {username} OR email = {email}")
        print(res)
        if res:
            return jsonify({"error": "User already exists"}), 409
        id = str(uuid.uuid4())
        token_secret = str(uuid.uuid4())
        response = jsonify({"message": "User created"})
        token = jwt.encode({"id":id,"username": username, "session_id": str(session_id)}, token_secret, algorithm="HS256")
        response.set_cookie("token", token, httponly=True)
        DB.insert("users",(id,username,email,Phash(password),token_secret,mfa,first_name,last_name),("id","username","email","password","token_secret","mfa_enabled","first_name","last_name"))
        # TODO update session DB
        # TODO set all login session and other items
        return response, 201
    return auth_router
