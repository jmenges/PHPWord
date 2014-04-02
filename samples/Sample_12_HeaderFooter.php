<?php
include_once 'Sample_Header.php';

// New Word document
echo date('H:i:s') , " Create new PhpWord object" , \EOL;
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// New portrait section
$section = $phpWord->addSection();

// Add first page header
$header = $section->addHeader();
$header->firstPage();
$table = $header->addTable();
$table->addRow();
$cell = $table->addCell(4500);
$textrun = $cell->addTextRun();
$textrun->addText('This is the header with ');
$textrun->addLink('http://google.com', 'link to Google');
$table->addCell(4500)->addImage(
    'resources/PhpWord.png',
    array('width' => 80, 'height' => 80, 'align' => 'right')
);

// Add header for all other pages
$subsequent = $section->addHeader();
$subsequent->addText("Subsequent pages in Section 1 will Have this!");

// Add footer
$footer = $section->addFooter();
$footer->addPreserveText('Page {PAGE} of {NUMPAGES}.', array('align' => 'center'));
$footer->addLink('http://google.com', 'Direct Google');

// Write some text
$section->addTextBreak();
$section->addText('Some text...');

// Create a second page
$section->addPageBreak();

// Write some text
$section->addTextBreak();
$section->addText('Some text...');

// Create a third page
$section->addPageBreak();

// Write some text
$section->addTextBreak();
$section->addText('Some text...');

// New portrait section
$section2 = $phpWord->addSection();

$sec2Header = $section2->addHeader();
$sec2Header->addText("All pages in Section 2 will Have this!");

// Write some text
$section2->addTextBreak();
$section2->addText('Some text...');


// Save file
$name = basename(__FILE__, '.php');
$writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf');
foreach ($writers as $writer => $extension) {
    echo date('H:i:s'), " Write to {$writer} format", \EOL;
    $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, $writer);
    $xmlWriter->save("{$name}.{$extension}");
    rename("{$name}.{$extension}", "results/{$name}.{$extension}");
}

include_once 'Sample_Footer.php';