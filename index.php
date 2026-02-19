<?php
	require_once('includes/head_public.php');

	try{
		require_once('includes/db.php');

		$sql = 'SELECT code,picture FROM mst_Illustration WHERE 1';
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$dbh = null;
		
	} catch (Exception $e) {
?>
		<div class="detail-wrapper">
			<main class="illust-detail-body error-mode">
				<p class="exception-e ">ただいま障害により大変ご迷惑をお掛けしております。</p>
			</main>
		</div>
<?php
		require_once('includes/footer_public.php');
		exit();
	}
?>
		<p class="bar">2026 YURUME Rakugaki Website; 2026 YURUME Rakugaki Website; 2026 YURUME Rakugaki Website; 2026 YURUME Rakugaki Website; 2026 YURUME Rakugaki Website; 2026 YURUME Rakugaki Website;</p>


		<section class="hero">
			<div class="hero-inner">
				<h1 class="yurume-title">ゆるめ<br>らくがき記録</h1>
				<div class="about">
					<p>こちらはHTML、CSS、PHPの学習のため制作したWebサイトです。</p>
					<p>サイトの作者が趣味で描いたらくがきを掲載しています。</p>
				</div>
			</div>
		</section>
		<p class="scroll">..Scroll..</p>

		<main class="index-main">
			<div class="list">
				<h2 class="title">らくがき一覧</h2>
				<p>★ クリックまたはタップで詳細情報が表示されます ★</p>

				<div class="grid">
					<?php while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
						<div class="item">
							<a href="illust_detail.php?code=<?php print $rec['code']; ?>">
								<img src="admin/uploaded_pic/<?php print $rec['picture']; ?>">
							</a>
						</div>
					<?php } ?>
				</div>
			</div>
		</main>
<?php require_once('includes/footer_public.php'); ?>