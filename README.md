# BPJS Bridging Vclaim
bridging vclaim


#### Installation

`composer require aamdsam/bpjs-vclaim`

setting: 
 .env :
- BPJS_VCLAIM_CONS_ID = 1212
- BPJS_VCLAIM_SECRET_KEY = 2233232
- BPJS_VCLAIM_BASE_URL = https://new-api.bpjs-kesehatan.go.id:8080
- BPJS_VCLAIM_SERVICE_NAME = new-vclaim-rest

penggunaan: 
- use AamDsam\Bpjs\VClaim;
- $referensi = new VClaim\Referensi();
- return response($referensi->propinsi());
- dll

katalog bpjs: 
- https://dvlp.bpjs-kesehatan.go.id/VClaim-Katalog
