# System Zarządzania Kodami Numerycznymi

Aplikacja webowa zbudowana w oparciu o framework Laravel 11, służąca do generowania, przechowywania oraz bezpiecznego usuwania unikalnych 10-cyfrowych kodów identyfikacyjnych.

## Kluczowe Funkcjonalności

- **Autoryzacja i zabezpieczenia**: System logowania i rejestracji oparty na Laravel Breeze z wymuszeniem silnej polityki haseł (wymagane znaki specjalne, cyfry oraz małe i wielkie litery).
- **Zarządzanie kodami**: Generowanie unikalnych 10-cyfrowych ciągów przy użyciu bezpiecznego generatora `random_int()`.
- **Izolacja danych**: Pełne powiązanie rekordów z użytkownikiem (relacja One-to-Many). Każdy użytkownik ma dostęp wyłącznie do wygenerowanych przez siebie danych.
- **Masowe operacje**: System usuwania wielu kodów jednocześnie z implementacją transakcji bazodanowych (Database Transactions), co zapewnia atomowość operacji zgodnie z zasadą "wszystko albo nic".
- **Optymalizacja wydajności**: Wykorzystanie mechanizmu Eager Loading w celu wyeliminowania problemu zapytań N+1 podczas wyświetlania listy kodów wraz z danymi autorów.

## Architektura i Standardy

- **Backend**: PHP 8.3 / Laravel 11 (MVC).
- **Frontend**: Bootstrap 5 wzbogacony o niestandardowe style, czcionki z rodziny Inter oraz semantyczne tagi HTML5 z atrybutami poprawiającymi dostępność (aria-labels, autocomplete).
- **Baza danych**: Relacyjna baza danych (MySQL/PostgreSQL) z nałożonymi ograniczeniami UNIQUE oraz kluczami obcymi z kaskadowym usuwaniem (onDelete cascade).
- **Walidacja**: Wielopoziomowa weryfikacja danych – od strony frontendu (HTML5) po rygorystyczną walidację po stronie serwera przy użyciu wyrażeń regularnych (Regex).

## Instalacja i Uruchomienie

1. Sklonuj repozytorium:
```bash
git clone https://github.com/kamilkamieniarz/laravel-codes-manager.git
```

2. Zainstaluj zależności PHP:
```bash
composer install
```

3. Zainstaluj i zbuduj zasoby frontendowe:
```bash
npm install && npm run build
```

4. Skonfiguruj środowisko:
```bash
cp .env.example .env
php artisan key:generate
```
*(Należy uzupełnić dane dostępowe do bazy danych w pliku .env)*

5. Uruchom migracje wraz z zasileniem bazy danymi testowymi:
```bash
php artisan migrate:fresh --seed
```

## Dane do Testów

W celach rekrutacyjnych przygotowano konto testowe z wygenerowanymi danymi:

- **Login**: recruiter@example.com
- **Hasło**: recruiter123

Konto posiada przypisane 20 kodów, co pozwala na natychmiastowe przetestowanie mechanizmu paginacji oraz widoku listy.