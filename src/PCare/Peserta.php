<?php namespace AamDsam\Bpjs\PCare;

use AamDsam\Bpjs\PCare\PcareService;

class Peserta extends PcareService
{
    /**
     * @var string
     */
    protected $feature = 'peserta';

    public function jenisKartu($jenisKartu)
    {
        $this->feature .= "/{$jenisKartu}";
        return $this;
    }
}
