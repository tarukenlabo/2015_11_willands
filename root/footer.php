			<footer class="l-float">
				<div class="fotter_logo l-float">
					<img src="./img/tarunavi_logo_footer.png" >
				</div>
				
					<ul class="l-float footer_nav">
						<li style="padding-left:12px"><a href="./index.php">たるナビトップ</a></li>
						<?php if(isset($_SESSION['u_id'])): ?>
							<li style="padding-left:12px"><a href="./log-out.php">ログアウト</a></li>
						<?php else: ?>
							<li style="padding-left:12px"><a href="./log-in.php">ログイン</a></li>
						<?php endif; ?>
						<li style="padding-left:12px"><a href="./new-member.php">会員登録</a></li>
						<li style="padding-left:12px"><a href="./terms.php">利用規約</a></li>
						<li style="padding-left:12px"><a href="./policy.php">プライバシーポリシー</a></li>
						<li style="padding-left:12px"><a href="./faq.php"">FAQ</a></li>
						<li style="padding-left:12px"><a href="./contact.php">お問い合わせ</a></li>
					</ul>
				
			</footer>
		</div>
	</body>	
</html>