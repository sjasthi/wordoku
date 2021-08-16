<html>  
<head>  
<title>ShotDev.Com Tutorial</title>  
</head>  
<body>  
<?php
  
//*** Constant ***//  
$ppLayoutTitle = 2;  
  
//*** Font Color ***//  
$wdColorLightGreen  = "&HCCFFCC";  
$wdColorBlue = "&HFF0000";  
  
$ppApp = new COM("PowerPoint.Application");  
  
$strPath = realpath(basename(getenv($_SERVER["SCRIPT_NAME"]))); //  C:/AppServ/www/myphp  
$ppName = "MyPP/MyPPt.ppt";   
  
$ppPres = $ppApp->Presentations->Add();  
  
$ppSlide1 = $ppPres->Slides->Add(1,$ppLayoutTitle);  
//$ppSlide1->Shapes->AddPicture(realpath("logo.gif"),0,1,250,330,200,100); 
//*** AddTextbox,  objControl.Left,objControl.Top,objControl.Width,objControl.Height ***//  
$ppSlide1->Shapes->AddTextbox(1,50,100,700,100);  //***4  
$ppSlide1->Shapes(1)->TextFrame->TextRange->Text = "I Love ShotDev.Com 1";  
$ppSlide1->Shapes(1)->TextFrame->TextRange->Font->Name =  "Arial";  
$ppSlide1->Shapes(1)->TextFrame->TextRange->Font->Size =  20;  
//$ppSlide1->Shapes(1)->TextFrame->TextRange->Font->Color  =  $wdColorLightGreen;  

  $ppSlide2 = $ppPres->Slides->Add(1,$ppLayoutTitle);  
 // $ppSlide2->Shapes->AddPicture(realpath("logo.gif"),0,1,250,330,200,100); 
$ppSlide2->Shapes->AddTextbox(1,50,100,700,100);  
$ppSlide2->Shapes(2)->TextFrame->TextRange->Text = "I Love  ShotDev.Com 2";  
$ppSlide2->Shapes(2)->TextFrame->TextRange->Font->Name =  "Arial";  
$ppSlide2->Shapes(2)->TextFrame->TextRange->Font->Size =  20;  

  $ppSlide3 = $ppPres->Slides->Add(1,$ppLayoutTitle);  
 // $ppSlide3->Shapes->AddPicture(realpath("logo.gif"),0,1,250,330,200,100); 
  
$ppSlide3->Shapes->AddTextbox(1,50,100,700,100);  
$ppSlide3->Shapes(3)->TextFrame->TextRange->Text = "I Love  ShotDev.Com 3";  
$ppSlide3->Shapes(3)->TextFrame->TextRange->Font->Name =  "Arial";  
$ppSlide3->Shapes(3)->TextFrame->TextRange->Font->Size =  20;  

  $ppSlide4 = $ppPres->Slides->Add(1,$ppLayoutTitle);
 // $ppSlide4->Shapes->AddPicture(realpath("logo.gif"),0,1,250,330,200,100); 
$ppSlide4->Shapes->AddTextbox(1,50,100,700,100);  
$ppSlide4->Shapes(4)->TextFrame->TextRange->Text = "I Love  ShotDev.Com 4";  
$ppSlide4->Shapes(4)->TextFrame->TextRange->Font->Name =  "Arial";  
$ppSlide4->Shapes(4)->TextFrame->TextRange->Font->Size =  20;  

   $ppSlide5 = $ppPres->Slides->Add(1,$ppLayoutTitle);
   //$ppSlide5->Shapes->AddPicture(realpath("logo.gif"),0,1,250,330,200,100); 
$ppSlide5->Shapes->AddTextbox(1,50,100,700,100);  
$ppSlide5->Shapes(5)->TextFrame->TextRange->Text = "I Love  ShotDev.Com 5";  
$ppSlide5->Shapes(5)->TextFrame->TextRange->Font->Name =  "Arial";  
$ppSlide5->Shapes(5)->TextFrame->TextRange->Font->Size = 20;  
//$ppSlide5->Shapes(5)->TextFrame->TextRange->Font->Color  =  $wdColorBlue;  
  
   //*** Picture,Left,Top,Width,Height ***//  
  
  
$ppApp->Presentations[1]->SaveAs($strPath."/".$ppName);  
//$ppApp->Presentations[1]->SaveAs(realpath($ppName));  
  
$ppApp->Quit;  
$ppApp = null;  
?>  
PowerPoint Created <a href="<?=$ppName?>">Click  here</a> to Download.  
</body>  
</html>  