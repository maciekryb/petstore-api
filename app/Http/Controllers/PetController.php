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
        $validated =  $this->validateAndGetData($request);
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
        $validated = $this->validateAndGetId($id);
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
        $validated = $this->validateAndGetId($id);
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
        $validated = $this->validateAndGetId($id);
        $response = $this->petService->getById($validated['id']);

        if (!$response) {
            return redirect()->back()->with('error', 'Nie znaleziono zwierzaka o podanym numerze identyfikacyjnym');
        }

        $categories = $this->petDataService->getCategories();
        $tags = $this->petDataService->getTags();

        return view('pets/edit', compact('tags', 'categories', 'response'));
    }

    public function update(Request $request)
    {
        $validated =  $this->validateAndGetData($request);
        $response = $this->petService->update($validated);
        if ($response) {
            return redirect()->back()->with([
                'success' => 'Zwierzak zaktualizowany pomyślnie',
                'response' => $response,
            ]);
        } else {
            return redirect()->back()->withInput()->with('error', 'Wystąpił błąd w zewnętrznej usłudze, prosze spróbować później');
        }
    }

    public function clearSession()
    {
        session()->forget(['responseJson', 'success']);
        return redirect()->route('pets.create');
    }

    private function validateAndGetData($request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'photoUrls' => 'required|string',
            'id' => 'sometimes|integer|min:1|nullable',
            'category_id' => 'sometimes|integer',
            'tag_id' => 'sometimes|integer',
            'status' => 'sometimes|string',
        ], [
            'name.required' => 'Imię jest wymagane.',
            'photoUrls.required' => 'Adresy zdjęć są wymagane.',
            'id.integer' => 'Numer identyfikacyjny musi być liczbą całkowitą.',
            'id.min' => 'Numer identyfikacyjny musi być większy od 0.',
            'category_id.integer' => 'Wskazana kategoria nie istnieje.',
            'tag_id.integer' => 'Wskazana tag nie istnieje.',
        ]);

        return $validated;
    }

    private function validateAndGetId($id)
    {
        $validated = validator(['id' => $id], [
            'id' => 'required|integer',
        ], [
            'id.required' => 'Numer identyfikacyjny jest wymagany.',
            'id.integer' => 'Wskazany numer identyfikacyjny musi być liczbą.',
        ])->validate();

        return $validated;
    }
}
