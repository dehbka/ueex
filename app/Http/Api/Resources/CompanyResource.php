<?php

namespace App\Http\Api\Resources;

use App\Http\Api\Enums\ResourceStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function __construct(
        $resource,
        private readonly ResourceStatus $resourceStatus
    ) {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'company_id' => $this->id,
            'status' => $this->resourceStatus,
        ];
    }
}
