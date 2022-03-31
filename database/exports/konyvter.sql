-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Már 31. 20:39
-- Kiszolgáló verziója: 10.4.22-MariaDB
-- PHP verzió: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `konyvter`
--
CREATE DATABASE IF NOT EXISTS `konyvter` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `konyvter`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `advertisements`
--

CREATE TABLE `advertisements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adtitle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `sawcounter` int(11) DEFAULT NULL,
  `picturepath` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `badcontent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `advertisements`
--

INSERT INTO `advertisements` (`id`, `adtitle`, `description`, `price`, `sawcounter`, `picturepath`, `badcontent`, `book_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Vaják első rész eladó', 'A borítója egy kicsit megszakadt, de egyébként kiválló álapotban van', 1500, 3, '/storage/images/TesztElek/1/witcher1.jpg', 'A képen nem oda illő tartalom szerepel', 1, 2, '2022-02-27 17:00:00', '2022-03-31 16:37:12'),
(2, 'Vaják második rész eladó', 'kiválló álapotban van, a részletekért keress', 1600, NULL, '/storage/images/TesztElek/2/witcher2.jpg', NULL, 2, 2, '2022-02-27 17:00:00', '2022-02-27 17:00:00'),
(3, 'Vaják harmadik rész eladó', 'kiválló álapotban van, a részletekért keress', 1600, 3, '/storage/images/TesztElek/3/witcher3.jpg', 'A képen nem oda illő tartalom szerepel', 3, 2, '2022-02-27 17:00:00', '2022-02-27 17:00:00'),
(4, 'Álmodnak-e az androidok elektronikus bárányokkal?', 'Az Álmodnak-e az androidok elektronikus bárányokkal? (Do Androids Dream of Electric Sheep?) 1968-ban megjelent science fiction regény Philip K. Dick tollából. A mű cselekménye két szálon fut. Az egyik Rick Deckardról, az androidokat üldöző fejvadászról szól, a másik pedig John Isidore-ról, az android szimpatizáns, alacsonyabb intelligenciájú férfiról.\r\n\r\nA regény története egy poszt-apokaliptikus, elképzelt közeljövőben játszódik. A harmadik világháború után járunk, ahol a Föld népessége drasztikus csökkenésen esett át a nukleáris bombák miatt, melyeket a háborúban használtak fel. A legtöbb állatfaj kihalt a radioaktivitás következtében, így az élő házi kedvencek státusszimbólummá váltak. Az állatoknál csak az emberek empátiája vált értékesebbé.\r\n\r\nDeckardot megbízzák hat Nexus-6 típusú android kiiktatásával, melyek a legújabb, legerősebb és legintelligensebb modellek. Képtelenek az együttérzésre, így a fejvadászok empátiatesztjeivel kiszűrhetőek. Deckard így próbálja behatárolni az emberek és az androidok közötti különbségeket. Ennek ellenére eltöpreng azon, hogy pontosan hol kezdődik az ember, és hol az android.\r\n\r\nA regényt kétszer adták ki Magyarországon. Először 1993-ban adta ki a Valhalla Páholy, Álmodnak-e az androidok elektromos bárányokról? címen. Második alkalommal az Agave Könyvek adta ki 2005-ben, kiegészítve három irodalomtörténész tanulmányával.\r\n\r\nEz a könyv szolgáltatta az alapot Ridley Scott 1982-ben bemutatott kultuszfilmjéhez, a Szárnyas fejvadászhoz.', 2300, NULL, '/storage/images/Gergosz/4/ajeYfCSCDT8RFB2wZhYdWKLUpgmsdDmdiWllVVLr.jpg', NULL, 4, 3, '2022-03-31 15:54:37', '2022-03-31 15:54:37'),
(5, 'Trónok harca', 'Westeros hét királyságát egykor a sárkánykirályok uralták. Vérrel és tűzzel teli uralmuknak Robert Baratheon vetett véget, aki letaszította a Vastrónról az utolsó, őrült Targaryen királyt. Azonban Robertet külső és belső ellenségek fenyegetik, és amikor jobbkeze, a hűséges Jon Arryn váratlanul meghal, legrégebbi barátjához és fegyvertársához, a hideg Északot kormányzó Eddard Starkhoz fordul segítségért. Deres végletekig hűséges, egyenes és merev ura egyedül találja magát a királyi udvarban, ahol senki és semmi sem az, aminek látszik, és egyre erősödik benne a gyanú, hogy Jon Arryn halála nem volt véletlen. Egy kontinenssel arrébb az utolsó sárkányherceg húgát bocsájtja áruba, hogy visszaszerezze a trónt, ám Robert legveszélyesebb ellenségei sokkal közelebb rejtőznek.\r\nMiközben az ambiciózus nagyurak és mindenre elszánt trónkövetelők dögkeselyűként köröznek a Vastrón körül, az emberek világát védő Falon túl feltámadnak a hideg szelek, és egy ősi fenyegetés kel újra életre. Westeros hosszú nyara véget érőben van; közeleg a tél.\r\n\r\nGeorge R. R. Martin elsöprő sikerű könyvsorozata, A tűz és jég dala forradalmasította a fantasy műfaját, és a 21. század egyik legnépszerűbb tévésorozata született belőle.', 3000, NULL, '/storage/images/Gergosz/5/yjNCryVCQOPQh48BR2Fm7L1emm8aFq9nYgDTPZDg.jpg', NULL, 5, 3, '2022-03-31 15:57:03', '2022-03-31 15:57:03'),
(6, 'Trónok harca 2.rész eladó', 'A Királyok csatája (eredeti címe: A Clash of Kings) George R. R. Martin A tűz és jég dala című fantasy regényciklusának második kötete.\r\n\r\nA történet ott folytatódik, ahol az előző rész befejeződött. Westeros királya halott, a hatalomért pedig öt nagy úr száll harcba egymással. A királyság trónján a halott uralkodó fia, Joffrey ül, akit azonban a néhai király fivérei azzal vádolnak, hogy anyja saját ikertestvérétől született, így hamis a trónkövetelése. A fivérek, Stannis és Renly Baratheon egyaránt királlyá koronáztatják magukat, s hadat üzennek unokaöccsüknek és egymásnak is. Észak önjelölt, ifjú királya, Robb Stark meg szeretné bosszulni a kölyökkirály Joffrey által lefejeztetett apját, s ki szeretné szabadítani fogságba esett húgait. Eközben a Vas-szigetek harcias, lázadó szellemű ura, Balon Greyjoy is királynak kezdi nevezni magát és összehívja lobogóit.\r\n\r\nA cselekmény északon és keleten is tovább folytatódik. Az Éjjeli Őrség tagjai expedíciót indítanak a Falon túlra, hogy felkutassák eltűnt bajtársaikat, legfőképp Havas Jon nagybátyját, Benjen Starkot. A keleti kontinensen az utolsó Targaryen, Viharbanszületett Daenerys tovább szövögeti terveit az egykoron családja uralma alatt álló Westeros visszahódítására, immáron három sárkányfiókával az oldalán.', 3000, NULL, '/storage/images/Gergosz/6/Mbrh69sWTmMaeEh8UxeNzHLPj5NkQVwpnMBQNdsh.jpg', NULL, 6, 3, '2022-03-31 16:01:26', '2022-03-31 16:01:26'),
(7, 'A buddhizmus lélektana', 'Gánti Bence szakpszichológus átfogó és hiánypótló könyve bemutatja a buddhizmus lélektanát és spiritualitását, utolsó harmada pedig beavat a meditációs gyakorlatokba is. Nemcsak kultúrtörténeti áttekintést ad, hanem fogódzót is az útkeresők számára.', 1500, NULL, '/storage/images/Dani/7/4mi5j08Ows9XdZh1v3VSforfu6PfSmJV9KCwoY4H.jpg', NULL, 7, 4, '2022-03-31 16:05:20', '2022-03-31 16:05:20'),
(8, 'Könyv Putyinról', 'Vlagyimir Putyin Oroszországa az elmúlt években összehangolt akciók egész sorozatát indította azzal a céllal, hogy kiterjessze a hatalmát és meggyengítse a Nyugatot - elég csak az amerikai választások befolyásolására, a szélsőséges politikusok támogatására vagy az Ukrajnában zajló háborúra gondolni.\r\nDe hogyan kezdődött mindez, és kik állnak a folyamatok hátterében?\r\nA Putyin emberei az orosz elnök szűk körének eddig ismeretlen történetét beszéli el: hogyan élte túl a KGB-hez köthető csoport a Szovjetunió összeomlását, miként tett szert óriási vagyonokra, nyerte vissza pozícióját, és milyen események hatására vált először az orosz, majd a világpolitika megkerülhetetlen tényezőjévé.A szerzőnek, Catherine Beltonnak sikerült eljutnia az elmúlt húsz év legfontosabb kulcsfiguráihoz, az egykori bennfentesekhez, akik jól tudják, mi zajlik a Kreml áthatolhatatlannak tűnő falai mögött. Az ő beszámolóik alapján egy kegyetlen, pókháló finomságú rendszer rajzolódik ki, amely embereket emelhet a magasba vagy taszíthat a mélybe, dollármilliókat tüntethet el nyomtalanul, és egész nemzetek sorsát alakíthatja a saját érdekei szerint.\r\nBelton egyedülálló részletességgel megírt munkája dermesztően izgalmas összefoglaló, amely segít megérteni, milyen erők formálják korunk legjelentősebb politikai változásait.\r\n\r\n\"Merész oknyomozás Vlagyimir Putyin felemelkedéséről, valamint arról, hogyan fonódik össze a pénz és a hatalom napjaink Oroszországában. A szerző lerántja a leplet a hosszú évtizedeken át titokban működő hálózatokról, és felfedi a Putyinhoz tartozó csoportok belső működését. Egyszerre figyelemre méltó és nyugtalanító olvasmány.\" David E. Hoffman, az Oligarchák - Erő és hatalom az új Oroszországban című könyv szerzője\r\n\"Catherine Belton vitán felül korunk egyik legalaposabb és legtájékozottabb újságírója. Sok mindent lehet manapság hallani Oroszországról, de aki a tényekre kíváncsi, olvassa el a Putyin embereit.\" Peter Pomerantsev, a Semmi nem igaz, bármi lehetséges című könyv szerzője\r\n\"Belton bámulatos elszántsággal kutatta fel a különféle csoportok képviselőit, nyomozott dokumentumok után és követte a pénz útját. Munkájának gyümölcse ez a kérlelhetetlen pontossággal, mégis könnyed eleganciával megírt portré Putyin legbelsőbb köreiről.\" Jennifer Szalai, New York Times Book Review\r\n\r\n\"Belton nagyszabású művéből kiváló Netflix-sorozatot lehetne írni. Hátborzongatóan különleges tabló a modern Oroszországról, amelynél aligha írtak jobbat az elmúlt harminc évben.\" Peter Frankopan, Financial Times', 3000, 2, '/storage/images/Dani/8/d249OZk2poG5rHmHJ2eMoVMGiWyHjpF9GtmUG68E.jpg', 'Putyint egy diktátor! Felháborító, hogy itt róla szóló könyveket találok', 8, 4, '2022-03-31 16:07:20', '2022-03-31 16:36:54'),
(9, 'Stephen King: A szem', 'Vigyázat! Cselekményleírást tartalmaz.\r\n\r\nValamennyien hátrahőköltek, ahogy Flagg ökle – mely most kékes fényben izzott – ismét lecsapott az ajtóra. Ágyúdörrenésszerű robajjal, egyszerre szakadt sarokvas, zár és retesz. A repedéseken át keskeny nyalábokban áradt befelé a kékes ragyogás – aztán engedek a deszkák is; tömegével szállt a forgács. A tönkrezúzott ajtó inogott egy darabig, majd recsegve-ropogva bedőlt. Flagg ott állt a küszöbön, a csuklya ezúttal nem takarta a fejét. Krétafehér volt az arca, máj-vörös ajkai vonaglottak, látni engedték vicsorát. Szemében pokoltűz égett. S markában ott villogott a súlyos hóhérbárd…', 1300, NULL, '/storage/images/Dani/9/DfPC5HO7KAXhxa6N9g9iinj7H9qmkK2N45L1m0Dx.jpg', NULL, 9, 4, '2022-03-31 16:11:28', '2022-03-31 16:11:28'),
(10, 'Idiótákkal körülvéve', 'Te milyen színű vagy?\r\nVajon egy impulzív, beszédes sárga, aki általában a társaság középpontja? Egy rendmániás, analitikus kék, akinél még a törölközők is derékszögben állnak? Talán egy célorientált, öntudatos vörös, akárcsak a vezetők többsége? Vagy egy türelmes, csapatjátékos zöld, mint amilyen Jézus is volt?\r\nÉrezted már úgy, mintha mindenki szembejönne? Vannak olyan ismerőseid, akik akkor sem értik meg mit akarsz mondani, ha már hangosan beszélsz velük? Ebben az esetben ez a könyv neked szól. Tele olyan valódi élethelyzettel, melyben garantáltan felismered magad és a körülötted élőket. \"Aha, ez tényleg én vagyok!\", máskor meg, \"Á, akkor ezt ezért csinálja...\"\r\nAz Idiótákkal körülvéve egy szórakoztató, olvasmányos és mindenekelőtt rendkívül hasznos útmutató mai világunk és embertársaink megértéséhez. Hétköznapi példáit könnyen érthető tudományos alapossággal veszi górcső alá, ezzel segít az olvasónak megérteni a kommunikáció különböző módjait. A mindennapos konfliktusok egyik leggyakoribb oka a rossz kommunikáció - miután elolvastad ezt a könyvet, garantáltan kevesebb idióta lesz körülötted. Találd meg az utat te is magadhoz és a többiekhez!', 4000, 1, '/storage/images/rita/10/zspuoh26TP5xd8oZAWV3eLFz8eNiv8BQVRANOxfT.jpg', NULL, 10, 5, '2022-03-31 16:24:32', '2022-03-31 16:25:06'),
(11, 'Thomas Erikson: Pocsék főnökök', 'A Pocsék főnökök című könyv megtanít arra, hogyan kezeld a lehető legreménytelenebb főnököket. Thomas Erikson, az Idiótákkal körülvéve sikerkönyvének szerzője tudja, mit beszél. Főnökként, beosztottként egyaránt dolgozott, és vezetői trénerként a főnökök minden típusával találkozott már.\r\nHa a gyerekeid nem a várt módon viselkednek, a nevelés taktikáján mindig tudsz változtatni. Ha egy ismerősöd faragatlan, természetesen faképnél hagyhatod. Ha viszont a főnököd igazságtalan és méltánytalan követelményeket támaszt veled szemben, már nem olyan egyszerű tudni, mihez kezdj vele. Mindannyian ismerjük ezt a helyzetet. Mintha a főnököd és te nem ugyanarról a bolygóról érkeztetek volna. Pedig lehet, hogy csak piros típus és emiatt túl keménynek találod. Vagy netán sárga, aki lyukat beszél hasadba. Talán zöld, amitől olyan érzésed van, mintha ő sem tudná, merre van az előre? Lehet akár kék, akinél nincs rendetlen íróasztal! Ha még nem akadt dolgod pokoli főnökkel, a sajátod is bizonyára okozott számodra kellemetlen meglepetéseket. Talán komoly felelősséget rótt rád, de hatáskört nem. Lehet, hogy eltérő a személyiségprofilotok, és teljesen különböző módon működtök. És néha talán már arra gyanakszol, hogy a főnököd teljesen reménytelen eset? Nyugi. Arra is van megoldás.\r\nMivel az éremnek két oldala van, a könyv a főnökök számára külön bónuszként tartalmaz egy Lusta disznókkal körülvéve című fejezetet is, mely arról szól, hogyan lehet kezelni a gyengén teljesítőket. Azt is megvizsgálja, miért olyan ritka a jó vezető, és azt is, hogy egyes beosztottaknak miért esik nehezére elvégezni a munkát.\r\nA könyv könnyed és szórakoztató módon ismerteti, hogyan lehet befolyásolni az emberek különböző viselkedésformáit. Azt is áttekinti, hogy mi jellemzi a példás vezetők típusát.', 3400, 2, '/storage/images/rita/11/qTp8cqT2zhxbelKf3PWjkgimuutT5tJfTFqIo11D.jpg', NULL, 11, 5, '2022-03-31 16:27:21', '2022-03-31 16:36:43'),
(12, 'F. Várkonyi Zsuzsa: Tanulom magam', '- Miért teszünk olyasmit, amivel magunk sem értünk egyet?\r\n- Milyen belső program irányítja tetteink zömét?\r\n- Hol tanultuk az életünket megkeserítő pszichológiai játszmákat?\r\n- Valóban magunk írtuk-e meg életünk tervét?\r\n- Miért éppen az önismeret menthet meg bennünket a beprogramozott csapdáktól?\r\n\r\nEzekre a kérdésekre keresi a szerző a választ, remélve az olvasó közreműködését. Ebben a könyvben F. Várkonyi Zsuzsa sokéves önismeret-tanítási tapasztalatát összegzi nemcsak a segítő foglalkozású szakemberek, hanem az érdeklődő laikusok számára is.\r\n\r\nAz olvasó megismerkedhet a tranzakció-elemzés alapjaival és jó néhány olyan gondolattal, melyek e tanítás-tanulás során születtek, és bizonyultak sokak életében helytállónak és hasznosnak.\r\n\r\nA Tanulom magam F. Várkonyi Zsuzsa Kulcslyuk Kiadónál megjelenő életműsorozatának első kötete.', 3400, 1, '/storage/images/rita/12/CZUXivo6DJjbUm0fNL1CThL8oKfF89jhIMAPc3gL.jpg', NULL, 12, 5, '2022-03-31 16:30:12', '2022-03-31 16:33:04'),
(13, 'Egyasszony', 'Egy fiatal vidéki lánynak a 80-as évek derekán mozgás- és értelmi sérült gyermeke született. Bántalmazó férje oldalán küzdött kitartóan a családja boldogságáért, de harca kudarcra volt ítélve...\r\nAzóta eltelt több mint harminc év, a lányból asszony lett, de nem sikerült feldolgoznia az átélteket. Ezért kezdett blogot írni, amit rövid időn belül százezrek olvastak.\r\nPéterfy-Novák Éva története a veszteség utáni továbblépésről és az elfogadás folyamatáról szól - egy olyan korban és közegben, mely sem a hibát beismerni, sem a mássággal együtt élni nem akar.\r\nA könyvből 2015-ben nagy sikerű monodrámát vitt színre az Orlai Produkciós Iroda és a Füge.', 3200, 2, '/storage/images/rita/13/X6PclLKxaFWblzpo0r9SQuvhhF5rMqNYuoMFOOa1.jpg', NULL, 13, 5, '2022-03-31 16:32:49', '2022-03-31 16:37:32');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bgswitches`
--

CREATE TABLE `bgswitches` (
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `genre_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `bgswitches`
--

INSERT INTO `bgswitches` (`book_id`, `genre_id`) VALUES
(1, 2),
(1, 3),
(1, 1),
(2, 3),
(2, 1),
(3, 2),
(3, 3),
(3, 1),
(4, 1),
(4, 4),
(5, 28),
(5, 2),
(5, 32),
(5, 37),
(5, 1),
(6, 28),
(6, 2),
(6, 37),
(7, 5),
(7, 24),
(8, 14),
(9, 2),
(9, 3),
(9, 1),
(10, 14),
(10, 19),
(10, 6),
(11, 6),
(12, 20),
(13, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `writer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `release` smallint(6) DEFAULT NULL,
  `language` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `books`
--

INSERT INTO `books` (`id`, `title`, `writer`, `publisher`, `release`, `language`) VALUES
(1, 'Az utolsó kívánság', 'Andrzej Sapkowski', 'Gabo könyvkiadó', 1993, 'magyar'),
(2, 'A végzet kardja', 'Andrzej Sapkowski', 'Gabo könyvkiadó', 1992, 'magyar'),
(3, 'Tündevér', 'Andrzej Sapkowski', 'Gabo könyvkiadó', 1994, 'magyar'),
(4, 'Álmodnak-e az androidok elektronikus bárányokkal?', 'Philip K. Dick', 'Agave Könyvek', 1968, 'magyar'),
(5, 'Trónok harca - A tűz és jég dala I.', 'George R. R. Martin', 'Alexandra Kiadó', 2003, 'magyar'),
(6, 'Királyok csatája - A tűz és jég dala II.', 'George R. R. Martin', 'ALEXANDRA KÖNYVESHÁZ KFT.', 2008, 'magyar'),
(7, 'A buddhizmus: lélektana, spiritualitása és irányzatai', 'Gánti Bence', 'Kossuth Kiadó', 2012, 'magyar'),
(8, 'JÖN Putyin emberei', 'Catherine Belton', 'Líra', 2022, 'magyar'),
(9, 'A ​szem', 'Stephen King', NULL, 1995, 'magyar'),
(10, 'Idiótákkal körülvéve - Hogyan értsük meg azokat, akiket lehetetlen megérteni?', 'Thomas Erikson', 'Central Médiacsoport Zrt.', 2018, 'magyar'),
(11, 'Pocsék főnökök', 'Thomas Erikson', 'Central Könyvek', 2020, 'magyar'),
(12, 'Tanulom magam', 'F. Várkonyi Zsuzsa', 'KULCSLYUK KIADÓ KFT.', 2020, 'magyar'),
(13, 'Egyasszony', 'Péterfy-Novák Éva', 'Libri Könyvkiadó Kft.', 2021, 'magyar');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `genres`
--

CREATE TABLE `genres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `genre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `genres`
--

INSERT INTO `genres` (`id`, `genre`) VALUES
(25, 'Abszurd dráma'),
(26, 'Családregény'),
(27, 'Elbeszélő költemény'),
(6, 'Életmód, egészség'),
(7, 'Életrajzok, visszaemlékezések'),
(28, 'Fantasy'),
(2, 'Fantasy-irodalom'),
(29, 'Fejlődésregény'),
(5, 'Filozófia'),
(8, 'Gasztronómia'),
(9, 'Gyermek és ifjúsági'),
(30, 'Háborús regény'),
(3, 'High fantasy'),
(10, 'Hobbi, szabadidő'),
(31, 'Horror'),
(32, 'Kalandregény'),
(11, 'Képregény'),
(33, 'Kisregény'),
(35, 'Költészet'),
(34, 'Koreai irodalom'),
(36, 'Levélregény'),
(12, 'Lexikon, enciklopédia'),
(37, 'Lovagregény'),
(38, 'Mese'),
(39, 'Mítosz'),
(13, 'Művészet, építészet'),
(14, 'Napjaink, bulvár, politika'),
(40, 'Napló'),
(41, 'Novella'),
(15, 'Nyelvkönyv, szótár'),
(16, 'Pénz, gazdaság, üzleti élet'),
(42, 'Ponyvairodalom'),
(1, 'Regény'),
(43, 'Remake'),
(44, 'Romantika'),
(45, 'Saga'),
(4, 'Sci-fi'),
(17, 'Sport, természetjárás'),
(18, 'Számítástechnika, internet'),
(46, 'Szatíra'),
(19, 'Tankönyvek, segédkönyvek'),
(20, 'Társ. tudományok'),
(21, 'Történelem'),
(22, 'Tudomány és Természet'),
(23, 'Utazás'),
(24, 'Vallás, mitológia'),
(47, 'Vers');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_02_06_222222_create_books_table', 1),
(6, '2022_02_06_333333_create_genres_table', 1),
(7, '2022_02_06_444444_create_advertisements_table', 1),
(8, '2022_02_06_555555_create_bgswitches_table', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `email_verified_at`, `phone`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$HUMcAmlps7/Uw9YmJ0AgrenJDDtcHtR1I3Tytq/5wqXz6opBMF4pe', 'admin@konyvter.hu', NULL, NULL, 1, NULL, '2022-02-20 17:00:00', '2022-02-20 17:00:00'),
(2, 'TesztElek', '$2y$10$Iu1j.ln9joUg4xbbc820HejxiRSbgxulBuYPhqILIp12D4bQN4AoS', 'elek@teszt.hu', NULL, '36702113423', 0, NULL, '2022-02-20 17:00:00', '2022-02-20 17:00:00'),
(3, 'Gergosz', '$2y$10$nawl3af1TaiNiJR5nr.WOeh7DbOeHLZbyc0lqfKktObiJKYZLwE3W', 'gergoszivak@gmail.com', NULL, '06702103124', 0, NULL, '2022-03-31 15:51:32', '2022-03-31 15:51:32'),
(4, 'Dani', '$2y$10$egtYlsBNSAqcO5a5Od.qJeqGaM0EbMiqt9s5cTsk3Pw1ISN./VQpe', 'dani@gmail.com', NULL, '01234554433', 0, NULL, '2022-03-31 16:03:25', '2022-03-31 16:03:25'),
(5, 'rita', '$2y$10$cq4H3bp2ACYVfTGdvaolde/ETi4OIk40xQMSMhvNXRL3OTz8uFDwy', 'rita@gmail.com', NULL, '06578923455', 0, NULL, '2022-03-31 16:22:23', '2022-03-31 16:22:23');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advertisements_book_id_foreign` (`book_id`),
  ADD KEY `advertisements_user_id_foreign` (`user_id`);

--
-- A tábla indexei `bgswitches`
--
ALTER TABLE `bgswitches`
  ADD KEY `bgswitches_book_id_foreign` (`book_id`),
  ADD KEY `bgswitches_genre_id_foreign` (`genre_id`);

--
-- A tábla indexei `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- A tábla indexei `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `genres_genre_unique` (`genre`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- A tábla indexei `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `genres`
--
ALTER TABLE `genres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `advertisements`
--
ALTER TABLE `advertisements`
  ADD CONSTRAINT `advertisements_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `advertisements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Megkötések a táblához `bgswitches`
--
ALTER TABLE `bgswitches`
  ADD CONSTRAINT `bgswitches_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `bgswitches_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
