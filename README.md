# BPJS Bridging Vclaim

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

$bpjs = new PCare\Diagnosa($this->pcare_conf());
return $bpjs->keyword('001')->index(0, 2);
```

Katalog BPJS:   
- https://dvlp.bpjs-kesehatan.go.id/VClaim
- https://new-api.bpjs-kesehatan.go.id/pcare-rest-v3.0
