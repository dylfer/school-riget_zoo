

@____.route("/login", methods=["POST"])
def login():
    data = request.json
    username = data.get("username")
    password = data.get("password")
    if len(username) == 0:
        email = data.get("email")
        res = DB.query()
        if len(res) == 0:
            return jsonify({"error": "User not found"}), 404
    else:
        res = DB.query()
        if len(res) == 0:
            return jsonify({"error": "User not found"}), 404
    if Phash(password) == res[0]["password"]:
        token = JWT.encode({"username": res[0]["username"], "session_id": request.cookies.get(
            "session_id")})  # get sess id from table
        return jsonify({"message": "Login successful", "token": token}), 200
    return jsonify({"error": "Invalid password"}), 401


@____.route("/register", methods=["POST"])
def register():
    data = request.json
    username = data.get("username")
    password = data.get("password")
    email = data.get("email")  # add data validation
    if len(username) == 0 or len(password) == 0 or len(email) == 0:
        return jsonify({"error": "Invalid data"}), 400
    res = DB.query()
    if len(res) != 0:
        return jsonify({"error": "User already exists"}), 409
    DB.insert({"username": username, "password": Phash(password), "email": email})
    return jsonify({"message": "User created"}), 201
