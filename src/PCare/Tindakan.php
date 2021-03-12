<?php namespace AamDsam\Bpjs\PCare;

use AamDsam\Bpjs\PCare\PcareService;

class Tindakan extends PcareService
{
    /**
     * @var string
     */
    protected $feature = 'tindakan';

    public function kodeTkp($kodeTkp)
    {
        $this->feature .= "/kdTkp/{$kodeTkp}";
        return $this;
    }

    public function kunjungan($nomorKunjungan)
    {
        $this->feature .= "/kunjungan/{$nomorKunjungan}";
        return $this;
    }
}
