<?php
$jsonUrl = "./members/member.json";
if(file_exists($jsonUrl)){
	$json = file_get_contents($jsonUrl);
} else {
	exit("ERROR: ファイルが存在しません");
}

if(!empty($_POST)){
	$members = $_POST["member"];
	
	$membersTest = mb_convert_encoding($members, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
	$membersResult = json_decode($membersTest,true);
	if(!isset($membersResult)) { 
		echo "<script> alert('JSON形式じゃないじゃないか！'); </script>"; 
		$json = $members;
	}else {
		$fileName = "./members/member.json." . date('Y-m-d-His') . ".backup";
		file_put_contents($fileName, $json);

		$fileName = "./members/member.json";
		file_put_contents($fileName, $members);

		echo "<script> alert('JSONを保存しました');  location.href='./index.php'; </script>";
	}
}

$backupFiles = scandir('./members/');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href='./main.css'>
	<title>B20 Meeting Roulette</title>
</head>
<body>
	<div class="MainContent" id="MainContent">
		<h1>メンバーの編集</h1>
		<div>JSON形式で記述してね</div>
		<div>バックアップから選択もできるよ</div>
		<select name="memberBackups" id="memberBackups" size="5" style="width:500px;">
			<?php
			foreach ($backupFiles as $key => $value) {
				if(!strcmp($value, '.')) continue;
				if(!strcmp($value, '..')) continue;
				if(!strcmp($value, '.DS_Store')) continue;
				
				if(!strcmp($value, 'member.json')) {
					echo "<option value='" . $key . "'>最新版</option>";
				}else{
					echo "<option value='" . $key . "'>". $value ."</option>";
				}
			}
			?>
		</select>
		<br/><br/>
        <form action="./editMember.php" method="post">
            <textarea name="member" id="member" cols="80" rows="30">
<?= $json ?>
            </textarea><br/>
            <button type="submit" class="SubmitButton">保存</button>
        </form>
	</div>

<script>
	document.getElementById("memberBackups").onclick = function() {
		var param = "n=" + document.getElementById("memberBackups").value;
		var url = "readMember.php?" + param;
		var xhr= new XMLHttpRequest();		
        xhr.open('GET', url, true);
		xhr.send();
		xhr.onload=function(){
			document.getElementById("member").innerText =　xhr.responseText;
		}
	};
</script>

</body>
</html>
