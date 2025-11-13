<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Enums\ResourceStatus;
use App\Http\Api\Requests\StoreCompanyRequest;
use App\Http\Api\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyController
{
    public function store(StoreCompanyRequest $request): JsonResource
    {
        $company = Company::updateOrCreate(
            [
                'edrpou' => $request->get('edrpou')
            ],
            $request->validated()
        );

        return CompanyResource::make($company, ResourceStatus::createFromModel($company));
    }
}
