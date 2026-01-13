<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $address
 * @property string|null $phone
 * @property \Illuminate\Database\Eloquent\Collection<int, Menu> $menus
 *
 * @use HasFactory<\Database\Factories\ShopFactory>
 */
class Shop extends Model
{
    /** @use HasFactory<\Database\Factories\ShopFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
    ];

    /**
     * 店舗に紐づくメニューを取得
     *
     * @return HasMany<Menu, static>
     * @phpstan-ignore-next-line
     */
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
