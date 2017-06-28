<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '115202295761262',
        'client_secret' => '476b44f08429da58bb1e256b9c96520a',
        'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],

    'twitter' => [
        'client_id' => 'VEaLTwjtz5sKXU1ljKLetdOih',
        'client_secret' => 'f5lF4TvCupq4aQNtDj3V0D9YxLTZCnU28h6xrIJVbrZOERMjQy',
        'redirect' => 'http://localhost:8000/auth/twitter/callback',
    ],

    'google' => [
      'client_id' => '569616418814-6shggj79cre7fdu9pf2gmelt7t794p8v.apps.googleusercontent.com',
      'client_secret' => 'eNUrwXzRWxcvzf2f2dptRCG9',
      'redirect' => 'http://localhost:8000/auth/google/callback',
    ],



];
