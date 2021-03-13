# BPJS Bridging Vclaim

Bridging VClaim

### Installation

```sh
composer require aamdsam/bridging-bpjs
```

### Setting Bridging BPJS

Tambahkan ke `.env` file

```env
BPJS_CONSID="2112121"
BPJS_SCREET_KEY="121212121"
BPJS_BASE_URL="https://new-api.bpjs-kesehatan.go.id:8080"
BPJS_SERVICE_NAME="new-vclaim-rest"
```  

#### Penggunaan:   
```php
use AamDsam\Bpjs\VClaim;

$referensi = new VClaim\Referensi($this->vclaim_conf());
return response($referensi->propinsi());
```  

---

Katalog BPJS:   
- https://dvlp.bpjs-kesehatan.go.id/VClaim
- https://new-api.bpjs-kesehatan.go.id/pcare-rest-v3.0
