# BPJS Bridging Vclaim, APlicare & Pcare

Bridging VClaim

### Installation

```sh
composer require aamdsam/bridging-bpjs
```

### use for VCLAIM

add to `.env` file

```env
BPJS_CONSID="2112121"
BPJS_SCREET_KEY="121212121"
BPJS_BASE_URL="https://new-api.bpjs-kesehatan.go.id:8080"
BPJS_SERVICE_NAME="new-vclaim-rest"

use AamDsam\Bpjs\VClaim;

function vclaim_conf(){
    $config = [
        'cons_id' => env('BPJS_CONSID'),
        'secret_key' => env('BPJS_SCREET_KEY'),
        'base_url' => env('BPJS_BASE_URL'),
        'service_name' => env('BPJS_SERVICE_NAME'),
    ];
    return $config;
}


$referensi = new VClaim\Referensi($this->vclaim_conf());
return response($referensi->propinsi());


```  


### use for PCare

add to `.env` file

```env
BPJS_PCARE_CONSID="2112121"
BPJS_PCARE_SCREET_KEY="121212121"
BPJS_PCARE_USERNAME="username"
BPJS_PCARE_PASSWORD="password"
BPJS_PCARE_APP_CODE="095"
BPJS_PCARE_BASE_URL="https://dvlp.bpjs-kesehatan.go.id:9081"
BPJS_PCARE_SERVICE_NAME="pcare-rest-v3.0"

use AamDsam\Bpjs\PCare;

function pcare_conf(){
    $config = [
            'cons_id'      => env('BPJS_PCARE_CONSID'),
            'secret_key'   => env('BPJS_PCARE_SCREET_KEY'),
            'username'     => env('BPJS_PCARE_USERNAME'),
            'password'     => env('BPJS_PCARE_PASSWORD'),
            'app_code'     => env('BPJS_PCARE_APP_CODE'),
            'base_url'     => env('BPJS_PCARE_BASE_URL'),
            'service_name' => env('BPJS_PCARE_SERVICE_NAME'),
    ];
    return $config;
}

//diagnosa
$bpjs = new PCare\Diagnosa($this->pcare_conf());
return $bpjs->keyword('001')->index(0, 2);

// dokter
$bpjs = new PCare\Dokter($this->pcare_conf());
return $bpjs->index($start, $limit);

// kesadaran
$bpjs = new PCare\Kesadaran($this->pcare_conf());
return $bpjs->index();

// kunjungan rujukan
$bpjs = new PCare\Kunjungan($this->pcare_conf());
return $bpjs->rujukan($nomorKunjungan)->index();
// kunjungan riwayat

$bpjs = new PCare\Kunjungan($this->pcare_conf());
return $bpjs->riwayat($nomorKartu)->index();

// mcu
$bpjs = new PCare\Mcu($this->pcare_conf());
return $bpjs->kunjungan($nomorKunjungan)->index();

// obat dpho
$bpjs = new PCare\Obat($this->pcare_conf());
return $bpjs->dpho($keyword)->index($start, $limit);

// obat kunjungan
$bpjs = new PCare\Obat($this->pcare_conf());
return $bpjs->kunjungan($nomorKunjungan)->index();

// pendaftaran tanggal daftar
$bpjs = new PCare\Pendaftaran($this->pcare_conf());
return $bpjs->tanggalDaftar($tglDaftar)->index($start, $limit);

// pendaftaran nomor urut
$bpjs = new PCare\Diagnosa($this->pcare_conf());
return $bpjs->nomorUrut($nomorUrut)->tanggalDaftar($tanggalDaftar)->index();

// peserta
$bpjs = new PCare\Peserta($this->pcare_conf());
return $bpjs->keyword($keyword)->show();

// peserta jenis kartu [NIK/NOKA]
$bpjs = new PCare\Peserta($this->pcare_conf());
return $bpjs->jenisKartu($jenisKartu)->keyword($keyword)->show();

// poli
$bpjs = new PCare\Poli($this->pcare_conf());
return $bpjs->fktp()->index($start, $limit);

// provider
$bpjs = new PCare\provider($this->pcare_conf());
return $bpjs->index($start, $limit);

// tindakan kode tkp
$bpjs = new PCare\Tindakan($this->pcare_conf());
return $bpjs->kodeTkp($keyword)->index($start, $limit);

// tindakan kunjungan
$bpjs = new PCare\Tindakan($this->pcare_conf());
return $bpjs->kunjungan($nomorKunjungan)->index();

// kelompok club
$bpjs = new PCare\Kelompok($this->pcare_conf());
return $bpjs->club($kodeJenisKelompok)->index();

// kelompok kegiatan
$bpjs = new PCare\Kelompok($this->pcare_conf());
return $bpjs->kegiatan($bulan)->index();

// kelompok peserta
$bpjs = new PCare\Kelompok($this->pcare_conf());
return $bpjs->peserta($eduId)->index();

// spesialis
$bpjs = new PCare\Spesialis($this->pcare_conf());
return $bpjs->index();

// spesialis sub spesialis
$bpjs = new PCare\Spesialis($this->pcare_conf());
return $bpjs->keyword($keyword)->subSpesialis()->index();

// spesialis sarana
$bpjs = new PCare\Spesialis($this->pcare_conf());
return $bpjs->sarana()->index();

// spesialis khusus
$bpjs = new PCare\Spesialis($this->pcare_conf());
return $bpjs->khusus()->index();

// spesialis rujuk
$bpjs = new PCare\Spesialis($this->pcare_conf());
return $bpjs->rujuk()->subSpesialis($kodeSubSpesialis)->sarana($kodeSarana)->tanggalRujuk($tanggalRujuk)->index();

// spesialis rujuk
$bpjs = new PCare\Spesialis($this->pcare_conf());
return $bpjs->rujuk()->khusus($kodeKhusus)->nomorKartu($nomorKartu)->tanggalRujuk($tanggalRujuk)->index();

// spesialis rujuk
$bpjs = new PCare\Spesialis($this->pcare_conf());
return $bpjs->rujuk()->khusus($kodeKhusus)->subSpesialis($kodeSubSpesialis)->nomorKartu($nomorKartu)->tanggalRujuk($tanggalRujuk)->index();
```

Katalog BPJS:
- Vclaim V1.1: https://dvlp.bpjs-kesehatan.go.id/VClaim-Katalog
- Pcare V3: https://new-api.bpjs-kesehatan.go.id/pcare-rest-v3.0