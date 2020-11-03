<?php
$jsonUrl = "./members/member.json";
if(file_exists($jsonUrl)){
	$json = file_get_contents($jsonUrl);
	$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
	$member = json_decode($json,true);
} else {
	exit("ERROR: ファイルが存在しません");
}
?><!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href='./main.css'>
	<title>B20 Meeting Roulette</title>
	<script> var rowCnt = 0; </script>
</head>
<body>
	<div class="MainContent" id="MainContent">
		<h1>月例会の順番を決めるくん（v1.0）</h1>
		<div>
			<a href="./members/member.json">member.json</a>にメンバー情報を保存しています。<br/>
			<!--メンバーの編集は<a href="./editMember.php">こちら</a>から-->
		</div>
		<h2>出席者リスト</h2>

		<form action="./result.php" method="get" id="form">
			<div id="memberList">
				<?php
				$cnt = 1;
				foreach ($member as $row) {
					?>
					<input type="text" size=10 value='<?=$row["number"]?>' name='number<?=$cnt?>'><input type="text" value='<?=$row["name"]?>' name='name<?=$cnt?>'><button type="button" name='del<?=$cnt?>' onclick="DeleteRow(<?=$cnt?>)">-</button>
					<br id='br<?=$cnt?>'/>
				<?php
					$cnt++;
					echo("<script> rowCnt++; </script>");
				}
				?>
			</div>
			<button type="button" class="AddRowButton" onclick="AddRow()">＋</button><br/>
			<button type="submit" class="SubmitButton">ルーレット開始！</button><br/>
		</form>
	</div>
	<script src="./main.js"></script>
</body>
</html>

