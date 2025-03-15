<?php

namespace App\Http\Controllers;

use App\Services\PetDataService;
use App\Services\PetService;
// use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function __construct(private PetService $petService) {}

    public function index()
    {
        return view('index');
    }

    public function create(PetDataService $petDataService)
    {
        $categories = $petDataService->getCategories();
        $tags = $petDataService->getTags();

        return view('pets/create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        logger($request->all());
        // Walidacja danych z formularza
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
                'responseJson' => json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
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
}
