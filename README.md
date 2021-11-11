# Timer

Todo期限や祝日までのカウントダウンを表示する

## :globe_with_meridians:URL
http://test

<br>
<br>

## :pencil2:本アプリについて

### 使い方
1. Todoリスト または 祝日 を選択する
2. 画面左側において、1でクリックした日付までのカウントダウンが開始される

![timer](https://user-images.githubusercontent.com/92190851/141295698-61cf1fbf-21a8-4af6-b747-5676bbd6530a.png)

### 機能

- Todoリスト登録、表示
- 祝日の取得、表示
- カウントダウン

### 特徴

- 外部API使用
- SPA（シングルページアプリケーション）

<br>
<br>

## :page_facing_up:技術仕様

### 基本情報
- 言語、フレームワーク
    - HTML, CSS, JavaScript, PHP
    - Vue.js 2.6.14, Laravel 8.68.1

- 開発環境
    - Windows 10 Home
    - docker (Apache 2.4.51, PHP 8.0.12, Mariadb 10.6.4)

- デプロイ環境
    - CentOS 7
    - Apache 2.4.6, PHP 8.0.12, Mariadb 10.6.4

- テスト
    - PHPUnit
    - Chromeデベロッパーツール

### 使用技術

- 外部APIとの連携（Laravel）
- 非同期通信Ajax（Vue.js）
- 親子コンポーネント間の受け渡し（Vue.js）
- データ参照、登録（Laravel）
- 日時操作（Javascript）
- カウントダウン（Vue.js）
