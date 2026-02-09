<?php
class AuthController {
    public static function register($req) {
        if (User::findByEmail($req['email'])) {
            Response::json(["error"=>"Email exists"], 400);
        }

        User::create([
            $req['name'],
            $req['email'],
            password_hash($req['password'], PASSWORD_DEFAULT)
        ]);

        Response::json(["message"=>"Registered successfully"]);
    }

    public static function login($req) {
        $user = User::findByEmail($req['email']);
        if (!$user || !password_verify($req['password'], $user['password'])) {
            Response::json(["error"=>"Invalid credentials"], 401);
        }

        $token = JWT::generate([
            "id"=>$user['id'],
            "email"=>$user['email']
        ]);

        Response::json(["token"=>$token]);
    }
}
