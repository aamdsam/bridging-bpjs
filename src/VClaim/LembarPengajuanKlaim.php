<?php
namespace AamDsam\Bpjs\VClaim;
use AamDsam\Bpjs\BpjsService;

class LembarPengajuanKlaim extends BpjsService
{
    public function insertLPK($data = [])
    {
        $response = $this->post('LPK/insert', $data);
        return json_decode($response, true);
    }
    public function updateLPK($data = [])
    {
        $response = $this->put('LPK/update', $data);
        return json_decode($response, true);
    }
    public function deleteLPK($data = [])
    {
        $response = $this->delete('LPK/delete', $data);
        return json_decode($response, true);
    }

    public function cariLPK($tglMasuk, $jnsPelayanan)
    {
        $response = $this->get('LPK/TglMasuk/'.$tglMasuk.'/JnsPelayanan/'.$jnsPelayanan);
        return json_decode($response, true);
    }
}