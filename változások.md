## Booty Dark Admin Plugin

#### Ez fájl csak helyileg létezhet!

Az feljegyzések csak 24-06-2020-tól vannak!

**FIGYELEM!!!** Mindig a localhost 1GITHUB**/bludit-dev** változaton folynak a fejlesztések, majd stabil verzió esetén felülírásra kerülnek a Dokumentumok/Github mappában lévő dolgok!!

A localhost 1GITHUB**/bludit-last-native** változatban ugyanaz a verzió fut, mint ami megtalálható a github-on is. Ez arra jó, hogy vissza tudjam nézni az utolsó verziót.

------

##### 31-8-2020 v1.2.0 Build 3131

Sok a  változtatás:

* a teljes BDA úgy működik, hogy amikor kiválasztasz valamit, azonnal megjelenik a ávltozás, pl. ha színt választasz, akkor az ikonok, a menüpont színe megváltozik
* beépítésre került a frissítés értesítő
* néhány hiba ki lett javítva
* színválasztó legördülőbe az alapértelmezett értékhez bekerült a szín: \#52b3d0



##### 16-8-2020 v1.1.2 build 3131 (jelenlegi)

* amikor a sidebar-on a BDA linkje alatt nem jelent meg semmi, akkor a sidebar és a right main szerkezete szétesett. Oka az volt, hogy a BDA sidebar linkje nem volt lezárva: </a>
* metadata.json frissítve az új verzióra és az új adatokra



##### 05-8-2020 v1.1.1 build 3131

* Új funkció: 
  * kapcsoló a plugin menüpontjának megjelenítéséhez az adminbar-on (az oldalsáv kiegészítők szekcióban) (15-7-2020)
  * színválasztási lehetőség az oldalsáv egyes elemeihez
    * aktív menüpont bal oldalán található széles keret
    * a vezérlő ikonok hover effektje
    * az új tartalom ikonja
* Nyelvi fájlok frissítése
* Amik változtak:
  * átrendeződőtt a plugin beállítás lapja
  * a plugin újdonságai a fentiekhez
  * a sablon 2 fájlja is változott (a sablonnál le van írva minden)
* frissítve a Readme.md fájl az új funkciók alapján
* új képek kerültek a demo oldalra is



##### 10-7-2020 v1.1.0

* Az oldalsáv változásai miatt itt is bekerült néhány változtatás



##### 24-6-2020

* az ***adminBodyEnd*** funkciónál a ***global $sheduled*** paraméter nincs használva, ezért az el lett távolítva a kódból

* figyelmeztető szöveg került kiiratásra arra az esetre, ha a jelvények elrejtésre kerülnek vagy mindenhol, vagy a tartalom oldalon. Ez egy alap funkció, ez nincs itt programozva, ezért kellett ez.

  Nyelvi fájlok is frissítve lettek ehhez a funkcióhoz. Hosszú szöveg miatt került az angol nyelvi fájlba is!

  Ugyanitt a figyelmeztető szöveg miatt módosultak a feltételes sorok is. Bekerült egy újabb feltételes sor, ami külön vezérli az oldalsávon megjelenő jelvényeket

  Szintén ugyanitt módosultak a kiválasztó alapján programozott jelvény vezérlő elemek, mint pl a d-none, vagy a szín beállítása.

  Mivel más plugin is tartalmazhat jelvényt (pl a backup) így arra is lett megoldás. Először eltávolítja mindazon szín beállításokat, amik nem a badge-secondary, majd hozzáadja a különböző osztályokat, hogy minden jelvény egyformán egységesen meg

* a vezérlő ikonok hover effektjét vezérlő jquery teljes egészében átkerült a sidebar.php fájl aljára (itt nem volt semmi feltételhez kötve, így felesleges itt lennie)

