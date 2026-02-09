<?php
class PatientController {

    public static function index() {
        AuthMiddleware::handle();
        Response::json(Patient::all());
    }

    public static function store($req) {
        AuthMiddleware::handle();
        Patient::create([
            $req['name'],
            $req['age'],
            $req['gender'],
            $req['phone'],
            $req['address']
        ]);
        Response::json(["message"=>"Patient added"]);
    }

    public static function update($id, $req) {
        AuthMiddleware::handle();
        Patient::update($id, $req);
        Response::json(["message"=>"Patient updated"]);
    }

    public static function destroy($id) {
        AuthMiddleware::handle();
        Patient::delete($id);
        Response::json(["message"=>"Patient deleted"]);
    }
}

