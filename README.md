# Alegra PHP bindings

You can sign up for a Alegra account at http://www.alegra.com/.

## Requirements

PHP 5.6.11 and later.

## Composer

1. Include in your project `composer.json` the following dependency:

```yaml
"require": {
        ...
        "jorgadan/alegra-php": "^0.27"
    },
```

2. Add a repository key to your project `composer.json`:

```yaml
"repositories": [
        {
            "type": "git",
            "url": "git@github.com:jorgadan/alegra-php.git"
        }
    ],
```

3. Run `composer update` or `composer install` and you should be getting it

To use the bindings, use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

## Dependencies

The bindings require the following extension in order to work properly:

- [`curl`](https://secure.php.net/manual/en/book.curl.php), although you can use your own non-cURL client if you prefer
- [`json`](https://secure.php.net/manual/en/book.json.php)
- [`mbstring`](https://secure.php.net/manual/en/book.mbstring.php) (Multibyte String)

If you use Composer, these dependencies should be handled automatically. If you install manually, you'll want to make sure that these extensions are available.

## Getting Started


Your test.php script
```php
<?php

require './vendor/autoload.php';

Alegra\Api::auth('Your user', 'Your api token');
// Also you can auth api with your app credentials
/*
Alegra\Api::auth([
    'username' => 'Your user',
    'password' => 'Your password'
]);
*/
```

**Create** an new resource

```php
$contact = Alegra\Contact::create(['name' => 'Your contact name']);
print_r($contact);

// Create using save

$contact = new Alegra\Contact;
$contact->name = 'My second contact';
//a LEGAL_ENTITY will be created by default
//to create a PERSON_ENTITY you must add 
//$contact->firstName = "My";
//$contact->secondName = "Second";
//$contact->lastName = "Contact";
$contact->save(); // Update the contact
print_r($contact);
```

**Get** an existing resource

```php
$contact = Alegra\Contact::get(100); // where 100 is the id of resource.
$contact->identification = '900.123.123-8';
$contact->email = 'email@server.com';
$contact->save();
print_r($contact);
```

**Save** an resource without fetch your data

```php

$contact = new Alegra\Contact(100);
$contact->email = 'user@server.com';
$contact->save();
```

Get **all** resources

```php
$contacts = Alegra\Contact::all();
$contacts->each(function ($contact) {
    print_r($contact);
});

// $contacts is instanceof Illuminate\Support\Collection
// You can use methods like
print_r($contacts->slice(0, 3)); // The three first contacts.
```

**Delete** an resource

```php
// Get a delete

Alegra\Contact::get(1)->delete();

// Delete without fetch data

(new Alegra\Contact(1))->delete();

// Delete using static interface

Alegra\Contact::delete(1);
```

Catch errors

```php
try {
    // Your request code
}

// Exception when a client error is encountered (4xx codes)

catch (GuzzleHttp\Exception\ClientException $e) {
    // code
}

// Exception when a server error is encountered (5xx codes)

catch (GuzzleHttp\Exception\ServerException $e) {
    // code
}

// Exception thrown when a connection cannot be established.

catch (GuzzleHttp\Exception\ConnectException $e) {
    // code
}

// Other exceptions

catch (Exception $e) {
    // code
}

```

## Documentation

Please see http://developer.alegra.com/docs for up-to-date documentation.

