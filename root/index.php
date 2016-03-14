<?php	require "header_index.php";
		$i = 1;
?>
			<article class="white">
				<div class="box-frame clearFix">
					<h3 class="contents-title r-float ">今月のオススメ</h2>
					<div class="triangle r-float animation1">
					</div>			
				</div>
				
		<?php while( $result = $pu_stmt -> fetch(PDO::FETCH_ASSOC) ): ?>
				<a href="./article.php?P_ID=<?php echo $result["P_ID"] ?>">
				<div class="box-frame clearFix align-center orange">
					<div class="l-float top-article-detail orange">
						<div class=" naname ">
							<h3 class="recomend-title text-shadow bold"><?php echo $result["P_TITLE"]; ?></h3>
						</div>
						<div class="large-large-photo align-center white">
							<img src="<?php echo $result['P_EYE'] ?>" alt="ピックアップ写真" class="large-large-photo_img">
						</div>
					</div>
		<?php endwhile; ?>

		
					<div class="l-float top-article-detail">
						<div class="sub-photo clearFix margin10 align-center">
						<?php while( $result = $pup_stmt -> fetch(PDO::FETCH_ASSOC) ): ?>
							<div class="small-photo l-float white">	
							<p><img src="<?php echo $result["C_PHOTO"] ?>" alt="ピックアップ写真" style="width:130px"></p>
							</div>
						<?php endwhile; ?>
						</div>
						<div class="shadow box-line3 align-center white">
							<?php while( $result = $pup_come -> fetch(PDO::FETCH_ASSOC) ): ?>
								<p class="article-text"><?php echo $result["P_AWORD"]; ?></p>
							<?php endwhile; ?>
						</div>
					</div>
				</div>
				</a>
		

				<div class="box-frame clearFix margin-none">
					<h3 class="contents-title r-float ">新着投稿</h2>
					<div class="triangle r-float">
					</div>			
				</div>				
				<div class="clearFix margin10 align-center">
		<?php while( $result = $np_stmt -> fetch(PDO::FETCH_ASSOC) ): ?>
			<?php if($i>3): ?>
					<a href="./article.php?P_ID=<?php echo $result["P_ID"] ?>" class="clear-text">
						<div class="box-4 white l-float ">
							<img class="photo4 white " src="<?php echo $result["P_EYE"] ?>" alt="ピックアップ写真">
							<div class="inline align-l">2days ago</div>
							<div class="inline align-r"><img src=""><?php echo $result["cnt"] ?></div>
						</div>
					</a>
			<?php else: ?>
					<a href="./article.php?P_ID=<?php echo $result["P_ID"] ?>" class="clear-text">
						<div class="box-3 white l-float ">
							<img class="photo3 white " src="<?php echo $result["P_EYE"] ?>" alt="ピックアップ写真">
							<div class="inline align-l">2days ago</div>
							<div class="inline align-r"><img src=""><?php echo $result["cnt"] ?></div>
						</div>
					</a>
			<?php $i++;
			 endif; ?>
		<?php endwhile; ?>
				<!--
					<div class="box-3 white l-float ">
						<img class="photo3 white" src="">
						<div class="inline align-l">2days ago</div>
						<div class="inline align-r"><img src="">123</div>
					</div>
					<div class="box-3 white l-float ">
						<img class="photo3 white" src="">
						<div class="inline align-l">2days ago</div>
						<div class="inline align-r"><img src="">123</div>
					</div>
				</div>
				
				<div class="clearFix margin10 align-center">
					<div class="box-4 white l-float">
						<img class="photo4 white" src="">
						<div class="inline align-l">2days ago</div>
						<div class="inline align-r"><img src="">123</div>
					</div>
					<div class="box-4 white l-float">
						<img class="photo4 white" src="">
						<div class="inline align-l">2days ago</div>
						<div class="inline align-r"><img src="">123</div>
					</div>
					<div class="box-4 white l-float">
						<img class="photo4 white" src="">
						<div class="inline align-l">2days ago</div>
						<div class="inline align-r"><img src="">123</div>
					</div>
					<div class="box-4 white l-float">
						<img class="photo4 white" src="">
						<div class="inline align-l">2days ago</div>
						<div class="inline align-r"><img src="">123</div>
					</div>
				</div>
				<div class="clearFix margin10 align-center">
					<div class="box-4 white l-float">
						<img class="photo4 white" src="">
						<div class="inline align-l">2days ago</div>
						<div class="inline align-r"><img src="">123</div>
					</div>
					<div class="box-4 white l-float">
						<img class="photo4 white" src="">
						<div class="inline align-l">2days ago</div>
						<div class="inline align-r"><img src="">123</div>
					</div>
					<div class="box-4 white l-float">
						<img class="photo4 white" src="">
						<div class="inline align-l">2days ago</div>
						<div class="inline align-r"><img src="">123</div>
					</div>
					<div class="box-4 white l-float">
						<img class="photo4 white" src="">
						<div class="inline align-l">2days ago</div>
						<div class="inline align-r"><img src="">123</div>
					</div>
				</div>
				-->
			</article>
			
<?php  require "footer.php"?>
			
