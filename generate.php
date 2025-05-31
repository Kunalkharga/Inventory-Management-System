<?php
require_once('includes/load.php'); // Include necessary files
require('./fpdf/fpdf.php'); // Include the FPDF library

// Check user permission level (optional, based on your system)
page_require_level(3);

// Fetch sales data from the database
$sales = find_all_sale();

// Retrieve Customer Details from POST request
$customer_id = isset($_POST['customer_id']) ? remove_junk($_POST['customer_id']) : 'Unknown';
$customer_name = isset($_POST['customer_name']) ? remove_junk($_POST['customer_name']) : 'Unknown';

// Create instance of FPDF class
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// Invoice Header
$pdf->Cell(190, 10, 'INVOICE', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 10, 'WET', 0, 1, 'C');
$pdf->Cell(190, 10, 'Near DAV, City', 0, 1, 'C');
$pdf->Ln(10); // Line break

// Customer and Invoice Details
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(140, 10, 'Customer ID: ' . $customer_id, 0, 0);
$pdf->Cell(90, 10, 'Date: ' . date('d-m-Y'), 0, 1);
$pdf->Cell(140, 10, 'Bill to: ' . $customer_name, 0, 0);
$pdf->Cell(90, 10, 'Invoice No: ORD' . rand(1000, 9999), 0, 1);
$pdf->Ln(10); // Line break

// Table Header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'S.No', 1, 0, 'C');
$pdf->Cell(60, 10, 'Description', 1, 0, 'C');
$pdf->Cell(20, 10, 'Qty', 1, 0, 'C');
$pdf->Cell(40, 10, 'Unit Price', 1, 0, 'C');
$pdf->Cell(30, 10, 'Sales Tax', 1, 0, 'C');
$pdf->Cell(30, 10, 'Total', 1, 1, 'C');

// Table Rows
$pdf->SetFont('Arial', '', 12);
$total = 0; // Variable to calculate the total amount
$serial_no = 1; // Serial number for each row

foreach ($sales as $sale) {
    $qty = (int)$sale['qty'];
    $price = (float)$sale['price'];
    $tax = $price * 0.3; // 13% sales tax
    $line_total = $qty * ($price + $tax);

    $pdf->Cell(10, 10, $serial_no, 1, 0, 'C');
    $pdf->Cell(60, 10, remove_junk($sale['name']), 1, 0, 'L');
    $pdf->Cell(20, 10, $qty, 1, 0, 'C');
    $pdf->Cell(40, 10, number_format($price, 2), 1, 0, 'R');
    $pdf->Cell(30, 10, number_format($tax, 2), 1, 0, 'R');
    $pdf->Cell(30, 10, number_format($line_total, 2), 1, 1, 'R');

    $total += $line_total;
    $serial_no++;
}

// Subtotal and Total
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(130, 5, '', 0, 0); // Empty space
$pdf->Cell(30, 10, 'Subtotal:', 0, 0, 'R');
$pdf->Cell(30, 10, number_format($total, 2), 1, 1, 'R'); // Subtotal

$pdf->Cell(130, 5, '', 0, 0); // Empty space
$pdf->Cell(30, 10, 'Total:', 0, 0, 'R');
$pdf->Cell(30, 10, number_format($total, 2), 1, 1, 'R'); // Total

// Output the PDF
$pdf->Output('I', 'invoice.pdf'); // Inline display of the PDF
?>
