<?php
$pdf = new FPDF("p", "cm", "A4"); //orientasi kertas (p/l), satuan kertas(cm/mm), ukuran kertas
$pdf->AddPage();
$pdf->SetTitle("Laporan Data Prodi");
$pdf->SetFont("Arial", "B", "12"); //setfont(jenis font, style B, ukuran font) setfont berlkau sampai ada setfont berikutnya
$pdf->Cell(19, 1, "Kemahasiswaan Uniska Banjarmasin", 0, 1, "C");
//cell - TExtbox (lebar, tinggi, teks, border(0,1), posisi cell selanjutnya (0,1), perataan teks(c,r,l,j))
$pdf->SetFont("Arial", "", "11");
$pdf->Cell(19, 1, "Alamat: Jl. Simpang Adhyaksa. Sungai Miai Kec. Banjarmasin Utara", 0, 1, "C");
$pdf->Line(1, 3, 20, 3); //line untuk membuat garis dengan 4 parameter(x1, y1, x2, y2)
$pdf->ln();
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(5, 1, "Laporan Data Prodi", 0, 1, "C");
$pdf->ln();
$pdf->SetFont("Arial", "B", 11);
$pdf->SetFillColor(0, 255, 0); //mengatur baground cell
$pdf->Cell(4, 1, "No", 1, 0, "C", true); //nilai true pada cell untuk mengaktifkan background dari cell
$pdf->Cell(8, 1, "Nama Prodi", 1, 1, "C", true);
$pdf->SetFont("Arial", "", 11);
$no = 1;
foreach ($prodi as $a) {
    $pdf->Cell(4, 1, $no++, 1, 0, "C");
    $pdf->Cell(8, 1, $a->nama_prodi, 1, 1, "C");
}
$pdf->Output();
