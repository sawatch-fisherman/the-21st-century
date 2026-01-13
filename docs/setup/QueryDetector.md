# このファイルについて
LaravelにLaravel Query Detector（N+1クエリ検出ツール）を導入する手順・設定について記述する

# 手順
導入手順について記述する

## Laravel Query Detector インストール
Docker 内の app コンテナに入って ライブラリをインストールする  
`composer require --dev beyondcode/laravel-query-detector`  

## 設定ファイルを公開
パッケージの設定ファイルを公開する（初回のみ）  
`php artisan vendor:publish --provider="BeyondCode\QueryDetector\QueryDetectorServiceProvider"`  

これにより、`config/querydetector.php` が作成される。

## ログ出力の設定
`config/querydetector.php` の `output` 配列に、ログ出力用のクラスを追加する。

### querydetector.phpの記述内容（ログ出力設定）
'output' => [
    \BeyondCode\QueryDetector\Outputs\Log::class,   // logに出力
]
