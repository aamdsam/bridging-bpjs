<?php namespace AamDsam\Bpjs\PCare;

use AamDsam\Bpjs\PCare\PcareService;

class Pendaftaran extends PcareService
{
    /**
     * @var string
     */
    protected $feature = 'pendaftaran';

    public function peserta($nomorKartu)
    {
        $this->feature .= "/peserta/{$nomorKartu}";
        return $this;
    }

    public function tanggalDaftar($tanggalDaftar)
    {
        $this->feature .= "/tglDaftar/{$tanggalDaftar}";
        return $this;
    }

    public function nomorUrut($nomorUrut)
    {
        $this->feature .= "/noUrut/{$nomorUrut}";
        return $this;
    }

    public function kodePoli($kodePoli)
    {
        $this->feature .= "/kdPoli/{$kodePoli}";
        return $this;
    }
}
