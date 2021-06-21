<?php

namespace App\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    public const SUCCESS = 1;
    public const ERROR = -1;

    public function __construct($data = null, int $code = self::SUCCESS, string $message = '', int $status = 200, array $headers = [], bool $json = false)
    {
        parent::__construct($data, $status, $headers, $json);

        $response = [
            'status' => $status,
            'code' => $code,
        ];

        if(!is_null($data)) {
            $response['data'] = $data;
        }

        if(!is_null($message)) {
            $response['message'] = $message;
        }

        $this->setData($response);
    }
}
