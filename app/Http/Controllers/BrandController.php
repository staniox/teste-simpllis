<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
class BrandController extends Controller
{

    public function index(Request $request): Response
    {
        $fields = $request->all();
        request()->query->remove('saved');
        request()->query->remove('updated');
        $customers = Customer::all();
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
                'text' => 'Email',
                'value' => 'email',
                'sortable' => 'true'
            ],
            (object) [
                'text' => 'Sexo',
                'value' => 'gender',
                'sortable' => 'true'
            ],
            (object) [
                'text' => 'Dt. nascimento',
                'value' => 'birthdate',
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

        $props = array_merge($fields,['items' => $customers, 'headers' =>$headers], );

        return Inertia::render('Customer/Index', $props);
    }
    public function create(): Response
    {
        return Inertia::render('Customer/Create');
    }

    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.Customer::class,
            'gender' => ['required','in:Masculino,Feminino'],
            'birthdate' => 'required|date',
        ]);

        Customer::create($request->all());

        return Redirect::route('customers',['saved' => true]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        $customer = Customer::findOrFail($request->route('id'));
        return Inertia::render('Customer/Edit', [
            'customer' => $customer
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(CustomerUpdateRequest $request): RedirectResponse
    {
        $request->validated();
        $input = $request->all();
        Customer::whereId($input['id'])->update($input);

        return Redirect::route('customers',['updated' => true]);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $customer = Customer::findOrFail($request->route('id'));
        $customer->delete();

        return Redirect::route('customers');
    }
}
