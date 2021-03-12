<?php namespace AamDsam\Bpjs\PCare;

use AamDsam\Bpjs\PCare\PcareService;

class Poli extends PcareService
{
    /**
     * @var string
     */
    protected $feature = 'poli';

    public function fktp()
    {
        $this->feature .= "/fktp";
        return $this;
    }
}
