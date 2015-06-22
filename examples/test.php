<?php
$config = new \Troward\SugarAPI\Config('', '', '', '', '');

$client = new \Troward\SugarAPI\Client($config);

$client->module('Accounts')
    ->getRelation('', 'Contacts');