# このファイルについて
LaravelにLaravel Pail（ログファイル監視ツール）を導入する手順・設定について記述する

# 手順
導入手順について記述する

## pcntl拡張機能の有効化
Laravel Pail を使用するには、PHPの `pcntl` 拡張機能が必要。  
`docker/php/Dockerfile` の14行目を以下のように修正する。

### Dockerfileの記述内容（pcntl拡張機能の追加）
&& docker-php-ext-install pdo_mysql gd xml pcntl

修正後、Dockerコンテナを再ビルドする。  
`cd docker`  
`docker-compose down`  
`docker-compose up -d --build`

## Laravel Pail インストール
Docker 内の app コンテナに入って ライブラリをインストールする  
`composer require --dev laravel/pail`  

パッケージは自動的に登録されるため、追加の設定は不要。

## 実行
`docker exec -u www-data -it the21st_app bash`  
`php artisan pail`  


完了。