<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Professional;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Symfony\Component\HttpFoundation\Response;

class ProfessionalController extends Controller
{
    use HttpResponses;

    public function store(Request $request){
        try {

            $request->validate([
                'name' => 'string|required|max:255',
                'contact' => 'string|required|max:30',
                'email' => 'string|required|unique:peoples',
                'cpf' => 'string|required|max:30|unique:peoples',
                'register' => 'string|required',
                'speciality' => 'string|required'
            ]);

            $dataPeople = $request->only('name', 'cpf', 'email', 'contact');
            $dataProfessional = $request->only('register', 'speciality');

            $people = People::create($dataPeople);

            Professional::create([
                'people_id' => $people->id,
                // ...$dataProfessional <- tem o mesmo efeito do codigo abaixo, mas escreve menos.
                'register' => $dataProfessional['register'],
                'speciality' => $dataProfessional['speciality']
            ]);

            return $people;

        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
            }

    public function index(Request $request)
{
    $nameSearch = $request->input('name');
    $emailSearch = $request->input('email');
    $contactSearch = $request->input('contact');
    $cpfSearch = $request->input('cpf');

    $professionals = Professional::query()
        ->with('people')
        ->whereHas('people', function ($query) use ($nameSearch, $emailSearch, $contactSearch, $cpfSearch) {
            if (!is_null($nameSearch)) {
                $query->where('name', 'ilike', "%$nameSearch%");
            }
            if (!is_null($emailSearch)) {
                $query->where('email', 'ilike', "%$emailSearch%");
            }
            if (!is_null($contactSearch)) {
                $query->where('contact', 'ilike', "%$contactSearch%");
            }
            if (!is_null($cpfSearch)) {
                $query->where('cpf', 'ilike', "%$cpfSearch%");
            }
        })
        ->get();

    return $professionals;
}


}