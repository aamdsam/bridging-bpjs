<?php namespace AamDsam\Bpjs\PCare;

use AamDsam\Bpjs\BpjsService;

class Mcu extends BpjsService
{
    /**
     * @var string
     */
    protected $feature = 'mcu';

    public function kunjungan($nomorKunjungan)
    {
        $this->feature .= "/kunjungan/{$nomorKunjungan}";
        return $this;
    }
}
