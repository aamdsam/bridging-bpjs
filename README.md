# BPJS Bridging Vclaim
bridging vclaim


#### Installation

`composer require aamdsam/bridging-bpjs`

setting:  
 .env :  
#setting Bridging BPJS  
```
 BPJS_CONSID = 2112121  
 BPJS_SCREET_KEY = 121212121  
 BPJS_BASE_URL = https://new-api.bpjs-kesehatan.go.id:8080  
 BPJS_SERVICE_NAME = new-vclaim-rest  
```  

penggunaan:   
```
use AamDsam\Bpjs\VClaim;
$referensi = new VClaim\Referensi($this->vclaim_conf());
return response($referensi->propinsi());
```  
dll

katalog bpjs:   
- https://dvlp.bpjs-kesehatan.go.id/VClaim
- https://new-api.bpjs-kesehatan.go.id/pcare-rest-v3.0
