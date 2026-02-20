# イラスト投稿サイト（学習用）

## 概要
- HTML
- CSS
- PHP
- MySQL

## 機能
### 公開ページ
- イラスト一覧表示
- イラスト詳細表示
### 管理ページ
- 管理者ログイン
- イラストの追加・削除・編集・参照

## 工夫した点
- 共通の処理をincludesフォルダにまとめた
- 直接管理ページのURLを打ち込まれた場合でも、ログインをしないとアクセスできないようにした

## 制作目的
職業訓練校で学んだ内容の理解を深めるため

## 注意点
- 管理画面からイラストを登録しようとすると、エラーが発生します。  これは、このサーバーがプログラムから新しくファイルを保存することを禁止しているためです。 ローカル環境(XAMPP)では以下の通り正常に動作します。(１枚目がadd_check.php、２枚目がedit_check.phpです。) <img width="1920" height="1080" alt="add_check" src="https://github.com/user-attachments/assets/b205f527-a047-4ea8-aade-a935df275dfd" />
<img width="1920" height="1080" alt="edit_check" src="https://github.com/user-attachments/assets/3d18fce2-a595-4eba-8ae7-bd99a21f29d8" />
