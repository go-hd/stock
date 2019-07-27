<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Storage
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Storage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Storage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Storage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Storage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Storage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Storage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Storage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Storage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['products', 'url'];

    /**
     * Get the operations in the storage.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function operations()
    {
        return $this->hasMany(Operation::class);
    }

    /**
     * Get the products in the storage.
     *
     * @return array
     */
    public function getProductsAttribute()
    {
        return $this->operations()
            ->selectRaw(
                "product_id, products.*, " .
                "SUM(CASE WHEN quantity > 0 THEN quantity ELSE 0 END) AS receipts, ".
                "SUM(CASE WHEN quantity < 0 THEN quantity ELSE 0 END)*-1 AS issues, " .
                "SUM(quantity) AS stocks, " .
                "products.cost*SUM(quantity) as stock_value"
            )
            ->join('products', 'operations.product_id', '=', 'products.id')
            ->groupBy('product_id')
            ->orderBy('product_id')
            ->get()->toArray();
    }

    /**
     * Get the url of the storage.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('storage.show', ['id' => $this->id]);
    }
}
