スパム対策用　禁止ワード・ＮＧワード集（ＢＬＯＧやリンク集を守る）

０．用途・目的
ＢＬＯＧや登録型検索エンジン・リンク集には、スパム防止の為に禁止ワード設定の
機能が有ります。しかし実際に設定しようとすると、非常に面倒なもの。
そこで、この禁止ワード・ＮＧワード集を利用すれば、簡単にスパム対策が出来ます。
１，６００件以上の禁止ワードを集めています。

１．NGwords.zip書庫ファイルを解凍して下さい。

２．各ファイルについての説明
・NGword_CR.TXT		ＮＧワードを改行で区切ってあります。（BLOG等向け）
・NGword_CSVTXT		ＮＧワードをカンマで区切ってあります。（Kent Web等向け）
・NGword_SP.TXT		ＮＧワードを空白で区切ってあります。（yomi-search等向け）
・NGword_yomi.TXT	yomi-search専用。
・readme.txt		この文章です

実際に規約違反のスパム投稿をして来たデータから、抽出したＮＧワードです。
また有名スパム業者が良く利用するＵＲＬ・ホスト名も入っています。（.org以降）
後者の一部は、某氏が公開されているデータを許可を得て自由に使用しております。

３．使用方法
・守りたいシステムが、どの形式の禁止ワードを受け入れるか確認して下さい。
・該当するファイルをエディタで開いて下さい。
★このままでは厳しい設定（国内のお堅いページ向け）になっていますので、
　不要なＮＧワードを削除します。だいたいジャンル毎に並んでいます。
　例えば娯楽関係が必要なら、該当部分を削除します。一般的語句も含まれます。
・出来上がったら、禁止ワード設定にお使い下さい。

４．参考
・yomi-searchの場合、yomi-search/pl/cfg.cgiの158行目に設定します。
　NGword_yomi.TXTの内容を設定して下さい。
　（管理画面から、NGword_SP.TXTの内容を設定しても同じです。）

・FC2 BLOGの場合、環境設定の変更−禁止設定で設定画面を出します。
　１０００文字分しか設定できませんので、NGword_CR.TXTから必要性の高そうな
　部分をコピーしてお使い下さい。
　ホスト名を「禁止ＩＰ・ホスト名」欄に設定します。
　ＮＧワードを「禁止ワード」欄に設定します。
　「禁止ルール(正規表現)を適用しない」を選択し、更新ボタンを押下します。
　文字数が足りない場合は、ＢＬＯＧ運営会社に要望して下さい。

５．その他
スパム対策用途であれば、自由に使って頂けます。著作権フリーです。
運用の結果生じた効果について、当方は一切責任を負いません。
設定する前に、ＮＧワードを充分吟味した上で、自己責任でお使い下さい。

６．参考（下記のサイトを参考にさせて頂きました。どうもありがとうございます。）
掲示板改造支援サイト　http://swanbay-web.hp.infoseek.co.jp/index.html
初心者の Yomi-Search ちょっとカスタマイズ　http://www5f.biglobe.ne.jp/~ayum/links/bbs/aska.html
禁止IP・禁止ワード設定方法/スパム対策講座-FC2ブログ-　http://blog.fc2.com/spam/guide1.html
ちょい悪オヤジのバイク、ジムニー他車三昧ｗ　http://blog.goo-net.com/dr-speedking/category_18/


by らんま
