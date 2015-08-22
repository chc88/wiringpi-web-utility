<?php

require 'wiringpi.php';

$pins = Array(0, 1, 2, 3, 4, 5, 6, 7, 17, 18, 19, 20);
$listAll = true;

$usage=array(
			3=>'Name of',
			4=>'port for whatever',
			5=>'project you are',
			6=>'useing tese ports for',
			);
if (isset($_GET['c'])) {
	if ($_GET['c'] == 'pm') {
		wiringpi::pinMode($_GET['p'], $_GET['v']);
	}

	if ($_GET['c'] == 'dw') {
		wiringpi::digitalWrite($_GET['p'], $_GET['v']);
	}
}

?>
<!doctype html>
<html>
<head>
	<title>WiringPi Web GPIO Utility</title>
	
	<meta name="HandheldFriendly" content="true" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

	<style type="text/css">
		html, body { background-color: #EEE; }
		
		h1 { font-size: 24px; }
		a { color: #000; }
		
		table {
			border-collapse: collapse;
			border-spacing: 0;
			font-size: 16px;
		}
		
		table thead tr {
			background: #a8a8a8; /* Old browsers */
			background: -moz-linear-gradient(top,  #dddddd 0%, #a8a8a8 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#dddddd), color-stop(100%,#a8a8a8)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top,  #dddddd 0%,#a8a8a8 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top,  #dddddd 0%,#a8a8a8 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  #dddddd 0%,#a8a8a8 100%); /* IE10+ */
			background: linear-gradient(to bottom,  #dddddd 0%,#a8a8a8 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#dddddd', endColorstr='#a8a8a8',GradientType=0 ); /* IE6-9 */
		}
	
		table tr.odd { background-color: #D5D5D5; }
		table tr td { padding: 7px; }
		
		table tr td.green { background-color: #51FF51; }
		table tr.odd td.green { background-color: #3FE93F; }
		table tr td.red { background-color: #FD7878; }
		table tr.odd td.red { background-color: #FF5A5A; }
		table tr td.blue { background-color: #A5A5FF; }
		table tr.odd td.blue { background-color: #8686FF; }
		table tr td.orange { background-color: #FDCF70; }
		table tr.odd td.orange { background-color: #FFC144; }
	</style>
</head>
<body>
	<h1>WiringPi GPIO Web Utility</h1>
	<table>
		<thead>
			<tr>
				<td>Pin</td>
				<td>GPIO</td>
				<td>Phys</td>
				<td>Name</td>
				<td>Mode</td>
				<td>Value</td>
				<td>Usage</td>
			</tr>
		</thead>
		<tbody>
<?php

$even = false;
exec('gpio readall', $readall);
for ($i = 3; $i < (count($readall) - 1); $i++) {
	$row = explode('|', $readall[$i]);
	$ports=array();
	if(count($row)==8)
		$ports[]=$row;
	if(count($row)==15){
		$arr = array();
		$arr[1] = $row[2]; //pin
		$arr[2] = $row[1]; //gpio
		$arr[3] = $row[6]; //phys
		$arr[4] = $row[3]; //name
		$arr[5] = $row[4]; //mode
		$arr[6] = $row[5]=='1' ? 'High' : 'Low'; //value
		$ports[]=$arr;
		$arr = array();
		$arr[1] = $row[12]; //pin
		$arr[2] = $row[13]; //gpio
		$arr[3] = $row[8]; //phys
		$arr[4] = $row[11]; //name
		$arr[5] = $row[10]; //mode
		$arr[6] = $row[9]=='1' ? 'High' : 'Low'; //value
		$ports[]=$arr;
	}
	foreach($ports as $port){
		$pin = intval(trim($port[1]));
		if ($listAll || in_array($pin, $pins)) {
			$mode = trim($port[5]);
			$value = trim($port[6]);
		
			echo '<tr class="'.(($even) ? 'even' : 'odd').'">';
			echo '<td>'.$pin.'</td>';
			echo '<td>'.trim($port[2]).'</td>';
			echo '<td>'.trim($port[3]).'</td>';
			echo '<td>'.trim($port[4]).'</td>';
			echo '<td class="'.(($mode == 'IN') ? 'orange' : 'blue').'"><a href="?c=pm&p='.$pin.'&v='.(($mode == 'IN') ? '1' : '0').'">'.$mode.'</a></td>';
			echo '<td class="'.(($value == 'High') ? 'green' : 'red').'">';
			if(!in_array($mode,array('OUT')))
				echo $value;
			else
				echo '<a href="?c=dw&p='.$pin.'&v='.(($value == 'High') ? '0' : '1').'">'.$value.'</a>';
			echo '</td>';
			echo '<td>'.(isset($usage[$pin]) ? $usage[$pin] : '').'</td>';
			echo '</tr>';
		
			$even = !$even;
		}
	}
}

?>
		</tbody>
	</table>
	<p>Created by Travis Brown; Last-update: CHC</p>
</body>
</html>
