# SugarCRM 7 REST API Wrapper

A cleaner and quicker option for using the SugarCRM 7 REST API (v10).

About
------------

To save time having to build and connect up your own application for the SugarCRM 7 REST API, 
this wrapper helps you start up and get busy in only a few lines. 

Usage
------------

    # Enter your details
    new Troward\SugarAPI\Config('<your_url>','<your_username>','<your_password','<your_consumer_key>','<your_consumer_secret>');
    
    # Generate a new token
    new Troward\SugarAPI\Token();
    
    # Retrieve your data
    $account = new Troward\SugarAPI\Account();
    $account->all(500); // Returns 500 Account records

Licence
-------
The SugarCRM 7 API Wrapper is open-sourced software licensed under the [MIT Licence](http://opensource.org/licenses/MIT).