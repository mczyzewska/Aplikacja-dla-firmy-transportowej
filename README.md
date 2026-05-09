# 🚚 TransportApp — System Zarządzania Firmą Transportową

> **Laravel 12 · PHP 8.2 · Tailwind CSS · Alpine.js**  
> Webowa aplikacja do zarządzania przesyłkami, kurierami, magazynami i fakturami dla firmy transportowej.

---

## 📋 Opis projektu

TransportApp to aplikacja webowa stworzona z myślą o firmach transportowych. Umożliwia kompleksowe zarządzanie całym procesem logistycznym — od przyjęcia paczki, przez jej śledzenie i transport, aż po wystawienie faktury dla klienta.

System obsługuje trzy poziomy dostępu: **administratora**, **pracownika** i **klienta**, z dedykowanymi widokami i uprawnieniami dla każdej roli.

---

## ✨ Funkcjonalności

### 📦 Zarządzanie paczkami
- Rejestracja paczek z numerem śledzenia, wagą i opisem
- Przypisanie paczki do klienta, kuriera, magazynu i punktu odbioru
- Historia statusów paczki z datą każdej zmiany

### 🚛 Przesyłki i transport
- Tworzenie przesyłek z datą nadania i przewidywaną datą dostarczenia
- Obsługa różnych metod transportu
- Powiązanie przesyłki z punktem odbioru

### 👥 Zarządzanie użytkownikami i rolami
- Trzy role: `admin`, `employee`, `client`
- Profil klienta z danymi kontaktowymi i NIP-em
- Rejestracja i logowanie przez Laravel Breeze

### 🏪 Punkty odbioru i magazyny
- Zarządzanie siecią punktów odbioru (nazwa, miasto, adres, kod)
- Obsługa magazynów z oznaczeniem magazynu głównego

### 🧾 Faktury
- Generowanie faktur dla klientów
- Pozycje faktury powiązane z konkretnymi paczkami
- Śledzenie statusu płatności i terminu płatności

---

## 🗄️ Model danych

```
User ──── Client ──┬── Package ──┬── Shipment ── PickupPoint
                   │             ├── PackageStatus
                   │             ├── InvoiceItem ── Invoice
                   │             ├── Courier
                   │             └── Warehouse
                   └── Invoice ── InvoiceItem
```

| Model | Opis |
|-------|------|
| `User` | Konto użytkownika z rolą (admin/employee/client) |
| `Client` | Profil klienta (telefon, adres, NIP) |
| `Package` | Paczka z numerem śledzenia i statusem |
| `PackageStatus` | Historia zmian statusu paczki |
| `Shipment` | Przesyłka — trasa i daty transportu |
| `Courier` | Kurier z numerem rejestracyjnym pojazdu |
| `Warehouse` | Magazyn (główny lub pomocniczy) |
| `PickupPoint` | Punkt odbioru paczki |
| `Invoice` | Faktura dla klienta |
| `InvoiceItem` | Pozycja faktury powiązana z paczką |

---

## 🛠️ Stack technologiczny

| Technologia | Wersja | Zastosowanie |
|-------------|--------|-------------|
| **Laravel** | 12.x | Backend, routing, ORM, autoryzacja |
| **PHP** | 8.2+ | Język backendu |
| **Laravel Breeze** | 2.x | Autentykacja i rejestracja |
| **Tailwind CSS** | 3.x | Stylowanie interfejsu |
| **Alpine.js** | 3.x | Interaktywność frontendu |
| **Vite** | 7.x | Bundler zasobów frontendowych |
| **PHPUnit** | 11.x | Testy jednostkowe |

---

## 🚀 Instalacja

### Wymagania
- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL / SQLite

### Kroki

```bash
# 1. Sklonuj repozytorium
git clone https://github.com/[twoj-login]/transport-app.git
cd transport-app

# 2. Zainstaluj zależności PHP i JS, skonfiguruj .env i uruchom migracje
composer run setup

# 3. Uruchom serwer deweloperski
composer run dev
```

Aplikacja będzie dostępna pod adresem `http://localhost:8000`.

---

## 🧪 Testy

```bash
composer run test
```

---

## 👤 Autor

**[Imię i Nazwisko]**  
[Opcjonalnie: link do profilu GitHub]  
[Rok]
