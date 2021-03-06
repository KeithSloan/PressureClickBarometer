<?php  

//ini_set('display_errors', 'On');
//error_reporting(E_ALL);

// phpinfo(); 
/* pChart library inclusions */
include("../pChart/class/pData.class.php");
include("../pChart/class/pDraw.class.php");
include("../pChart/class/pImage.class.php");

/* Create the pData object with some random values*/
$MyData = new pData();  
 
/* Import the data from a CSV file */
$MyData->importFromCSV("/var/ram/readings.csv",array("GotHeader"=>True,"SkipColumns"=>array(0))); 

$MyData->setPalette("Temperature",array("R"=>0,"G"=>128,"B"=>0));
$MyData->setPalette("CPU-Temp",array("R"=>128,"G"=>0,"B"=>128));
$MyData->setPalette("Pressure",array("R"=>255,"G"=>0,"B"=>0));

$MyData->setSerieOnAxis("Temperature",0);
$MyData->setSerieOnAxis("CPU-Temp",1);
$MyData->setSerieOnAxis("Pressure",2);
$MyData->setAxisName(0,"Temperature");
$MyData->setAxisName(1,"Temperature"); 
$MyData->setAxisName(2,"Pressure");
$MyData->setAxisPosition(1,AXIS_POSITION_RIGHT); 

/* Get latest value before reversing Series for plotting */
$latest=$MyData->Data['Series']['Pressure']['Data'][0];
/* Reverse series so latest value is on the right */
$MyData->reverseSerie("Temperature");
$MyData->reverseSerie("CPU-Temp");
$MyData->reverseSerie("Pressure");
$earliest=$MyData->Data['Series']['Pressure']['Data'][0];
/* Create the chart*/
$myPicture = new pImage(800,500,$MyData); 
$myPicture->setFontProperties(array("FontName"=>"/var/www/html/pChart/fonts/Forgotte.ttf","FontSize"=>10));
$myPicture->setGraphArea(90,60,750,450);
/* Title of Chart */
$myPicture->drawText(395,55,"BAROMETER",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));
$myPicture->drawText(163,55,"Earliest Pressure :",array("FontSize"=>16,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));
$myPicture->drawText(255,55,$earliest,array("FontSize"=>16,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));
$myPicture->drawText(637,55,"Latest Pressure :",array("FontSize"=>16,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));
$myPicture->drawText(718,55,$latest,array("FontSize"=>16,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));
$latest=$MyData->Data['Series']['Pressure']['Data'][1];
$myPicture->drawFilledRectangle(90,60,750,450,array("R"=>0,"G"=>155,"B"=>155,"Surrounding"=>-200,"Alpha"=>10));
$AxisBoundaries = array(0=>array("Min"=>0,"Max"=>70),1=>array("Min"=>0,"Max"=>70),2=>array("Min"=>980,"Max"=>1020));
$ScaleSettings = array("Mode"=>SCALE_MODE_MANUAL,"ManualScale"=>$AxisBoundaries,"DrawSubTicks"=>TRUE,"DrawArrows"=>TRUE,"ArrowSize"=>6,"CycleBackground"=>TRUE,"GridR"=>102,"GridG"=>102,"GridB"=>102,"DrawXLines"=>TRUE,"DrawYLines"=>array(2),"LabelSkip"=>11);
$myPicture->drawScale($ScaleSettings);
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$myPicture->drawLineChart(array("DisplayValues"=>FALSE,"DisplayColor"=>DISPLAY_AUTO));
//$myPicture->setShadow(FALSE);

/* Write the chart legend */
$myPicture->drawLegend(550,430,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));
$myPicture->autoOutput("/var/ram/chart.png"); 
//$myPicture->Render("/var/ram/chart.png");
//$myPicture->Stroke("/var/ram/chart.png"); 
/* header('Content-type: image/png'); */
echo '<img src="file://localhost/var/ram/chart.png" width=700 height=100 />'; 
?>
