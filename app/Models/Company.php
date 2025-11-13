<?php

namespace App\Models;

use App\Models\Traits\HasVersions;
use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $edrpou
 * @property string $address
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static CompanyFactory factory($count = null, $state = [])
 * @method static Builder<static>|Company newModelQuery()
 * @method static Builder<static>|Company newQuery()
 * @method static Builder<static>|Company query()
 * @method static Builder<static>|Company whereAddress($value)
 * @method static Builder<static>|Company whereCreatedAt($value)
 * @method static Builder<static>|Company whereEdrpou($value)
 * @method static Builder<static>|Company whereId($value)
 * @method static Builder<static>|Company whereName($value)
 * @method static Builder<static>|Company whereUpdatedAt($value)
 * @property-read Collection<int, Version> $versions
 * @property-read int|null $versions_count
 * @mixin \Eloquent
 */
class Company extends Model
{
    /** @use HasFactory<CompanyFactory> */
    use HasFactory;
    use HasVersions;

    protected $fillable = [
        'name',
        'edrpou',
        'address',
    ];
}
