# 🐶 PetStore API Client - Laravel

## 📌 Opis projektu
Projekt to aplikacja Laravel umożliwiająca interakcję z zewnętrznym **PetStore API**.
Pozwala użytkownikowi na **dodawanie, pobieranie, edycję oraz usuwanie zwierzaków** poprzez prosty interfejs formularzowy.
Komunikacja odbywa się wyłącznie poprzez API, **bez zapisywania danych w lokalnej bazie danych**.

## 🛠️ Technologie
- **Backend**: Laravel
- **Frontend**: Blade (proste formularze)
- **Autoryzacja**: API Key

## 🚀 Instalacja i uruchomienie

### 1️⃣ Sklonuj repozytorium
```bash
git clone https://github.com/maciekryb/petstore-api.git
cd petstore-api
```

### 2️⃣ Zainstaluj zależności
```bash
composer install
```

### 3️⃣ Skonfiguruj plik .env
Skopiuj .env.example i zmień nazwę na .env
Dodaj klucz API do PetStore API:
```ini
PETSTORE_API_KEY=your_api_key_here
```

### 4️⃣ Uruchom serwer deweloperski
```bash
php artisan serve
```

### 5️⃣ Otwórz aplikację w przeglądarce
```
http://127.0.0.1:8000
```

## 📌 Kluczowe funkcjonalności
- ✅ Dodawanie zwierzaka do PetStore API
- ✅ Pobieranie danych o zwierzakach
- ✅ Edycja i usuwanie zwierzaków
- ✅ Gotowe kategorie i tagi wybierane z listy

## 📞 API PetStore
Projekt korzysta z [Swagger PetStore API](https://petstore.swagger.io/#/).

