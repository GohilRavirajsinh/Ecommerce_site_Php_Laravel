<php?

protected $routeMiddleware = [
    // Other middleware...
    'auth.admin' => \App\Http\Middleware\AdminAuth::class,
];
