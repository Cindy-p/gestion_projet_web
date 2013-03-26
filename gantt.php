<!DOCTYPE html>
<?php
	include ('gestion_base.php');
?>
		
<html>
	<head>
        <!-- <meta HTTP-EQUIV="content-type" CONTENT="text/html; charset=UTF-8"> -->
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		
		<table name='gantt' id="gantt" border="1" align="center" cellpadding="2" style="margin:auto; border:none; border-collapse:collapse;">
		
			<?php
				//récupération du projet
				$req = "select * from projet where projet_numero = ".$_GET['projet'];
				$res = mysql_query($req);
				$projet = mysql_fetch_assoc($res);
				
				echo "<h2 align=center>Projet ".$projet['projet_nom']."</h2>";
				
				//récupération des tâches du projet
				$req = "select * from tache where projet_numero = ".$_GET['projet'];
				$res = mysql_query($req); 
				
				while($tache = mysql_fetch_assoc($res)){
					//gestion des contraintes
					$req2 = "select * from contrainte where tache_numero_predecesseur = ".$tache['tache_numero'];
					$res2 = mysql_query($req2);
					if(mysql_num_rows($res2) > 0)
						$pre_fin[$tache['tache_numero']] = $tache['tache_duree'];
				}
 				
				mysql_free_result($res);
				$res = mysql_query($req);
				
				while($tache = mysql_fetch_assoc($res)){
					$max = 0;
					$req2 = "select * from contrainte where tache_numero_successeur = ".$tache['tache_numero'];
					$res2 = mysql_query($req2);
					if(mysql_num_rows($res2) > 0){
						while($pre = mysql_fetch_assoc($res2)){
							if($pre_fin[$pre['tache_numero_predecesseur']] > $max)
								$max = $pre_fin[$pre['tache_numero_predecesseur']];
						}
							if(isset($pre_fin[$tache['tache_numero']])){
								$pre_fin[$tache['tache_numero']] = $max + $tache['tache_duree'];
								$pre_debut[$tache['tache_numero']] = $pre_fin[$tache['tache_numero']] - $tache['tache_duree'];
							}
					}
				}
				
				mysql_free_result($res);
				$res = mysql_query($req);
				
				while($tache = mysql_fetch_assoc($res)){
					$max = 0;
					$nbCol = 0;
					$delai = 0;
					echo "<tr> <td style='border-right:none; border-color:grey;'>".$tache['tache_nom']."</td>";
					
					$req2 = "select * from contrainte where tache_numero_successeur = ".$tache['tache_numero'];
					$res2 = mysql_query($req2);
					
					while($pre = mysql_fetch_assoc($res2)){	
						if($pre['classe'] == 1 && ($pre_fin[$pre['tache_numero_predecesseur']] >= $max))
							$max = $pre_fin[$pre['tache_numero_predecesseur']];
						if($pre['classe'] == 2 && ($pre_debut[$pre['tache_numero_predecesseur']] >= $max))
							$max = $pre_debut[$pre['tache_numero_predecesseur']];
							
						$delai =  $pre['delai'];
					}
					
					if(($max + $tache['tache_duree'] + $delai) > $nbCol)
						$nbCol = $max + $tache['tache_duree'] + $delai;
						
					//echo "<td width='30px' style='border:none;'/>";
					
					if ($max != 0)
						echo "<td width='30px' colspan='$max' style='border-color:white;'></td>";
					echo "<td width='30px' colspan='".$tache['tache_duree']."' bgcolor='#4f81bd' style='border-color:white;'></td>";
					if ($delai != 0)
						echo "<td width='30px' colspan='$delai' bgcolor='#f79646' style='border-color:white;'></td>";

					echo "</tr>";
				}
				
				echo "<tr>";
				//echo "<td style='border:none;'/>";
				echo "<td style='border:none;'/>";
				for($i = 1 ; $i <= $nbCol ; $i++)
					echo "<td width='30px' align = 'center' style='border-bottom:none; border-color:grey;'>".$i."</td>";
				echo "</tr>";
				
			?>
		</table>
	</body>
</html>

