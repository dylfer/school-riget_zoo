from flask import Blueprint, render_template

room_data = {
    'single': {
        'room_image': '/images/Single.png',
        'room_type': 'Single',
        'room_description': 'Cozy and comfortable single room perfect for solo travelers. Enjoy modern amenities and a peaceful retreat after a day of exploration.',
        'room_capacity': 2,
        'room_price': 70
    },
    'double': {
        'room_image': '/images/double.png',
        'room_type': 'Double',
        'room_description': 'Spacious double room ideal for couples or friends. Featuring comfortable beds and stunning interior design.',
        'room_capacity': 4,
        'room_price': 85
    },
    'family': {
        'room_image': '/images/family.png',
        'room_type': 'Family',
        'room_description': 'Generous family room with ample space for everyone. Includes multiple beds and family-friendly amenities.',
        'room_capacity': 5,
        'room_price': 100
    },
    'suite': {
        'room_image': '/images/suite.png',
        'room_type': 'Suite',
        'room_description': 'Luxurious suite with premium amenities and expansive living space. Perfect for large groups or special occasions.',
        'room_capacity': 10,
        'room_price': 200
    }
}

room_router = Blueprint('room', __name__)



@room_router.route("/rooms/<room_type>")
def room_detail(room_type):
    room = room_data.get(room_type)
    if room:
        return render_template('roomtemplate.html', **room)
    else:
        return "Room not found", 404




