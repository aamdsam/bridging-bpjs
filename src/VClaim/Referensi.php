<?php
namespace AamDsam\Bpjs\VClaim;

use AamDsam\Bpjs\BpjsService;

class Referensi extends BpjsService
{

    public function diagnosa($keyword)
    {
        $response = $this->get('referensi/diagnosa/'.$keyword);
        return json_decode($response, true);
    }
    public function poli($keyword)
    {
        $response = $this->get('referensi/poli/'.$keyword);
        return json_decode($response, true);
    }
    public function faskes($kd_faskes = null, $jns_faskes = null)
    {
        $response = $this->get('referensi/faskes/'.$kd_faskes.'/'.$jns_faskes);
        return json_decode($response, true);
    }

    public function dokterDpjp($jnsPelayanan, $tglPelayanan, $spesialis)
    {
        $response = $this->get('referensi/dokter/pelayanan/'.$jnsPelayanan.'/tglPelayanan/'.$tglPelayanan.'/Spesialis/'.$spesialis);
        return json_decode($response, true);
    }

    public function propinsi()
    {
        $response = $this->get('referensi/propinsi');
        return json_decode($response, true);
    }

    public function kabupaten($kdPropinsi)
    {
        $response = $this->get('referensi/kabupaten/propinsi/'.$kdPropinsi);
        return json_decode($response, true);
    }

    public function kecamatan($kdKabupaten)
    {
        $response = $this->get('referensi/kecamatan/kabupaten/'.$kdKabupaten);
        return json_decode($response, true);
    }

    public function procedure($keyword)
    {
        $response = $this->get('referensi/procedure/'.$keyword);
        return json_decode($response, true);
    }

    public function kelasRawat()
    {
        $response = $this->get('referensi/kelasrawat');
        return json_decode($response, true);
    }

    public function dokter($keyword)
    {
        $response = $this->get('referensi/dokter/'.$keyword);
        return json_decode($response, true);
    }

    public function spesialistik()
    {
        $response = $this->get('referensi/spesialistik');
        return json_decode($response, true);
    }

    public function ruangrawat()
    {
        $response = $this->get('referensi/ruangrawat');
        return json_decode($response, true);
    }

    public function carakeluar()
    {
        $response = $this->get('referensi/carakeluar');
        return json_decode($response, true);
    }

    public function pascapulang()
    {
        $response = $this->get('referensi/pascapulang');
        return json_decode($response, true);
    }

}