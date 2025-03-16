<?php

namespace App\Http\Controllers;

use App\Services\PetDataService;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function __construct(private PetService $petService, private PetDataService $petDataService) {}

    public function index()
    {
        return view('index');
    }

    public function create()
    {
        $categories = $this->petDataService->getCategories();
        $tags = $this->petDataService->getTags();

        return view('pets/create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        logger($request->all());
        $validated = $request->validate([
            'name' => 'required|string',
            'photoUrls' => 'required|string',
            'identificationNumber' => 'sometimes|integer|nullable',
            'category_id' => 'sometimes|integer',
            'tag_id' => 'sometimes|integer',
            'status' => 'sometimes|string',
        ], [
            'name.required' => 'Imię jest wymagane.',
            'photoUrls.required' => 'Adresy zdjęć są wymagane.',
            'identificationNumber.integer' => 'Numer identyfikacyjny musi być liczbą całkowitą.',
            'category_id.integer' => 'Wskazana kategoria nie istnieje.',
            'tag_id.integer' => 'Wskazana tag nie istnieje.',
        ]);

        logger("po walidacji");
        logger($validated);

        $response = $this->petService->store($validated);
        if ($response) {
            return redirect()->back()->with([
                'success' => 'Zwierzak dodany pomyślnie',
                'response' => $response,
            ]);
        } else {
            return redirect()->back()->withInput()->with('error', 'Wystąpił błąd w zewnętrznej usłudze, prosze spróbować później');
        }
    }

    public function show($id)
    {
        $validated = validator(['id' => $id], [
            'id' => 'required|integer',
        ], [
            'id.required' => 'Numer identyfikacyjny jest wymagany.',
            'id.integer' => 'Wskazany numer identyfikacyjny musi być liczbą.',
        ])->validate();

        $response = $this->petService->getById($validated['id']);
        if ($response) {
            return view('pets/show', [
                'success' => 'Zwierzak znaleziony pomyślnie',
                'response' => $response,
                'error' => null,
            ]);
        } else {
            return view('pets/show', [
                'success' => null,
                'response' => null,
                'error' => 'Nie znaleziono zwierzaka o podanym numerze identyfikacyjnym',
            ]);
        }
    }

    public function destroy($id)
    {
        $validated = validator(['id' => $id], [
            'id' => 'required|integer',
        ], [
            'id.required' => 'Numer identyfikacyjny jest wymagany.',
            'id.integer' => 'Wskazany numer identyfikacyjny musi być liczbą.',
        ])->validate();

        $response = $this->petService->destroy($validated['id']);
        if ($response) {
            return redirect()->back()->with([
                'deleted' => 'Zwierzak usunięty pomyślnie',
                'response' => $response,
            ]);
        } else {
            return redirect()->back()->with('error', 'Wystąpił błąd w zewnętrznej usłudze, prosze spróbować później');
        }
    }

    public function edit(Request $request, $id)
    {

        $validated = validator(['id' => $id], [
            'id' => 'required|integer',
        ], [
            'id.required' => 'Numer identyfikacyjny jest wymagany.',
            'id.integer' => 'Wskazany numer identyfikacyjny musi być liczbą.',
        ])->validate();

        $response = $this->petService->getById($validated['id']);

        if(!$response){
            return redirect()->back()->with('error', 'Nie znaleziono zwierzaka o podanym numerze identyfikacyjnym');
        }

        $categories = $this->petDataService->getCategories();
        $tags = $this->petDataService->getTags();

        return view('pets/edit', compact('tags', 'categories', 'response'));
    }
    public function clearSession()
    {
        session()->forget(['responseJson', 'success']);
        return redirect()->route('pets.create');
    }
}
