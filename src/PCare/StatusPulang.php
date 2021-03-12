<?php namespace AamDsam\Bpjs\PCare;

use AamDsam\Bpjs\PCare\PcareService;

class StatusPulang extends PcareService
{
    /**
     * @var string
     */
    protected $feature = 'statuspulang';

    public function rawatInap($status = true)
    {
        $this->feature .= "/rawatInap/{$status}";
        return $this;
    }
}
