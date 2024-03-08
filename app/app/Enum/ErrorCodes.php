<?php

namespace App\Enum;

enum ErrorCodes
{
    public const REQUEST_BAD_REQUEST        = ['REQUEST:BAD_REQUEST', 400];
    public const BAD_REQUEST                = ['BAD REQUEST', 400, 0, true];
    public const USER_UNAUTHORIZED          = ['USER:UNAUTHORIZED', 401];
    public const USER_FORBIDDEN             = ['USER:FORBIDDEN', 403];
    public const NOT_FOUND                  = ['NOT FOUND', 404, 0, true];
    public const METHOD_NOT_ALLOWED         = ['METHOD NOT ALLOWED', 405];
    public const REQUEST_VALIDATION_ERROR   = ['REQUEST:VALIDATION_ERROR', 422];

    public const SYSTEM_ERROR               = ['SYSTEM:ERROR', 500];
    public const SYSTEM_UNAVAILABLE         = ['SYSTEM:UNAVAILABLE', 503];
    public const GATEWAY_TIME_OUT           = ['GATEWAY TIME OUT', 504];

    /*

        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested range unsatisfiable',
        417 => 'Expectation failed',
        418 => 'I\'m a teapot',
        421 => 'Misdirected Request',
        422 => 'Unprocessable entity',
        423 => 'Locked',
        424 => 'Method failure',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        449 => 'Retry With',
        450 => 'Blocked by Windows Parental Controls',
        451 => 'Unavailable For Legal Reasons',

        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway or Proxy Error',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out',
        505 => 'HTTP Version not supported',
        507 => 'Insufficient storage',
        508 => 'Loop Detected',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not Extended',
        511 => 'Network Authentication Required',
    ];

     */
}
