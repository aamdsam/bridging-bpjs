<?php namespace AamDsam\Bpjs\PCare;

use AamDsam\Bpjs\BpjsService;

class Poli extends BpjsService
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
