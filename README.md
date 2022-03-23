# Setup Instructions for Laravel API Backend

Please ensure you are not running any other virtual environments via Vagrant, Docker, etc. as these may interfer with this test server

On your command line `cd` to the directory you wish to install the app in

Run this one liner to clone repo and start server
`git clone git@github.com:ccurtis86/mab-backend.git; cd mab-backend; composer install; mv env-mab-test .env; ./vendor/bin/sail up -d; sail artisan migrate`

App should now be visble @ http://localhost/
