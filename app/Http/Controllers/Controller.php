<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'E-Commerce API',
    description: 'API Documentation for the E-Commerce platform.'
)]
#[OA\Server(
    url: '/',
    description: 'Local API Server'
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'Sanctum'
)]
abstract class Controller
{
    //
}

