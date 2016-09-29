<?php 	
if (!isset($_SESSION)) {
  session_start();
}
//$xdata=array("Ini","Ene.","f","m","a","ma","ju","jul","ag");
//$ydata=array("0","20","50","40","25","30","25","15","18");
if(isset($_GET['tip'])){
require_once ('../jpgraph/jpgraph.php');
require_once ('../jpgraph/jpgraph_line.php');
$xdata=$_SESSION['xd'];
$ydata=$_SESSION['yd'];
unset($_SESSION['xd']);
unset($_SESSION['yd']);
// Create the graph. These two calls are always required

$graph1 = new Graph(600,300);
$graph1->SetScale('textlin');
$graph1->SetMargin(50,10,10,50);
$graph1->xaxis->SetTickLabels($xdata);
$graph1->xgrid->Show();
$graph1->ygrid->Show();

$graph1->xaxis->title->Set("Dias" );
$graph1->yaxis->title->Set($_GET['tip']);
$graph1->yaxis->SetTitleMargin(35);
//$graph->SetLegends($xdata);
// Create the linear plot
$lineplot1=new LinePlot($ydata);

//$lineplot1->grid->SetWeight(2);

// Add the plot to the graph
$graph1->Add($lineplot1);
$lineplot1->SetColor('blue');
$lineplot1->SetWeight (5);
// Display the graph
$graph1->Stroke();
}//fin de if($_GET['tip']){
if($_GET['pai']){
include_once("../conexion.php");
 if($_GET['pai']==1){
 $titg='Grafico Visitas Paises';
 $tity='% Visitas';
 $sqlp=mysql_query("select * from paises where visita>0 order by visita DESC LIMIT 0 , 30");
 $sqlpst=mysql_fetch_object(mysql_query("select sum(visita) as vt from paises where visita>0"));
			$sumav=$sqlpst->vt;
			$p=0;
			while($rowp=mysql_fetch_object($sqlp)){
			 //calculo de porcentaje
			  $por=round(($rowp->visita*100)/$sumav,2);
			  $bar=ceil(($rowp->visita*200)/$sumav);
			  $datay[$p]=$por;
			  $xdatal[$p]=$rowp->nombre;
			  $p=$p+1;
			  }
 }elseif($_GET['pai']==2){
 $titg='Grafico Hits Paises';
 $tity='% Hits';
  $sqlp=mysql_query("select * from paises where hit>0 order by hit DESC LIMIT 0 , 30");
 $sqlpst=mysql_fetch_object(mysql_query("select sum(hit) as vt from paises where hit>0"));
			$sumav=$sqlpst->vt;
			$p=0;
			while($rowp=mysql_fetch_object($sqlp)){
			 //calculo de porcentaje
			  $por=round(($rowp->hit*100)/$sumav,2);
			  $bar=ceil(($rowp->hit*200)/$sumav);
			  $datay[$p]=$por;
			  $xdatal[$p]=$rowp->nombre;
			  $p=$p+1;
			  }
 }//fin de if($_GET['pai']==1){		  
require_once ('../jpgraph/jpgraph.php');
require_once ('../jpgraph/jpgraph_bar.php');
 
//$datay=array(12,8,19,3,10,5);
 
// Create the graph. These two calls are always required
$graph = new Graph(1000,500);
$graph->SetScale('textlin');
 
// Add a drop shadow
$graph->SetShadow();
 
// Adjust the margin a bit to make more room for titles
$graph->SetMargin(40,30,20,150);
 
// Create a bar pot
$bplot = new BarPlot($datay);
 
// Adjust fill color
$graph->Add($bplot);
//$bplot->SetFillColor('orange');
$bplot->SetWidth(0.8);
//$bplot->SetShadow();
$bplot->value->Show();
//$bplot->SetValuePos('center');
 
// Setup the titles
$graph->title->Set($titg);
$graph->xaxis->title->Set('Paises');
$graph->xaxis->SetTitleMargin(50);
$graph->yaxis->title->Set($tity);
$graph->xaxis->SetTickLabels($xdatal);
$graph->xaxis->SetLabelAngle(90);
//$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,8);
//$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8);
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
 
// Display the graph
$graph->Stroke();
			  
?>

<?php }//fin de if($_GET['pai']){ ?>