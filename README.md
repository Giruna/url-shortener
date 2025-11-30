# 🚀 Laravel URL Shortener + FilamentPHP

Ez a repository egy **Laravel 12.x + FilamentPHP 4.x** alapú projektet tartalmaz, amely egy egyszerű URL rövidítő alkalmazást valósít meg.  

A projekt tartalmaz egy `run.sh` scriptet, ami az indításhoz szükséges parancsokat automatikusan lefuttatja:

- 🔑 `php artisan key:generate`
- 🗄️ `php artisan migrate`
- 👤 Alapértelmezett admin felhasználó létrehozása: `admin / abcd1234`
- ⚙️ A FilamentPHP admin felület az `/admin/` URI alatt érhető el (alapértelmezett konfiguráció).

---

## Funkcionalitás

## 🌐 Nyilvános rövidítés (belépés nélkül)

### 1️⃣ `/`
Egy egyszerű HTML oldal, ahol megadható a hosszú URL. A felület visszaadja a rövidített URL-t.
  

**Példa használat:**

### 2️⃣ `/r/<code>`
Ez a végpont a rövid kóddal hívható meg, és **átirányítja** a látogatót az eredeti, hosszú URL-re.

---

## 🛠️ FilamentPHP admin felület

- URI: `/admin/`  
- Belépés: `admin / abcd1234`  
- Funkciók:  
  - A rendszerben tárolt **rövid kódok és hosszú URL-ek megtekintése**
  - Szerkesztés és törlés  
  - Keresés **kód vagy hosszú URL alapján**

---

## ✅ Tesztelés

A projekt tartalmaz **unit teszteket**, amelyek lefedik az URL rövidítés funkcionalitását.

- Tesztek helye: `tests/Feature/UrlShortenerTest.php`
- Futtatás:

```bash
php artisan test
