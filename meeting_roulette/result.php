<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href='./main.css'>
	<title>B20 Meeting Roulette</title>
</head>
<body>
	<div class="MainContent">
		<h1>結果発表</h1>
		<h2>発表順</h2>

        <?php
        $member = $_GET;
        //$member number, member

        $rands = [];
        $min = 1; 
        $max = 1000; //頭ワルワル設計
        $cnt = 1;

        for($i = $min; $i <= $max; $i++){
            while(true){
                $eflug = FALSE;
                $num = rand($min, $max);
                //該当したオブジェクトの「学籍番号が空欄」かつ「名前が空欄」の時の結果と「既に登場していなければ(1人1回だけ)」
                if ((empty($member["number".$num]) && empty($member["name".$num])) && !in_array($num, $rands)) $eflug = TRUE;
                if( ! in_array( $num, $rands ) ){
                    array_push( $rands, $num );

                    if ($eflug==FALSE) {
                        echo $cnt . ": " .$member["number".$num] . "\t" . $member["name".$num] . "<br/>";
                        $results[$cnt]["number"] = $member["number".$num];
                        $results[$cnt]["name"] = $member["name".$num];
                        $cnt++;
                    }
                    break;
                }
                echo $eflug;
            }
        }
        ?>

        <h2>Markdown出力</h2>
        <textarea readonly name="" id="" cols="60" rows="30">
|     | 学籍番号 | 発表者 |
| --- | -------- | ------ |
<?php
        $cnt=1;
        foreach($results as $row) {
            echo "| " . $cnt . "\t| " . $row["number"] . "\t| " . $row["name"] . "\t|\n";
            $cnt++;
        }
?>
        </textarea>

        <h2>JSON出力</h2>
        <textarea readonly name="" id="" cols="60" rows="30">
<?php echo( json_encode($results) ); ?>
        </textarea>

        <br/><br/><br/>
        <button onclick="window.location.reload();" class="SubmitButton">異議あり！</button>
    </div>
</body>
</html>