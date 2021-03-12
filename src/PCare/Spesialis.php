<?php namespace AamDsam\Bpjs\PCare;

use AamDsam\Bpjs\BpjsService;

class Spesialis extends BpjsService
{
    /**
     * @var string
     */
    protected $feature = 'spesialis';

    public function rujuk()
    {
        $this->feature .= "/rujuk";
        return $this;
    }

    public function subSpesialis($kodeSpesialis = null)
    {
        $this->feature .= "/subspesialis";
        if ($kodeSpesialis !== null) {
            $this->feature .= "/{$kodeSpesialis}";
        }
        return $this;
    }

    public function sarana($kodeSarana = null)
    {
        $this->feature .= "/sarana";
        if ($kodeSarana !== null) {
            $this->feature .= "/{$kodeSarana}";
        }
        return $this;
    }

    public function tanggalRujuk($tanggalRujuk)
    {
        $this->feature .= "/tglEstRujuk/{$tanggalRujuk}";
        return $this;
    }

    public function khusus($kodeKhusus = null)
    {
        $this->feature .= "/khusus";
        if ($kodeKhusus !== null) {
            $this->feature .= "/{$kodeKhusus}";
        }
        return $this;
    }

    public function nomorKartu($nomorKartu = null)
    {
        $this->feature .= "/noKartu";
        if ($nomorKartu !== null) {
            $this->feature .= "/{$nomorKartu}";
        }
        return $this;
    }
}
