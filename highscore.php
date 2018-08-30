<html>
<head>
<title>KOMMANDO LIEBE - LOVE DEFENDER HIGHSCORE</title>
<style type="text/css">
body
{ 	
   padding: 0px:
   spacing: 0px;
   margin: 0px;
	width: 100%;
	height: 100%;
	overflow:hidden;
	background-color: black;
   color:silver;
   font-family: 'lucida' 'Courier';
   font-size: 0.39cm;
   line-height: 75%
   font-weight: normal;
   text-overflow:hidden;
}

table
{ 	
   padding: 0px:
   spacing: 0px;
   margin: 1px;
	width: 100%;
	overflow:hidden;
	background-color: black;
   color:silver;
   font-family: 'Courier';
   font-size: 0.29cm;
   line-height: 75%
   font-weight: normal;
   text-overflow:hidden;
}
.rd
{
    color: red;
    background-color: red;
}
small
{
  color: red;
}
.gr
{
    color: white;
    background-color: silver;
}

:visited {color: red}
:link    {color: red}
pre
{ font-family: Courier New, Courier, monospace; line-height: 95%; letter-spacing: 0pt; color: #222222; overflow: visible;} 
</style>


</head>
<body>
<table width="100%" height="100" cellspacing="0" cellpadding="0">
<tr>
<td rowspan="2">
<pre>
<span class="gr">****</span>    <span class="gr">**</span>    <span class="gr">**</span>    <span class="gr">****</span>
  <span class="gr">********************</span>
<span class="gr">****</span> <span class="rd">**</span>   <span class="gr">****</span> <span class="rd">**</span>   <span class="gr">****</span>
  <span class="gr">********************</span>
    <span class="gr">**</span>    <span class="gr">****</span>    <span class="gr">**</span>
    
      <span class="gr">****</span>    <span class="gr">****</span>
      <span class="gr">************</span>
</pre>
</td>
<td align="middle">
<u>
<nobr><span style="font-size: 1.6cm; color: red">LOVE DEFENDER</span></nobr>
</u>
</td>
<td rowspan="2">
<pre>
<span class="gr">****</span>    <span class="gr">**</span>    <span class="gr">**</span>    <span class="gr">****</span>
  <span class="gr">********************</span>
<span class="gr">****</span> <span class="rd">**</span>   <span class="gr">****</span> <span class="rd">**</span>   <span class="gr">****</span>
  <span class="gr">********************</span>
    <span class="gr">**</span>    <span class="gr">****</span>    <span class="gr">**</span>
    
      <span class="gr">****</span>    <span class="gr">****</span>
      <span class="gr">************</span>
</pre>
</td>

</tr>
<tr>
<td align="center">
<span style="font-size: 1.2cm"> HALL OF FAME</span>
</td>
</tr>
</table>
<hr>
<?

$score=$_GET["score"]/471;
$level=$_GET["level"]/471;
$accuracy=$_GET["accuracy"]/471;
$abonus=$_GET["abonus"]/471;
$rnd=$_GET["rnd"];
$betrug=FALSE;
$maxranks=15;
$l=0;            //Anzahl der Indizes der Highscoreliste
$zeit=time();
settype($rnd, "integer");

### lese highscore-tabelle ###

function read_highscore()
{
   global $highscore;
   global $l;
   $datei = fopen( "highscore.txt" , "r" );
   $l=0;
   while ( !FEOF ( $datei ) )
   {
      $line=fgets( $datei , 1024);
      $highscore[$l]=explode(";", $line);
      $l++;
      
   }
   fclose ( $datei );
	$l--;
}

function sort_table()
{
   global $highscore;
   global $l;
   global $zeit;  
   for($i=0;$i<$l;$i++) $highscore[$i][0]-=ceil(($zeit-$highscore[$i][4])/800); //ziehe Zeitstrafe ab
   rsort($highscore);
   for($i=0;$i<$l;$i++) $highscore[$i][0]+=ceil(($zeit-$highscore[$i][4])/800);//addiere Zeitstrafe wieder
}

### zeichne Tabelle ###
function draw_highscore()
{
   global $highscore;
   global $l;
   global $maxranks;
   global $zeit;

	$scorey="hallo";
	echo 
("
<table height='69%' border='2' cellspacing='2' cellpadding='1' style='font-size: 0.47cm;' id='tab'>
<tr><td><b>rank</b></td><td><b>name</b></td><td><b>score</b></td><td><b>level</b></td><td><b>accuracy</b></td><td><b>date</b></td></tr>
");
   $m=$l;if($m>$maxranks)$m=$maxranks;
   for($i=0;$i<$m; $i++)
	{
	 $penalty=ceil(($zeit-$highscore[$i][4])/1500);
	$r=$i+1;
   echo
   (
	 "   <tr>".
	 "<td>#<b>".$r."</b></td>".
	 "<td>".$highscore[$i][1]."</td>".
	 "<td>".$highscore[$i][0]."<small>-".$penalty."</td>".
	 "<td>".$highscore[$i][2]."</td>".
	 "<td>".$highscore[$i][3]."%</td>".
	 "<td>".date("d.M Y H:i",$highscore[$i][4])."</td>".
	 "</tr>\n"	 
   );
   } 
    echo("</table>\n");
}

function save_highscore()
{
	 global $highscore;
	 global $l;
        global $zeit;

    $datei = fopen( "highscore.txt" , "w" );
    for($i=0;$i<$l; $i++)
    {
      $line=implode(";", $highscore[$i]);
      fwrite($datei, $line);
    }
	 fclose ( $datei );
    unset ( $datei );
}

function highscore_entry()
{
	 global $score;
    global $abonus;
    global $accuracy;
    global $level;
	 global $rnd;
    printf("
    <script language='javascript' type='text/javascript'>
    name=prompt('HIGHSCORE!!!\\n\\nyour name?');");
	 $score=$score*471;
    $abonus*=471;
    $accuracy*=471;
    $level*=471;
    printf("str='highscore.php?score=%d&abonus=%d&accuracy=%d&level=%d&rnd=%d&name='+name;", $score, $abonus, $accuracy, $level, $rnd);
    echo(" 
    location.href=str;
    </script>");
}

function no_highscore_entry()
{
  	 global $score;
    global $abonus;
    global $level;
    printf
	 ("
	 <script language='javascript' type='text/javascript'>
    alert('GAME OVER.\\nNo highscore entry.\\n\\nscore: %d\\nlevel: %d\\naccuracy bonus: %d');
    </script>
	 ", $score, $level, $abonus);
}

### MAIN ###

read_highscore();
if($score!=ceil($score) or $accuracy!=ceil($accuracy) or $abonus!=ceil($abonus) )$betrug=TRUE; // Wenn's Kommazahlen sind, dann Betrug!!!
for($i=0;$i<$l;$i++)
{
    if($rnd==$highscore[$i][5]){$betrug=TRUE; break;}  //Wenn irgendwo die gleiche Zufallszahl auftaucht - dann Betrug!!!
}

if($score==0)$betrug=TRUE;  //bei null Punkten kein Eintrag
if(ereg("undefinded", $name))$betrug=TRUE;  //wenn name leer
if(ereg("null", $name))$betrug=TRUE;  //wenn name leer
//if($name==NULL)$betrug=TRUE;  //wenn name leer

if($betrug==FALSE)
{
if(isset($_GET["name"])&& !empty($_GET["name"]))
{
    $name=$_GET["name"];
	 $name=substr($name, 0, 32);
    $name=str_replace(";", " ", $name);
	 
	 $highscore[$l][0]=$score; 				

    $highscore[$l][1]=strip_tags($name);; 				
    $highscore[$l][2]=$level; 				
    $highscore[$l][3]=$accuracy;
    $highscore[$l][4]=time();
    $highscore[$l][5]=$rnd."\n";
    $l++;
    sort_table();
    save_highscore();
}
else
{
   if($l<$maxranks)highscore_entry(); //Wenn highscoretabelle noch nicht voll ist...
   else if ((($highscore[$maxranks-1][0]-(ceil($zeit-$highscore[$maxranks-1][4])/800)))<$score)highscore_entry();
	else no_highscore_entry();
}
}
draw_highscore();

?>
&copy 2005 by Kommando Liebe
<table border="0" width="100%">
<tr><td align="middle" width="33%"><a href="index.htm" style="font-size: 16pt">PLAY AGAIN</a></td><td align="middle" width="33%" style="font-size: 16pt; color: white" color="white"><a href="top100.php" style="font-size: 16pt; color: white" color="white"><b>TOP 100</b></a></td><td align="middle" width="33%"><a href="../index.htm" style="font-size: 16pt">BACK TO KOMMANDO LIEBE</a></td></tr>
</table>
</body>
</html>


