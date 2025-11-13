<?php

namespace App\Http\Api\Enums;

use Illuminate\Database\Eloquent\Model;

enum ResourceStatus: string
{
    case created = 'created';
    case updated = 'updated';
    case duplicate = 'duplicate';

    public static function createFromModel(Model $model): self
    {
        if ($model->wasRecentlyCreated) {
            return self::created;
        }

        if ($model->wasChanged()) {
            return self::updated;
        }

        return self::duplicate;
    }
}
