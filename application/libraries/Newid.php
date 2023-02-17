<?php

class Encryptor
{
    private $CI;

    function __construct()
    {
        $this->CI = get_instance();
    }
    /**
     * Maftuh Ichsan
     * github.com/maftuh23
     * skyetech.team
     */
    
    function newid($var, $database, $id_tabel){
        $today        = date("Ymd"); //untuk mengambil tahun, tanggal dan bulan Hari INI
    
        //cari id terakhir ditanggal hari ini

        $this->db->select_max($id_tabel.'as maxID');
        $this->db->from($database);
        $this->db->like($id_tabel, $var.$today, 'after'); 
        $res = $this->db->result();

        $idMax = $res['maxID'];
    
        //setelah membaca id terakhir, lanjut mencari nomor urut id dari id terakhir
        $NoUrut = (int) substr($idMax, 11, 5);
        $NoUrut++; //nomor urut +1
        $char = $var;
    
        //setelah ketemu id terakhir lanjut membuat id baru dengan format sbb:
        $newid = $char .$today .sprintf('%05s', $NoUrut);
        //$today nanti jadinya misal 20160526 .sprintf('%04s', $NoUrut) urutan id di tanggal hari inizc
        return $newid;
    }

}
