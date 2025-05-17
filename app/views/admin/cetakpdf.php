<?php
require __DIR__ . '/../../../public/pdf/fpdf.php';


// Contoh data kegiatan Posyandu
$data = [
  ["2024-05-01", "Penimbangan Balita", "RW 01", "30 Anak"],
  ["2024-05-08", "Penyuluhan Gizi", "RW 02", "25 Anak"],
  ["2024-05-15", "Pemeriksaan Ibu Hamil", "RW 03", "15 Ibu"],
];

// Buat PDF baru
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Judul
$pdf->Cell(0, 10, 'Laporan Kegiatan Posyandu', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(5);

// Header tabel
$pdf->SetFillColor(255, 192, 203); // pink pastel 🍓
$pdf->Cell(40, 10, 'Tanggal', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Kegiatan', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Lokasi', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Jumlah Peserta', 1, 1, 'C', true);

// Isi tabel
foreach ($data as $row) {
  $pdf->Cell(40, 10, $row[0], 1, align: 'C');
  $pdf->Cell(60, 10, $row[1], 1, align: 'C');
  $pdf->Cell(40, 10, $row[2], 1, align: 'C');
  $pdf->Cell(40, 10, $row[3], 1, align: 'C');
  $pdf->Ln();
}

// Output PDF ke browser
$pdf->Output('I', 'Laporan_Posyandu.pdf');
?>