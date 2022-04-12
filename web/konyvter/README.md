# konyvter Frontend - Szivák Gergő

Angular CLI: 13.0.4 <br>
Node: 14.16.1 <br>
Package Manager: npm 6.14.12 

## Indítás

* npm install
* ng serve -o

### Megjegyzés az indításhoz

>A képek betöltéséhez szükségvan a konyvter/database/exports/-ban lévő storage könyvtár áthelyzésére a konyvter/api/konyvter/-ba, az ott lévő storage könyvtárat nyugodtan írja felül. Valamint a REST API-nál ne futassa a php artisan migrate parancsot, hanem használja konyvter/database/exports/-ban lévő adatbázis export fájlt.