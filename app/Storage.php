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
    protected $appends = ['products'];

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
            ->selectRaw("product_id, SUM(amount) as amount")
            ->groupBy('product_id')
            ->get()
            ->map(function ($operatedProduct) {
                $id = $operatedProduct['product_id'];

                $product = Product::find($id)->toArray();
                $product['amount'] = $operatedProduct['amount'];

                return $product;
            })->toArray();
    }
}
