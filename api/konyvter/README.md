# konyvter REST API - Szivák Gergő

Composer version 2.2.3 <br>
Laravel Framework 8.82.0 <br>
PHP 8.1.1

## Indítás

* composer install
* importtal:
    * használja konyvter/database/exports/-ban lévő konyvter.sql export fájlt az adatbázis létrehozásához
    * konyvter/database/exports/-ban lévő storage könyvtár áthelyzésére a konyvter/api/konyvter/-mappába, az ott lévő storage könyvtárat nyugodtan írja felül
    * .env example másolása, a másolat átnevezése .env névre majd az adatbázis beállítása
* import nélkül:
    * üres adatbázis lérehozása szabadon választott néven
    * .env example másolása, a másolat átnevezése .env névre majd az adatbázis beállítása
    * php artisan migrate
* php artisan key:generate
* php artisan storage:link
* php artisan serve

### Megjegyzés az indításhoz

php artisan migrate parancsra a táblákon kívül a következők jönnek létre:
>Létrejön egy admin felhasználó

>Létrejön egy TesztElek nevű felhasználó és a hozzá tartozó hirdetések, a 
hirdetésekhez tartozó könyvek, valamint a könyvekhez tartózó műfajok kapcsolói. <br> 
A TesztElekhez tartozó storage könyvtárában lévő első 3 kép GitHub-ra is felkerül.

>A műfajok tábla teljesen feltöltve jön létre REST API-n keresztül nem módosítható,
mivel a weboldal kinézetét nagyban befolyásolja

## Végpontok

Végpont | Metódus | Hitelesítés | Siker 
--- | --- | --- | --- 
/api/register | POST | nem | 200 OK |
/api/login | POST | nem | 200 OK |
/api/logout | POST | igen | 200 OK |
/api/admin/reportedads | GET | igen & admin | 200 OK |
/api/admin/users | GET | igen & admin | 200 OK |
/api/admin/reportedads/{adtitle} | GET | igen & admin | 200 OK |
/api/admin/users/{username} | GET | igen & admin | 200 OK |
/api/admin/reportedads/remove/{id} | PUT | igen & admin | 200 OK |
/api/web/genres | GET | nem | 200 OK |
/api/web/books | GET | nem | 200 OK |
/api/web/books | POST | igen | 200 OK |
/api/web/books/{id} | GET | nem | 200 OK |
/api/web/books/{id} | PUT | igen | 200 OK |
/api/web/books/{id} | DELETE | igen | 200 OK |
/api/account/{id?} | GET | nem | 200 OK |
/api/account/{id?} | PUT | igen/user vagy admin | 200 OK |
/api/account/{id?} | DELETE | igen/user vagy admin | 200 OK |
/api/web/advertisements | GET | nem | 200 OK |
/api/web/advertisements/my | GET | igen | 200 OK |
/api/web/advertisements | POST | igen | 200 OK |
/api/web/advertisements/{id} | GET | nem | 200 OK |
/api/web/advertisements/{id} | POST/_method:PUT | igen | 200 OK |
/api/web/advertisements/report/{id} | PUT | nem | 200 OK |
/api/web/advertisements/{id} | DELETE | igen/user vagy admin | 200 OK |
/api/web/advertisements/filter | POST | nem | 200 OK |

### Megjegyzés a végpontokhoz

>a képek az alábbi végponton érhetők el:
/storage/images/{username}/{advertisementId}//{imagename}

>/api/web/advertisements/{id} | POST -> ezen az útvonalon a megfelelő működés 
érdekében fel kell venni a következő paramétert: "name":"_method","value":"PUT", 
ugyanis a multipart csak a GET és POST metódust támogatja
