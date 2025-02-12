# TODO complete + import and add to before_request and nessary places
import uuid

def create(DB, ip_address, user_agent):
    session_id = str(uuid.uuid4())
    DB.insert("sessions", (session_id, None, False, ip_address, user_agent), 
              ["session_id", "previous_session_id", "login_status", "ip_address", "user_agent"])
    return session_id

def clear(DB, session_id):
    DB.update("sessions", "login_status = 0, token = NULL", f"session_id = '{session_id}'")


def check(DB, session_id,ip_address,user_agent):#TODO
    res = DB.select("sessions", "*", f"session_id = '{session_id}'")
    if not res or res[0][7] != ip_address or res[0][8] != user_agent:
        clear(DB, session_id)
        return False
    return True

def get(DB, session_id):
    res = DB.select("sessions", "*", f"session_id = '{session_id}'")
    if not res:
        return None
    return res[0]

def set_auth(DB, session_id, token, user_id):
    DB.update("sessions", f"token = '{token}', login_status = '1', user_id = '{user_id}'", f"session_id = '{session_id}'")
    return True

def check_auth(DB, session_id, token):#TODO
    res = DB.select("sessions", "token, login_status, user_id", f"session_id = '{session_id}'")
    if not res or res[0][0] != token  or not res[0][1]:
        return False, None
    res1 = DB.select("users", "token_secret", f"id = '{res[0][2]}'")
    if not res1:
        return False, None
    return True, res1[0][0]




# def delete(DB, session_id):
#     DB.delete("sessions", f"session_id = '{session_id}'")