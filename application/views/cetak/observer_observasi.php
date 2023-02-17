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
$pdf->Cell(0, 1, 'LEMBAR OBSERVASI PESERTA DIDIK BARU', 0, 1, 'C');
$pdf->SetFont('', 'B', 10);
$pdf->Cell(0, 1, 'TAHUN PELAJARAN ' . date('Y', strtotime($aktif['tb_tahun_akhir'])) . '/' . date('Y', strtotime('+1 year', strtotime($aktif['tb_tahun_akhir']))), 0, 1, 'C');

$pdf->Ln(5);
$pdf->SetFont('', '', 12);
$pdf->Cell(60, 1, 'Nama Lengkap Anak', 0, 0, 'L');
$pdf->Cell(5, 1, ':', 0, 0, 'L');
$pdf->Cell(50, 1, $dataanak['tb_dataanak_nama_anak'], 0, 1, 'L');
$pdf->Cell(60, 1, 'Nama Panggilan Anak', 0, 0, 'L');
$pdf->Cell(5, 1, ':', 0, 0, 'L');
$pdf->Cell(50, 1, $dataanak['tb_dataanak_nama_panggilan'], 0, 1, 'L');
$pdf->Cell(60, 1, 'Tanggal Lahir', 0, 0, 'L');
$pdf->Cell(5, 1, ':', 0, 0, 'L');
$pdf->Cell(50, 1, date('d F Y', strtotime($dataanak['tb_dataanak_tanggal_lahir'])), 0, 1, 'L');
$pdf->Cell(60, 1, 'Tanggal Observasi', 0, 0, 'L');
$pdf->Cell(5, 1, ':', 0, 0, 'L');
$pdf->Cell(50, 1, date('l, d F Y', strtotime($dataanak['tb_dataanak_jadwal'])), 0, 1, 'L');
$pdf->Cell(60, 1, 'Usia Saat Observasi', 0, 0, 'L');
$pdf->Cell(5, 1, ':', 0, 0, 'L');
$pdf->Cell(50, 1, date('Y') - date('Y', strtotime($dataanak['tb_dataanak_tanggal_lahir'])) . ' Tahun', 0, 1, 'L');

// Header
$border1 = array(
  'T' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'B' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'L' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'R' => array('width' => 0.5, 'color' => array(0, 0, 0)),
);
$border2 = array(
  'T' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'L' => array('width' => 0.5, 'color' => array(0, 0, 0)),
);
$border3 = array(
  'T' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'L' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'R' => array('width' => 0.5, 'color' => array(0, 0, 0)),
);
$border4 = array(
  'T' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'L' => array('width' => 0.5, 'color' => array(0, 0, 0)),
);
$border5 = array(
  'L' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'R' => array('width' => 0.5, 'color' => array(0, 0, 0)),
);
$border6 = array(
  'L' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'R' => array('width' => 0.5, 'color' => array(0, 0, 0)),
  'B' => array('width' => 0.5, 'color' => array(0, 0, 0)),
);

