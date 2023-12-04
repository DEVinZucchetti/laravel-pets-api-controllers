<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseStatusCodeSame;

class RaceController extends Controller {
    public function index() {
        try {
            $races = Race::all();
            return $this->response("Requisição realizada com sucesso.", $races);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), null, false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store() {
    }

    public function show() {
    }

    public function update() {
    }

    public function destroy() {
    }
}
