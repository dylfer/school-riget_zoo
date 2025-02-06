from flask import Blueprint, request



def Define(DB):
    booking_router = Blueprint('booking', __name__, url_prefix="/api/book")
    @booking_router.route("zoo")
    def zoo():
        data = request.get_json()

    @booking_router.route("hotel")
    def hotel():
        pass

    return booking_router



