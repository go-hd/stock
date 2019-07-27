<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Operation
 *
 * @property int $id
 * @property int $storage_id
 * @property int $product_id
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Product $product
 * @property-read \App\Storage $storage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation wherequantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Operation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Operation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'storage_id',
        'product_id',
        'quantity',
    ];

    /**
     * Get the storage that the operation is performed.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    /**
     * Get the product targeted for the operation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
