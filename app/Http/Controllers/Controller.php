<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(title="Example Project", version="3.0.1")
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer"
 *  ),
 * @OA\OpenApi(
 *      security={
 *          {"apiKeyAuth": {}}
 *      }
 *  )
 *
 *
 */
abstract class Controller
{
    //
}
