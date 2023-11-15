<?php

namespace App\Helpers;

class RequestHelper
{
    public static function post($endpoint, $data = [])
    {
        $error = $content = $statusCode = '';
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', $endpoint, [
                'query' => $data,
                'timeout' => 5, // Response timeout
                'connect_timeout' => 5, // Connection timeout
            ]);

            $statusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
        }

        // Catch Guzzle Exceptions
        catch (\GuzzleHttp\Exception\GuzzleException $e) {
            $error = $e->getMessage();
            $statusCode = $e->getCode();
        }
        // Catch Client Exceptions
        catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $error = (string) $response->getBody();
                $statusCode = $e->getCode();
            }
        }
        catch (\Exception $e) {
            $error = $e->getMessage();
            $statusCode = $e->getCode();
        }

        return [
            'content' => $content,
            'statusCode' => $statusCode,
            'error' => $error,
        ];
    }
}
