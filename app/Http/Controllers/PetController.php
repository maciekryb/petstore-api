<?php

namespace App\Http\Controllers;

use App\Services\PetDataService;

class PetController extends Controller
{
    public function index(){
        return view('index');
    }

    public function create(PetDataService $petDataService)
    {
        $categories = $petDataService->getCategories();
        $tags = $petDataService->getTags();

        return view('pets/create', compact('categories', 'tags'));
    }

}
