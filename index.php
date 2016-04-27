<?php
// カウント数取得関数
function get_count($file) {
	$filename = 'data/'.$file.'.dat';
	$fp = @fopen($filename, 'r');
	if ($fp) {
		$vote = fgets($fp, 9182);
	} else {
		$vote = 0;
	}
	return $vote;
}
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ajaxVote</title>
<link rel="stylesheet" href="css/style.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
$(function() {
	allowAjax = true;
	$('.btn_vote').click(function() {
		if (allowAjax) {
			allowAjax = false;
			$(this).toggleClass('on');
			var id = $(this).attr('id');
			$(this).hasClass('on') ? Vote(id, 'plus') : Vote(id, 'minus');
		}
	});
});
function Vote(id, plus) {
	cls = $('.' + id);
	cls_num = Number(cls.html());
	count = plus == 'minus' ? cls_num - 1 : cls_num + 1;
	$.post('vote.php', {'file': id, 'count': count}, function(data) {
		if (data == 'success') cls.html(count);
		setTimeout(function() {
			allowAjax = true;
		}, 1000);
	});
}
</script>
</head>
<body>

<h1>ajaxVote</h1>

<article>

<section>

<p><img src="img/pic_01.jpg" width="100%" alt="綾北ダム"></p>

<div class="btn_area">

<h2>綾北ダム</h2>

<p class="ico_heart vote_01"><?= get_count('vote_01') ?></p>

<p class="btn_vote" id="vote_01"></p>

</div><!-- /btn_area -->

</section>

<section>

<p><img src="img/pic_02.jpg" width="100%" alt="鶴田ダム"></p>

<div class="btn_area">

<h2>鶴田ダム</h2>

<p class="ico_heart vote_02"><?= get_count('vote_02') ?></p>

<p class="btn_vote" id="vote_02"></p>

</div><!-- /btn_area -->

</section>

</article>

<footer>

<p>Copyright &copy; 2016<br>
<a href="//klutche.org">klutche.org</a> Allrights Reserved.</p>

</footer>

</body>
</html>