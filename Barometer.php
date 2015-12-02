<?php  

ini_set('display_errors', 'On');
error_reporting(E_ALL);

/* phpinfo(); */
/* pChart library inclusions */
include("/home/pi/pChart/pChart2.1.4/class/pData.class.php");
include("/home/pi/pChart/pChart2.1.4/class/pDraw.class.php");
include("/home/pi/pChart/pChart2.1.4/class/pImage.class.php");

/* Create the pData object with some random values*/
$MyData = new pData();  
 
/* Import the data from a CSV file */
$MyData->importFromCSV("/var/ram/readings.csv",array("GotHeader"=>True)); 
$MyData->setSerieOnAxis("Temperature",0);
$MyData->setSerieOnAxis("Pressure",1);
/* Create the chart*/
$myPicture = new pImage(800,500,$MyData); 
$myPicture->setFontProperties(array("FontName"=>"/home/pi/pChart/pChart2.1.4/fonts/Forgotte.ttf","FontSize"=>10));
$myPicture->setGraphArea(60,60,750,450);
$myPicture->drawFilledRectangle(61,60,750,450,array("R"=>155,"G"=>155,"B"=>155,"Surrounding"=>-200,"Alpha"=>10));

$AxisBoundaries = array(0=>array("Min"=>0,"Max"=>30),1=>array("Min"=>950,"Max"=>1050));
$ScaleSettings = array("Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundaries,"DrawSubTicks"=>TRUE,"DrawArrows"=>TRUE,"ArrowSize"=>6);
$myPicture->drawScale($ScaleSettings);
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$myPicture->drawLineChart(array("DisplayValues"=>FALSE,"DisplayColor"=>DISPLAY_AUTO));
//$myPicture->setShadow(FALSE);

$myPicture->autoOutput("/var/ram/chart.png"); 
//$myPicture->Render("/var/ram/chart.png");
//$myPicture->Stroke("/var/ram/chart.png"); 
/* header('Content-type: image/png'); */
echo '<img src="file://localhost/var/ram/chart.png" width=700 height=100 />'; 
?>
