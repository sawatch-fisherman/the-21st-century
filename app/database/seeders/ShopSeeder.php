<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // カテゴリーを作成
        $drinkCategory = Category::create([
            'name' => 'ドリンク',
            'description' => '各種ドリンクメニュー',
        ]);

        $foodCategory = Category::create([
            'name' => 'フード',
            'description' => '食事メニュー',
        ]);

        $dessertCategory = Category::create([
            'name' => 'デザート',
            'description' => 'デザートメニュー',
        ]);

        // 店舗とメニューを作成
        $shops = [
            [
                'name' => 'The 21st Century Pub',
                'description' => '行きつけのパブ。クラフトビールと本格的な料理が自慢です。',
                'address' => '東京都渋谷区...',
                'phone' => '03-1234-5678',
                'menus' => [
                    ['name' => 'クラフトビール', 'description' => '季節のクラフトビール', 'price' => 800, 'category_id' => $drinkCategory->id],
                    ['name' => 'フィッシュ&チップス', 'description' => 'イギリス風の定番メニュー', 'price' => 1200, 'category_id' => $foodCategory->id],
                    ['name' => 'シェパーズパイ', 'description' => '伝統的なイギリス料理', 'price' => 1500, 'category_id' => $foodCategory->id],
                ],
            ],
            [
                'name' => 'ビアガーデン サンセット',
                'description' => '屋上ビアガーデン。夜景を楽しみながらビールを。',
                'address' => '東京都新宿区...',
                'phone' => '03-2345-6789',
                'menus' => [
                    ['name' => '生ビール', 'description' => 'キリンの生ビール', 'price' => 600, 'category_id' => $drinkCategory->id],
                    ['name' => 'ハンバーガー', 'description' => 'ジューシーなハンバーガー', 'price' => 1000, 'category_id' => $foodCategory->id],
                    ['name' => 'フライドポテト', 'description' => 'カリカリのポテト', 'price' => 500, 'category_id' => $foodCategory->id],
                    ['name' => 'チョコレートケーキ', 'description' => '濃厚なチョコレートケーキ', 'price' => 700, 'category_id' => $dessertCategory->id],
                ],
            ],
            [
                'name' => 'イタリアンレストラン ベラ',
                'description' => '本格的なイタリアン料理とワインを楽しめるレストラン。',
                'address' => '東京都港区...',
                'phone' => '03-3456-7890',
                'menus' => [
                    ['name' => 'ハウスワイン', 'description' => 'イタリア産のハウスワイン', 'price' => 900, 'category_id' => $drinkCategory->id],
                    ['name' => 'マルゲリータピザ', 'description' => '本格的なナポリ風ピザ', 'price' => 1800, 'category_id' => $foodCategory->id],
                    ['name' => 'カルボナーラ', 'description' => '濃厚なクリームパスタ', 'price' => 1600, 'category_id' => $foodCategory->id],
                    ['name' => 'ティラミス', 'description' => '伝統的なイタリアンデザート', 'price' => 800, 'category_id' => $dessertCategory->id],
                ],
            ],
        ];

        foreach ($shops as $shopData) {
            $menus = $shopData['menus'];
            unset($shopData['menus']);

            $shop = Shop::create($shopData);

            foreach ($menus as $menuData) {
                Menu::create(array_merge($menuData, ['shop_id' => $shop->id]));
            }
        }
    }
}
