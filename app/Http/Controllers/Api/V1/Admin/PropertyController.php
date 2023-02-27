<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Admin\Property\CreatePropertyRequest;
use App\Http\Requests\Api\V1\Admin\Property\UpdatePropertyRequest;
use App\Http\Resources\Api\V1\Admin\Property\PropertyPaginateResource;
use App\Http\Resources\Api\V1\Admin\Property\PropertyResource;
use App\Models\Property;
use App\Repositories\Property\PropertyRepositoryInterface;

class PropertyController extends Controller
{
    protected PropertyRepositoryInterface $propertyRepository;

    public function __construct(PropertyRepositoryInterface $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
    }

    public function index()
    {
        $properties = $this->propertyRepository->paginate(10);

        return new PropertyPaginateResource($properties);
    }

    public function store(CreatePropertyRequest $request)
    {
        $property = $this->propertyRepository->
        create(my_filter($request->validated()));

        return $this->success_response(new PropertyResource($property),
            'property has been successfully created', 201);
    }

    public function show(Property $property)
    {
        return $this->success_response(new PropertyResource($property),
            'property information');
    }

    public function update(UpdatePropertyRequest $request, Property $property)
    {
        $this->propertyRepository->update(my_filter($request->validated()),
            $property->id);

        return $this->success_response(new PropertyResource($property->refresh()),
            'property has been successfully updated');
    }

    public function destroy(Property $property)
    {
        $this->propertyRepository->delete($property->id);

        return $this->success_response(null,
            'property has been successfully deleted');
    }
}
