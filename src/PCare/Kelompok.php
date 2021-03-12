<?php namespace AamDsam\Bpjs\PCare;

use AamDsam\Bpjs\BpjsService;

class Kelompok extends BpjsService
{
    /**
     * @var string
     */
    protected $feature = 'kelompok';

    public function club($kodeJenisKelompok)
    {
        $this->feature .= "/club/{$kodeJenisKelompok}";
        return $this;
    }

    public function kegiatan($parameter)
    {
        // {bulan} for get or {edu id} for delete
        $this->feature .= "/kegiatan/{$parameter}";
        return $this;
    }

    public function peserta($eduId, $nomorKartu = null)
    {
        $this->feature = "/peserta/{$eduId}";
        if ($nomorKartu !== null) {
            $this->feature .= "/{$nomorKartu}";
        }
        return $this;
    }
}
