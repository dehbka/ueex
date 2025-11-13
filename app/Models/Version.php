<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property int $version
 * @property string $versionable_type
 * @property int $versionable_id
 * @property Collection|null $before_properties
 * @property Collection|null $after_properties
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|Version newModelQuery()
 * @method static Builder<static>|Version newQuery()
 * @method static Builder<static>|Version query()
 * @method static Builder<static>|Version whereAfterProperties($value)
 * @method static Builder<static>|Version whereBeforeProperties($value)
 * @method static Builder<static>|Version whereCreatedAt($value)
 * @method static Builder<static>|Version whereId($value)
 * @method static Builder<static>|Version whereUpdatedAt($value)
 * @method static Builder<static>|Version whereVersion($value)
 * @method static Builder<static>|Version whereVersionableId($value)
 * @method static Builder<static>|Version whereVersionableType($value)
 * @mixin \Eloquent
 */
class Version extends Model
{
    protected $fillable = [
        'version',
        'versionable_type',
        'versionable_id',
        'before_properties',
        'after_properties',
    ];

    protected $casts = [
        'before_properties' => 'collection',
        'after_properties' => 'collection',
    ];
}
