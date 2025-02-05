from flask import Blueprint, render_template

genral_router = Blueprint('genral', __name__)

# TODO add titles as page pramiters


@genral_router.route('/')
def index():
    return render_template('base.html', content_template='index.html', title='Home')


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


@genral_router.route('/checkout')
def checkout():
    return render_template('base.html', content_template='checkout.html', title='Checkout')


@genral_router.route("/return")
def payment_return():
    return render_template('base.html', content_template='return.html', title='Return')
