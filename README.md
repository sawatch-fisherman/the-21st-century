# プロジェクト名
The 21st Century

## 概要
The 21st Century は、Laravelを使用して構築されたWebアプリケーションです。
本プロジェクトでは、PHPの学習を目的としています。
学習した内容のサンプルコードを記述しています。

## 動作環境
- PHP 8.4.18
- Laravel Framework 12.51.0
- MySQL 8.4.4
- Docker
- ベース：https://github.com/sawatch-fisherman/the-21st-century.git　を元に作成

## インストール方法
1. リポジトリをクローン
    ```sh
    git clone https://github.com/sawatch-fisherman/toolbox-api.git
    cd toolbox-api
    ```

2. local-setup.mdの通りにセットアップ

## 使い方
  <!-- ↓未実装 -->
<!-- - ユーザー登録画面: http://localhost/register -->
<!-- - ログイン画面: http://localhost/login -->
<!-- - APIエンドポイント一覧は `docs/api.md` を参照 -->
OpenAIドキュメント:http://localhost:8088/api/documentation  

## サンプルデータベースのテーマ
本プロジェクトのサンプルデータベースは、飲食店（レストラン）をテーマにしています。

**テーブル構成：**
- **shops（店舗）**: レストランなどの飲食店情報
- **menus（メニュー）**: 各店舗のメニュー情報
- **categories（カテゴリー）**: メニューのカテゴリ情報（ドリンク、フード、デザートなど）

- リレーション:
  - 1つの店舗（shops）は複数のメニュー（menus）を持つ（1対多）
  - 1つのメニュー（menus）は1つのカテゴリー（categories）に属する（多対1）

このテーマを使用して、N+1問題の検証やその他の学習目的に活用しています。

## 開発ルール
- ブランチ運用ルール
  - `main`: 本番用
  - `develop`: 開発用
  - `feature/xxx`: 新機能開発用
- コードフォーマット
  - pint を使用（`vendor/bin/pint`）
  - larastan を使用（`vendor/bin/phpstan analyse --memory-limit=1G`）

- コミットメッセージのルール
  - `[feat]` 新機能追加
  - `[fix]` バグ修正
  - `[docs]` ドキュメント更新
  - `[refactor]` コード整理（機能変更なし）
  - `[test]` テスト追加・修正
  - `[chore]` メンテナンス（ライブラリ更新など）




## ライセンス
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 作者
- 作成者: sawatch-fisherman
- GitHub: [sawatch.fisherman](https://github.com/sawatch-fisherman)
