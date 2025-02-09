from flask import Blueprint, render_template

genral_router = Blueprint('genral', __name__)

# TODO add titles as page pramiters

# General routes
@genral_router.route('/')
def index():
    return render_template('base.html', content_template='index.html', title='Home')

@genral_router.route('/about')
def about():
    return render_template('base.html', content_template='about.html', title='About')

@genral_router.route('/contact')
def contact():
    return render_template('base.html', content_template='contact.html', title='Contact us')

@genral_router.route('/termsandconditions')
def termsandconditions():
    return render_template('base.html', content_template='terms.html', title='T&C')

@genral_router.route('/privacy')
def privacy():
    return render_template('base.html', content_template='privacy.html', title='Privacy')


@genral_router.route('/education')
def education():
    return render_template('base.html', content_template='education.html', title='Education')

@genral_router.route('/dashboard')
def dashboard():
    return render_template('base.html', content_template='dashboard.html', title='Dashboard')

# Account routes
@genral_router.route('/login')
def login():
    return render_template('base.html', content_template='login.html', title='Login')

@genral_router.route('/signup')
def signup():
    return render_template('base.html', content_template='signup.html', title='Sign up')

@genral_router.route('/forgotpassword')
def forgotpassword():
    return render_template('base.html', content_template='forgotpassword.html', title='Forgot password')

@genral_router.route("/settings")
def settings():
    return render_template('base.html', content_template='settings.html', title='Settings')

# Booking routes
@genral_router.route('/checkout')
def checkout():
    return render_template('base.html', content_template='checkout.html', title='Checkout')

@genral_router.route("/return")
def payment_return():
    return render_template('base.html', content_template='return.html', title='Return')

@genral_router.route('/book')
def book():
    return render_template('base.html', content_template='book.html', title='Book')

@genral_router.route('/hotel')
def hotel():
    return render_template('base.html', content_template='hotel.html', title='Hotel')

@genral_router.route('/tickets')
def tickets():
    return render_template('base.html', content_template='tickets.html', title='Tickets')

# Error handling routes
@genral_router.app_errorhandler(404)
def page_not_found(e):
    return render_template('base.html', content_template='404.html', title='Page Not Found'), 404
