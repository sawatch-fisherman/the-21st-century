<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="N+1問題検証",
 *     description="N+1問題を意図的に発生させて検証するためのコントローラ（飲食店テーマ）"
 * )
 */
class NPlusOneController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/n-plus-one/buggy",
     *     summary="N+1問題が発生するAPI（バグのあるコード）",
     *     description="Eager Loadingを使わずにリレーションを取得するため、N+1問題が発生します。
     *     Laravel Query Detector（beyondcode/laravel-query-detector）ライブラリで検出されます。",
     *     tags={"N+1問題検証"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功時のレスポンス",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="N+1問題が発生しています"),
     *             @OA\Property(property="shops", type="array", @OA\Items(type="object"))
     *         )
     *     )
     * )
     *
     * 作成日：2025/03/27
     * テーマ：N+1問題の検証（飲食店テーマ）
     * パターン：バグのあるコード例
     * 処理：Eager Loadingを使わずに、ループ内でリレーションを取得しているため、N+1問題が発生する
     */
    public function buggy(): JsonResponse
    {
        // 店舗を取得（1クエリ）
        $shops = Shop::all();

        // 各店舗のメニューを取得（Nクエリ）← N+1問題が発生
        // さらに各メニューのカテゴリーを取得（N×Mクエリ）← より深刻なN+1問題
        $result = [];

        foreach ($shops as $shop) {
            $menus = [];

            foreach ($shop->menus as $menu) { // ここでN+1問題が発生（メニューごとにcategoryリレーションの遅延ロード）
                $menus[] = [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'description' => $menu->description,
                    'price' => $menu->price,
                    'category' => $menu->category->name, // ここでN+1問題が発生（カテゴリーごとにnameを取得）
                ];
            }

            $result[] = [
                'id' => $shop->id,
                'name' => $shop->name,
                'description' => $shop->description,
                'address' => $shop->address,
                'menus' => $menus,
            ];
        }

        return response()->json([
            'message' => 'N+1問題が発生しています。Query Detectorで検出されるはずです。',
            'shops' => $result,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/n-plus-one/correct",
     *     summary="N+1問題を解決したAPI（正しいコード）",
     *     description="Eager Loadingを使用してリレーションを事前に取得するため、N+1問題は発生しません。",
     *     tags={"N+1問題検証"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="成功時のレスポンス",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="N+1問題は発生していません"),
     *             @OA\Property(property="shops", type="array", @OA\Items(type="object"))
     *         )
     *     )
     * )
     *
     * 作成日：2025/03/27
     * テーマ：N+1問題の検証（飲食店テーマ）
     * パターン：正しいコード例
     * 処理：Eager Loading（with）を使用してリレーションを事前に取得するため、N+1問題は発生しない
     */
    public function correct(): JsonResponse
    {
        // Eager Loadingを使用して店舗、メニュー、カテゴリーを一度に取得（3クエリのみ）
        $shops = Shop::with('menus.category')->get();

        $result = [];
        foreach ($shops as $shop) {

            // 事前ロードの検証
            if (! $shop->relationLoaded('menus')) {
                throw new \RuntimeException('menusリレーションが事前ロードされていません');
            }

            $menus = [];
            foreach ($shop->menus as $menu) {

                // カテゴリーリレーションの事前ロードを検証
                if (! $menu->relationLoaded('category')) {
                    throw new \RuntimeException('categoryリレーションが事前ロードされていません');
                }

                $menus[] = [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'description' => $menu->description,
                    'price' => $menu->price,
                    'category' => $menu->category->name, // 事前にロードされているため追加クエリなし
                ];
            }

            $result[] = [
                'id' => $shop->id,
                'name' => $shop->name,
                'description' => $shop->description,
                'address' => $shop->address,
                'menus' => $menus,
            ];
        }

        return response()->json([
            'message' => 'N+1問題は発生していません。Eager Loadingを使用しています。',
            'shops' => $result,
        ]);
    }
}
