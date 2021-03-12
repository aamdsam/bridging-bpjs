<?php
namespace AamDsam\Bpjs\VClaim;

use AamDsam\Bpjs\BpjsService;
class Monitoring extends BpjsService
{

    public function dataKunjungan($tglSep, $jnsPelayanan)
    {
        $response = $this->get('Monitoring/Kunjungan/Tanggal/'.$tglSep.'/JnsPelayanan/'.$jnsPelayanan);
        return json_decode($response, true);
    }

    public function dataKlaim($tglPulang, $jnsPelayanan, $statusKlaim)
    {
        $response = $this->get('Monitoring/Klaim/Tanggal/'.$tglPulang.'/JnsPelayanan/'.$jnsPelayanan.'/Status/'.$statusKlaim);
        return json_decode($response, true);
    }
    public function historyPelayanan($noKartu, $tglAwal, $tglAkhir)
    {
        $response = $this->get('monitoring/HistoriPelayanan/NoKartu/'.$noKartu.'/tglAwal/'.$tglAwal.'/tglAkhir/'.$tglAkhir);
        return json_decode($response, true);
    }
    public function dataKlaimJasaRaharja($tglMulai, $tglAkhir)
    {
        $response = $this->get('monitoring/JasaRaharja/tglMulai/'.$tglMulai.'/tglAkhir/'.$tglAkhir);
        return json_decode($response, true);
    }
}