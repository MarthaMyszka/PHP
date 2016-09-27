<!DOCTYPE html>
<html>
<head>
	<title>Dodaj wpis</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="UTF-8">
</head>
<body>

<h1>kółko krzyżyk</h1>


<table border="1">
<form action ="plansza.php" method="POST">
<?php
session_start();

if(isset($_GET['reset'])){
	$_SESSION['plansza'] = NULL;
}

if(!isset($_SESSION['plansza'])){
	
	$plansza=[];

	for($x=1; $x <=3; $x++){
		
		for($y=1; $y <=3; $y++){
				$plansza[$x][$y] = NULL;
		}
	}
}else{
	$plansza = $_SESSION['plansza'];
}

if(!isset($_GET['gracz'])){
$gracz = rand(1,2);
$_SESSION['rozpoczal'] = $gracz;

}else{
	$gracz = $_GET['gracz'];
}

function gracz($gracz){
	if($_SESSION['rozpoczal'] == 1){
		echo 'grę rozpoczyna O<br/><br/>'; //1 X
	}else{
		echo 'grę rozpoczyna X<br/><br/>'; //2 O
	}
}
gracz($gracz);
echo "<br/>";

/*
function ruch($x, $y, $gracz){
	if(($_GET['x'])== $x && ($_GET['y']) ==$y){
		if($gracz == 1){
			echo 'O';
		}
		if($gracz == 2){
			echo 'X';	
		}
	}
}
*/

if(isset($_GET['gracz']) && isset($_GET['x']) && isset($_GET['y'])){
	if(empty($plansza[$_GET['x']][$_GET['y']])){
		$plansza[$_GET['x']][$_GET['y']] = $_GET['gracz'];
		$_SESSION['plansza'] = $plansza;
	}
}


$czyKoniec = 0;

	
	//wiersze
	for($i=1; $i < 4; $i++){

		if($plansza[$i][1]== NULL){
			continue;
		}
		if(($plansza[$i][1] == $plansza[$i][2]) && ($plansza[$i][2] == $plansza[$i][3])){
			echo $wygrana = "wygrana<br/>";
			$czyKoniec = 1;
			echo "koniec gry";
		}
	}
	
	//kolumny
	for($j=1; $j < 4; $j++){

		if($plansza[1][$j]== NULL){
			continue;
		}
		if(($plansza[1][$j] == $plansza[2][$j]) && ($plansza[2][$j] == $plansza[3][$j])){
			echo "wygrana<br/>";
			$czyKoniec = 1;
			echo "koniec gry<br/>";
		}
	}
	
//przekatna
	if($plansza[1][1] != NULL){
		if(($plansza[1][1] == $plansza[2][2]) && ($plansza[2][2] == $plansza[3][3])){
			echo "wygrana<br/>";
			$czyKoniec = 1;
			echo "koniec gry<br/>";
		}
	}
	if($plansza[1][3] != NULL){
		if(($plansza[1][3] == $plansza[2][2]) && ($plansza[2][2] == $plansza[3][1])){
			echo "wygrana<br/>";
			$czyKoniec = 1;
			echo "koniec gry<br/>";
		}
	}

//czy jakies pole jest nullem
//jesli jakies pole jest null to nie ma remisu, jesli wszystkie sa wypelnione i nie ma wygrana to remis.
$licz = 0;
for($z = 1; $z < 4; $z++){
	for($y = 1; $y < 4; $y++){
		if($plansza[$z][$y] == NULL){
		}else{
			$licz += 1;
		}
	}
}
if($licz == 9){
				echo "remis";
			}
	
	foreach($plansza as $x => $wiersz){
		echo '<tr>';

		foreach($wiersz as $y => $pole){
			if($gracz == 1){
				$przeciwnik = 2;
			}else{
				$przeciwnik = 1;
			}
			echo "<td>";
			if($czyKoniec == 0){
				echo "<a href='plansza.php?gracz=".$przeciwnik."&x=".$x."&y=".$y."'>";
			}
				echo '.';
				
					/*
					if(isset($_GET['gracz']) && isset($_GET['x']) && isset($_GET['y'])){
					ruch($x, $y, $gracz);
					}
					*/
					if($pole == 1){
						echo 'X';
					}else if($pole == 2){
						echo 'O';
					}else{
						echo '-';
					}
			if($czyKoniec == 0){
				echo "</a>";
			}
			echo "</td>";
		}
		echo '</tr>';
	}

?>
</form>
</table>
<br />
<a href="/gra/plansza.php?reset=1">rozpocznik od nowa</a>
</body>
</html>