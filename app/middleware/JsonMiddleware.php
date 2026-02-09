<?php

class JsonMiddleware {

    public static function handle(): array {

        header("Content-Type: application/json");

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method === 'GET') {
            return [];
        }

        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        if (stripos($contentType, 'application/json') === false) {
            Response::json([
                "error" => "Content-Type must be application/json"
            ], 400);
        }

        $rawInput = file_get_contents("php://input");

        if (trim($rawInput) === '') {
            Response::json([
                "error" => "Request body cannot be empty"
            ], 400);
        }

        $input = json_decode($rawInput, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            Response::json([
                "error" => "Invalid JSON: " . json_last_error_msg()
            ], 400);
        }

        return $input;
    }
}
