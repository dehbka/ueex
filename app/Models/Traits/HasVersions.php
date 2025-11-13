<?php

namespace App\Models\Traits;

use App\Models\Version;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasVersions
{
    public ?int $version = null;

    public static function bootHasVersions(): void
    {
        static::created(function (Model $model) {
            static::createVersion($model);
        });

        static::updated(function (Model $model) {
            static::createVersion($model);
        });
    }

    private static function createVersion(self $model): Version
    {
        $lastVersion = $model->getLastVersionId();

        $versionNumber = $lastVersion ? $lastVersion + 1 : 1;

        $before = $model->getOriginal();
        $after  = $model->getAttributes();

        return Version::create([
            'version' => $versionNumber,
            'versionable_type' => get_class($model),
            'versionable_id' => $model->getKey(),
            'before_properties' => $model->wasRecentlyCreated ? null : json_encode($before),
            'after_properties' => json_encode($after),
        ]);
    }

    public function versions(): MorphMany
    {
        return $this->morphMany(Version::class, 'versionable');
    }

    public function getLastVersionId(): int
    {
        if ($this->version) {
            return $this->version;
        }

        return $this->version ?? $this->versions()->max('version') ?? 0;
    }
}
