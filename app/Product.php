<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Product
 *
 * @property int $id
 * @property string $sku
 * @property int $jan
 * @property string $asin
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int $stocks
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Operation[] $operations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereAsin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereJan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSku($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $cost
 * @property-read mixed $tax_included_cost
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherecost($value)
 */
class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku',
        'jan',
        'asin',
        'name',
        'code',
        'cost',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'tax_included_cost',
    ];

    /**
     * Get the operations for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function operations(): HasMany
    {
        return $this->hasMany(Operation::class);
    }

    /**
     * Get the stocks of the product.
     *
     * @return int
     */
    public function getStocksAttribute(): int
    {
        return Operation::whereProductId($this->id)->sum('quantity');
    }

    /**
     * Get the tax-included cost of the product.
     *
     * @return int
     * @throws \Exception
     */
    public function getTaxIncludedCostAttribute(): int
    {
        $rounding = config('stock.tax.rounding');

        if (!in_array($rounding, ['round', 'floor', 'ceil'])) {
            throw new \Exception('Invalid rounding function has been specified.');
        }

        return $rounding($this->cost * (1 + config('stock.tax.rate', 0.08)));
    }
}
