<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Http\Resources\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        return ProviderResource::collection(Provider::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProviderRequest $request): ProviderResource
    {
        $provider = new Provider();
        $provider->fill($request->validated());
        $provider->save();

        return new ProviderResource($provider, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider): ProviderResource
    {
        return new ProviderResource($provider);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProviderRequest $request, Provider $provider) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider) {}
}
