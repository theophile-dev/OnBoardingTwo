# OnboardingTwo

## Setup

Clone the repository :
```
git clone https://github.com/theophile-dev/OnboardingOne.git
```
Composer install :
```
composer install
```

Setup .env with your DATABASE_URL 

Create database :
```
php bin/console doctrine:database:create
```

Run migrations :
```
php bin/console doctrine:migrations:migrate
```

Load fixtures
```
php bin/console doctrine:fixtures:load
```

To test the mailer you can install maildev :
```
sudo npm install -g maildev
```

Due to certificate issue you must start maildev with :
```
sudo maildev --hide-extensions STARTTLS
```
The MailDev webapp is now running at http://0.0.0.0:1080

You can now start the server with the Symfony CLI :
```
symfony server:start
```

## Test the API

An easy way to test the API is to use a REST Client add-ons
( ex for fixfox : https://addons.mozilla.org/fr/firefox/addon/restclient/ )

---

Send a new contact email
```
 {
   "firstname": "marc",
   "lastname": "depont",
   "email": "marc.dupont@gmail.com",
   "department" : 4,
   "message" : "Lorem ipsum dolor sit amet, consectetur adipiscing elit"
 }
```




