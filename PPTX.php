<?php
require_once 'PhpPresentation/src/PhpPresentation/Autoloader.php';
\PhpOffice\PhpPresentation\Autoloader::register();
require_once 'PhpOffice/src/Common/Autoloader.php';
\PhpOffice\Common\Autoloader::register();

$objPHPPowerPoint = new PhpPresentation();
use PhpOffice\PhpPowerpoint\PhpPowerpoint;
use PhpOffice\PhpPowerpoint\IOFactory;
use PhpOffice\PhpPowerpoint\Style\Alignment;
use PhpOffice\PhpPowerpoint\Style\Color;
use PhpOffice\PhpPowerpoint\Shape\MemoryDrawing;
use PhpOffice\PhpPowerpoint\Style\Fill;
$currentSlide = $objPHPPowerPoint->getActiveSlide();

$shape = $currentSlide->createDrawingShape();
$shape->setName('PHPPresentation logo')
      ->setDescription('PHPPresentation logo')
      ->setPath('./resources/phppowerpoint_logo.gif')
      ->setHeight(36)
      ->setOffsetX(10)
      ->setOffsetY(10);
$shape->getShadow()->setVisible(true)
                   ->setDirection(45)
                   ->setDistance(10);


$shape = $currentSlide->createRichTextShape()
      ->setHeight(300)
      ->setWidth(600)
      ->setOffsetX(170)
      ->setOffsetY(180);
$shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
$textRun = $shape->createTextRun("Thank you for using PHPPresentation!");
$textRun->getFont()->setBold(true)
                   ->setSize(60)
                   ->setColor( new Color( 'FFE06B20' ) );

$oWriterPPTX = IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');
$oWriterPPTX->save(__DIR__ . "/sample.pptx");
$oWriterODP = IOFactory::createWriter($objPHPPowerPoint, 'ODPresentation');
$oWriterODP->save(__DIR__ . "/sample.odp");
?>