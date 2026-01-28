<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $shop_id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property int $price
 * @property Shop $shop
 * @property Category $category
 *
 * @use HasFactory<\Database\Factories\MenuFactory>
 */
class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'category_id',
        'name',
        'description',
        'price',
    ];

    /**
     * メニューに紐づく店舗を取得
     *
     * @phpstan-return BelongsTo<Shop, $this>
     */
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * メニューに紐づくカテゴリーを取得
     *
     * @phpstan-return BelongsTo<Category, $this>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
