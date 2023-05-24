<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
class CarController extends Controller
{

    public function index(Request $request): Response
    {
        $fields = $request->all();
        request()->query->remove('saved');
        request()->query->remove('updated');
        $cars = Car::all();
        $headers =  array(
            (object) [
            'text' => 'ID',
            'value' => 'id',
            'sortable' => 'true'
        ],
            (object) [
            'text' => 'Nome',
            'value' => 'name',
            'sortable' => 'true'
        ],
            (object) [
                'text' => 'Marca',
                'value' => 'brand_id',
                'sortable' => 'true'
            ],
            (object) [
                'text' => 'Proprietário',
                'value' => 'customer_id',
                'sortable' => 'true'
            ],
            (object) [
                'text' => 'Criado ',
                'value' => 'created_at',
                'sortable' => 'true'
            ],
            (object) [
                'text' => '',
                'value' => 'operation',
            ],
        );

        $props = array_merge($fields,['items' => $cars, 'headers' =>$headers], );

        return Inertia::render('Car/Index', $props);
    }
    public function create(): Response
    {
        return Inertia::render('Car/Create');
    }

    public function store(CarStoreRequest $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.Car::class,
            'gender' => ['required','in:Masculino,Feminino'],
            'birthdate' => 'required|date',
        ]);

        Car::create($request->all());

        return Redirect::route('cars',['saved' => true]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $car = Car::findOrFail($request->route('id'));
        return Inertia::render('Car/Edit', [
            'car' => $car
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(CarUpdateRequest $request): RedirectResponse
    {
        $request->validated();
        $input = $request->all();
        Car::whereId($input['id'])->update($input);

        return Redirect::route('cars',['updated' => true]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $car = Car::findOrFail($request->route('id'));
        $car->delete();

        return Redirect::route('cars');
    }
}
