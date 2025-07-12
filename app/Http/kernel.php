protected $routeMiddleware = [
    // ...
    'is_customer_login' => \App\Http\Middleware\IsCustomerLogin::class,
    'check_customer_login' => \App\Http\Middleware\CheckCustomerLogin::class,
];
