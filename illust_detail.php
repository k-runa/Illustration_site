<?php
	$pic_code = $_GET['code'];
	
	require_once('includes/head_public.php');
	
	try {
		require_once('includes/db.php');

		$sql = 'SELECT picture,title,date,comment FROM mst_illustration WHERE code=?';
		$stmt = $dbh->prepare($sql);
		$data[] = $pic_code;
		$stmt->execute($data);

		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		$pic_picture = $rec['picture'];
		$pic_title = $rec['title'];
		$pic_date = $rec['date'];
		$pic_comment = $rec['comment'];

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

		<div class="detail-wrapper">
			<main class="illust-detail-body">
				<h1 class="title">ラクガキ詳細</h1>
				<div class="disp">
					<div class="disp-pic">
						<img src="admin/uploaded_pic/<?php print $pic_picture; ?>">
					</div>
					<div class="disp-text">
						<div class="disp-text-title">
							<p class="disp-title">タイトル：</p>
							<p class="disp-contents"><?php print $pic_title; ?></p>
						</div>

						<div class="disp-text-date">
							<p class="disp-title">制作日：</p>
							<p class="disp-contents">
								<?php 
									if ($pic_date === '0001-01-01' || $pic_date === '') {
										print '不明';
									} else {
										print $pic_date;
									}
								?>
							</p>
						</div>

						<div class="disp-text-comment">
							<p class="disp-title">コメント：</p>
							<p class="disp-contents"><?php print $pic_comment; ?></p>
						</div>
					</div>
				</div>
				<a href="index.php" class="back-btn">もどる</a>
			</main>
		</div>
				
<?php require_once('includes/footer_public.php'); ?>