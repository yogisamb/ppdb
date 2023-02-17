<?php
$pdf = new TCPDF('', 'mm', 'A4');
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->AddPage('P');

// kop
$pdf->Image('assets/images/logosekolah/logoyayasan.jpeg', 10, 10, 16, 0, 'JPEG');
$pdf->Image('assets/images/logosekolah/bintang-juara-logo.png', 180, 7, 21, 0, 'PNG');
$pdf->SetFont('', '', 9);
$pdf->Cell(0, 1, 'YAYASAN DEWI SARTIKA SEMARANG', 0, 1, 'C');
$pdf->SetFont('', 'B', 13);
$pdf->Cell(0, 1, 'SEKOLAH DASAR ISLAM BINTANG JUARA', 0, 1, 'C');
$pdf->SetFont('', '', 8);
$pdf->Cell(0, 1, 'Alamat: Jl. Dewi Sartika Raya No. 17 A RT 02/RW 04 Kelurahan Sukorejo Kecamatan Gunungpati', 0, 1, 'C');
$pdf->Cell(0, 1, 'Kota Semarang 50221', 0, 1, 'C');

// garis
$styleline = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0));
$pdf->Line(10, 30, 199, 30, $styleline);

$pdf->Ln(10);

$pdf->SetFont('', 'B', 12);
$pdf->Cell(0, 1, 'Form Informasi Perkembangan Anak', 0, 1, 'C');
$pdf->SetFont('', 'B', 10);
$pdf->Cell(0, 1, '(Diisi oleh Orang tua)', 0, 1, 'C');

$pdf->Ln(5);
$border1 = array(
  'T' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'B' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'L' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'R' => array('width' => 0.5, 'color' => array(0, 0, 0)),
);

$pdf->Cell(0, 10, 'A. Identitas Anak', $border1, 1, 'L');
$pdf->SetFont('', '', 10);
$pdf->Cell(10, 10, '1.', $border1, 0, 'C');
$pdf->MultiCell(80, 10, 'Nama Lengkap Anak', $border1, 'L', 0, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Cell(100, 10, $dataanak['tb_dataanak_nama_anak'], $border1, 1, 'L');
$pdf->Cell(10, 10, '2.', $border1, 0, 'C');
$pdf->MultiCell(80, 10, 'Tempat dan Tanggal Lahir', $border1, 'L', 0, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Cell(100, 10, $dataanak['tb_dataanak_tempat'] . ', ' . date('d F Y', strtotime($dataanak['tb_dataanak_tanggal_lahir'])), $border1, 1, 'L');
$pdf->Cell(10, 10, '3.', $border1, 0, 'C');
$pdf->MultiCell(80, 10, 'Jenis Kelamin', $border1, 'L', 0, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Cell(100, 10, $dataanak['tb_dataanak_jk'], $border1, 1, 'L');
$pdf->Cell(10, 10, '4.', $border1, 0, 'C');
$pdf->MultiCell(80, 10, 'Agama', $border1, 'L', 0, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Cell(100, 10, $dataanak['tb_dataanak_agama'], $border1, 1, 'L');
$pdf->Cell(10, 10, '5.', $border1, 0, 'C');
$pdf->MultiCell(80, 10, 'Anak Ke', $border1, 'L', 0, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Cell(100, 10, $dataanak['tb_dataanak_jmlsdr'], $border1, 1, 'L');
$pdf->Cell(10, 10, '6.', $border1, 0, 'C');
$pdf->MultiCell(80, 10, 'Alamat Tinggal', $border1, 'L', 0, 0, '', '', true, 0, false, true, 10, 'M');
$pdf->Cell(100, 10, $dataanak['tb_dataanak_alamat'], $border1, 1, 'L');
$pdf->Ln(5);

foreach ($formot as $formot) {
  $nomor = 1;
  $formotsuper = $this->db->get_where('tb_observasi_ot_super', ['tb_observasi_ot_id' => $formot['tb_observasi_ot_id']])->result_array();
  $pdf->SetFont('', 'B', 12);
  $pdf->Cell(0, 10, $formot['tb_observasi_ot_text'], $border1, 1, 'L');
  foreach ($formotsuper as $formotsuper) {
    $carijawaban = $this->db->get_where('tb_observasi_ot_jawaban', ['tb_dataanak_id' => $dataanak['tb_dataanak_id'], 'tb_observasi_ot_super_id' => $formotsuper['tb_observasi_ot_super_id']])->row_array();
    $pdf->SetFont('', '', 10);
    $pdf->Cell(10, 10, $nomor . '.', $border1, 0, 'C');
    $pdf->MultiCell(80, 10, $formotsuper['tb_observasi_ot_super_text'], $border1, 'L', 0, 0, '', '', true, 0, false, true, 10, 'M');
    if (!$carijawaban) {
      $pdf->Cell(100, 10, '', $border1, 1, 'L');
    } else {
      if ($formotsuper['tb_observasi_ot_super_tipe'] == 6) {
        $asalsekolah = $this->bj->getSekolah($dataanak['tb_dataanak_asal_sekolah']);
        $pdf->Cell(100, 10, $asalsekolah['tb_sekolah_title'], $border1, 1, 'L');
      } else {
        $pdf->Cell(100, 10, $carijawaban['tb_observasi_ot_jawaban_text'], $border1, 1, 'L');
      }
    }
    $nomor++;
  }
  $pdf->Ln(5);
}

// set output
$pdf->Output('Form_observasi_orangtua' . '.pdf', 'I');
