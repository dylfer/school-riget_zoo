# TODO complete + import and add to before_request and nessary places
import uuid
import jwt
import datetime

def create(DB, ip_address, user_agent):
    session_id = str(uuid.uuid4())
    DB.insert("sessions", (session_id, None, False, ip_address, user_agent), 
              ["session_id", "previous_session_id", "login_status", "ip_address", "user_agent"])
    return session_id

def check(DB, session_id):#TODO
    res = DB.select("sessions", "*", f"session_id = '{session_id}'")
    if not res:
        return False
    return res[0]

def set_auth(DB, session_id, token):
    DB.update("sessions", f"token = '{token}'", f"session_id = '{session_id}'", "login_status = 1")
    return token

def check_auth(DB, session_id, token):#TODO
    res = DB.select("sessions", "token", f"session_id = '{session_id}'")
    if not res or res[0][0] != token:
        return False
    return True

def delete(DB, session_id):
    DB.delete("sessions", f"session_id = '{session_id}'")