foreach ($dataobservasi as $do) {
  $nomor = 1;
  $subobservasi = $this->obs->getSubobservasibyobservasiid($do['tb_observasi_id']);
  $pdf->Ln(5);
  $pdf->SetFont('', 'B', 12);
  $pdf->Cell(0, 10, $do['tb_observasi_title'], 0, 1, 'L');
  $pdf->Ln(2);
  $pdf->SetFont('', 'B', 11);
  $pdf->Cell(10, 10, '#', $border2, 0, 'C');
  $pdf->Cell(90, 10, 'Tingkat Pencapaian Perkembangan', $border2, 0, 'C');
  $pdf->Cell(10, 10, 'SB', $border3, 0, 'C');
  $pdf->Cell(10, 10, 'BSH', $border2, 0, 'C');
  $pdf->Cell(10, 10, 'MB', $border2, 0, 'C');
  $pdf->Cell(10, 10, 'BB', $border2, 0, 'C');
  $pdf->Cell(50, 10, 'Catatan', $border3, 1, 'C');

  $pdf->SetFont('', '', 11);
  foreach ($subobservasi as $subobservasi) {
    $supersubobservasi = $this->obs->getSupersubobservasibysubobservasiid($subobservasi['tb_observasi_sub_id']);
    if ($supersubobservasi) {
      $pdf->Cell(10, 15, $nomor . '.', $border1, 0, 'C');
      $pdf->MultiCell(90, 15, $subobservasi['tb_observasi_sub_title'], $border1, 'L', 0, 0, '', '', true, 0, false, true, 15, 'M');
      $pdf->Cell(10, 15, '', $border1, 0, 'L');
      $pdf->Cell(10, 15, '', $border1, 0, 'L');
      $pdf->Cell(10, 15, '', $border1, 0, 'L');
      $pdf->Cell(10, 15, '', $border1, 0, 'L');
      $pdf->Cell(50, 15, '', $border1, 1, 'L');
      foreach ($supersubobservasi as $supersub) {
        $jawabansatu = $this->obs->getJawabansuper($supersub['tb_observasi_sub_super_id'], $dataanak['tb_dataanak_id']);
        if ($jawabansatu) {
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
          $pdf->MultiCell(90, 15, $supersub['tb_observasi_sub_super_title'], $border1, 'L', 0, 0, '', '', true, 0, false, true, 15, 'M');
          if ($jawabansatu['tb_jawaban_nilai'] == 1) {
            $pdf->Cell(10, 15, '', $border1, 0, 'C');
            $pdf->Cell(10, 15, '', $border1, 0, 'C');
            $pdf->Cell(10, 15, '', $border1, 0, 'C');
            $pdf->Cell(10, 15, 'V', $border1, 0, 'C');
          } else if ($jawabansatu['tb_jawaban_nilai'] == 2) {
            $pdf->Cell(10, 15, '', $border1, 0, 'C');
            $pdf->Cell(10, 15, '', $border1, 0, 'C');
            $pdf->Cell(10, 15, 'V', $border1, 0, 'C');
            $pdf->Cell(10, 15, '', $border1, 0, 'C');
          } else if ($jawabansatu['tb_jawaban_nilai'] == 3) {
            $pdf->Cell(10, 15, '', $border1, 0, 'C');
            $pdf->Cell(10, 15, 'V', $border1, 0, 'C');
            $pdf->Cell(10, 15, '', $border1, 0, 'C');
            $pdf->Cell(10, 15, '', $border1, 0, 'C');
          } else {
            $pdf->Cell(10, 15, 'V', $border1, 0, 'C');
            $pdf->Cell(10, 15, '', $border1, 0, 'C');
            $pdf->Cell(10, 15, '', $border1, 0, 'C');
            $pdf->Cell(10, 15, '', $border1, 0, 'C');
          }
          $pdf->MultiCell(50, 15, $jawabansatu['tb_jawaban_catatan'], $border1, 'L', 0, 1, '', '', true, 0, false, true, 15, 'M');
        } else {
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
          $pdf->MultiCell(90, 15, $supersub['tb_observasi_sub_super_title'], $border1, 'L', 0, 0, '', '', true, 0, false, true, 15, 'M');
          $pdf->Cell(10, 15, '', $border1, 0, 'L');
          $pdf->Cell(10, 15, '', $border1, 0, 'L');
          $pdf->Cell(10, 15, '', $border1, 0, 'L');
          $pdf->Cell(10, 15, '', $border1, 0, 'L');
          $pdf->Cell(50, 15, '', $border1, 1, 'L');
        }
      }
    } else {
      $jawabandua = $this->obs->getJawabansub($subobservasi['tb_observasi_sub_id'], $dataanak['tb_dataanak_id']);
      if ($jawabandua) {
        $pdf->Cell(10, 15, $nomor . '.', $border1, 0, 'C');
        $pdf->MultiCell(90, 15, $subobservasi['tb_observasi_sub_title'], $border1, 'L', 0, 0, '', '', true, 0, false, true, 15, 'M');
        if ($jawabandua['tb_jawaban_nilai'] == 1) {
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
          $pdf->Cell(10, 15, 'V', $border1, 0, 'C');
        } else if ($jawabandua['tb_jawaban_nilai'] == 2) {
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
          $pdf->Cell(10, 15, 'V', $border1, 0, 'C');
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
        } else if ($jawabandua['tb_jawaban_nilai'] == 3) {
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
          $pdf->Cell(10, 15, 'V', $border1, 0, 'C');
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
        } else {
          $pdf->Cell(10, 15, 'V', $border1, 0, 'C');
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
          $pdf->Cell(10, 15, '', $border1, 0, 'C');
        }
        $pdf->MultiCell(50, 15, $jawabandua['tb_jawaban_catatan'], $border1, 'L', 0, 1, '', '', true, 0, false, true, 15, 'M');
      } else {
        $pdf->Cell(10, 15, $nomor . '.', $border1, 0, 'C');
        $pdf->MultiCell(90, 15, $subobservasi['tb_observasi_sub_title'], $border1, 'L', 0, 0, '', '', true, 0, false, true, 15, 'M');
        $pdf->Cell(10, 15, '', $border1, 0, 'L');
        $pdf->Cell(10, 15, '', $border1, 0, 'L');
        $pdf->Cell(10, 15, '', $border1, 0, 'L');
        $pdf->Cell(10, 15, '', $border1, 0, 'L');
        $pdf->Cell(50, 15, '', $border1, 1, 'L');
      }
    }
    $nomor++;
  }
}

// set output
$pdf->Output('Form_observasi' . '.pdf', 'I');
