<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Shop;
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
     * @return BelongsTo<Shop, static>
     * @phpstan-ignore-next-line
     */
    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * メニューに紐づくカテゴリーを取得
     *
     * @return BelongsTo<Category, static>
     * @phpstan-ignore-next-line
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
