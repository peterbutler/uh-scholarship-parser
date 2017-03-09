<?php

// Include Composer autoloader if not already done.
include 'pdfparser/vendor/autoload.php';

// Parse pdf file and build necessary objects.
$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile('test_pdf.pdf');

$text = $pdf->getText();

$start_delim = 'Seniors - Scholarship season is underway!';
$end_delim = 'Seniors – Now that you have applied to college';
$entry_delim = "\n\n";

$first_split = explode( $start_delim, $text );

$second_split = explode( $end_delim, $first_split[1] );

$scholarship_text = $second_split[0];

$individual_scholarships  = preg_split( '|\n\s?\n|', $scholarship_text );

// Get rid of the first element, this is the rest of the delimiter implying the scholarship section is starting
array_shift( $individual_scholarships );

// Get rid of any elements that contain only a space
$individual_scholarships = array_map( 'trim', $individual_scholarships );

// Get rid fo any empty elements
array_filter( $individual_scholarships );

print_r( $individual_scholarships );