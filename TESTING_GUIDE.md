# Testing Guide - Login & Password Reset Functionaliteit

## 🚀 Project Starten

### Voorwaarden
- Laravel Herd is geïnstalleerd (je hebt dit al!)
- Database is aangemaakt en gemigreerd ✅
- Vite development server draait ✅

### Applicatie URL
Met Laravel Herd is je applicatie automatisch beschikbaar op:
- **http://e3-barroc-intens.test** (of controleer je Herd instellingen)
- Of gebruik: **http://localhost:8000** als je `php artisan serve` runt

---

## 👥 Testgebruikers

Alle testgebruikers hebben het wachtwoord: **`Password123!`**

| Email | Naam | Afdeling |
|-------|------|----------|
| `admin@barroc.nl` | Admin User | Beheer |
| `sales@barroc.nl` | Sales Medewerker | Verkoop |
| `inkoop@barroc.nl` | Inkoop Medewerker | Inkoop |
| `finance@barroc.nl` | Finance Medewerker | Financiën |
| `koffie@barroc.nl` | Hoofd Koffie Afdeling | Koffie |

---

## ✅ Acceptatiecriteria Testen

### 1. Login Functionaliteit

#### Test 1.1: Succesvolle Login
1. Ga naar **http://e3-barroc-intens.test/login**
2. Vul in:
   - Email: `admin@barroc.nl`
   - Wachtwoord: `Password123!`
3. Klik op "Log in"
4. ✅ **Verwacht:** Je wordt doorgestuurd naar `/dashboard`
5. ✅ **Verwacht:** Je ziet een welkomstbericht met je naam

#### Test 1.2: Ongeldige inloggegevens
1. Ga naar **http://e3-barroc-intens.test/login**
2. Vul in:
   - Email: `admin@barroc.nl`
   - Wachtwoord: `VerkeerWachtwoord123!`
3. Klik op "Log in"
4. ✅ **Verwacht:** Duidelijke foutmelding verschijnt
5. ✅ **Verwacht:** Je blijft op de login pagina

#### Test 1.3: Rate Limiting
1. Probeer 6x achter elkaar in te loggen met verkeerde gegevens
2. ✅ **Verwacht:** Na 5 pogingen krijg je een "too many attempts" bericht
3. Wacht 1 minuut
4. ✅ **Verwacht:** Je kunt weer proberen in te loggen

#### Test 1.4: Beveiligde Routes
1. Log uit via het menu
2. Probeer direct naar **http://e3-barroc-intens.test/dashboard** te gaan
3. ✅ **Verwacht:** Je wordt automatisch doorgestuurd naar `/login`
4. ✅ **Verwacht:** Je ziet een redirect message

---

### 2. Wachtwoord Reset Functionaliteit

#### Test 2.1: Wachtwoord Reset Link Aanvragen
1. Ga naar **http://e3-barroc-intens.test/login**
2. Klik op "Forgot password?" of ga naar `/forgot-password`
3. Vul in: `sales@barroc.nl`
4. Klik op "Email password reset link"
5. ✅ **Verwacht:** Succesbericht: "A reset link will be sent if the account exists"

#### Test 2.2: Wachtwoord Reset Email (in logs)
1. Open het bestand: `storage/logs/laravel.log`
2. Zoek naar de laatste email entry
3. ✅ **Verwacht:** Je ziet een reset link in de logs
4. ✅ **Verwacht:** De link bevat een unieke token
5. Kopieer de URL uit de log (zoek naar `http://`)

#### Test 2.3: Wachtwoord Resetten
1. Plak de reset URL in je browser
2. Je komt op de reset password pagina
3. Vul in:
   - Email: `sales@barroc.nl`
   - Nieuw wachtwoord: `NewSecure123!`
   - Bevestig wachtwoord: `NewSecure123!`
4. Klik op "Reset password"
5. ✅ **Verwacht:** Je wordt doorgestuurd naar login met succesbericht
6. Log in met nieuwe wachtwoord
7. ✅ **Verwacht:** Inloggen lukt met het nieuwe wachtwoord

#### Test 2.4: Link Expiratie (24 uur)
1. Vraag een nieuwe reset link aan
2. Wacht 24 uur + 1 minuut
3. Probeer de link te gebruiken
4. ✅ **Verwacht:** Foutmelding dat de link verlopen is

#### Test 2.5: Wachtwoord Beveiligingseisen
Probeer een wachtwoord te resetten met verschillende wachtwoorden:

**Te kort (moet mislukken):**
- Wachtwoord: `Pass1!`
- ✅ **Verwacht:** Error "password must be at least 8 characters"

**Geen hoofdletters (moet mislukken):**
- Wachtwoord: `password123!`
- ✅ **Verwacht:** Error over hoofdletters

**Geen cijfers (moet mislukken):**
- Wachtwoord: `Password!`
- ✅ **Verwacht:** Error over cijfers

**Geen symbolen (moet mislukken):**
- Wachtwoord: `Password123`
- ✅ **Verwacht:** Error over symbolen

**Geldig wachtwoord (moet lukken):**
- Wachtwoord: `SecurePass123!`
- ✅ **Verwacht:** Reset succesvol

---

### 3. Dashboard Functionaliteit

#### Test 3.1: Dashboard Toegang
1. Log in als `admin@barroc.nl`
2. ✅ **Verwacht:** Dashboard laadt met moderne UI
3. ✅ **Verwacht:** Je naam wordt weergegeven in welkomstbericht
4. ✅ **Verwacht:** Je ziet 3 actie cards (Profiel, Beveiliging, Instellingen)
5. ✅ **Verwacht:** Account informatie sectie toont correcte gegevens

#### Test 3.2: Dashboard Links
1. Klik op "Mijn Profiel" card
2. ✅ **Verwacht:** Je gaat naar `/settings/profile`
3. Ga terug en klik op "Beveiliging" card
4. ✅ **Verwacht:** Je gaat naar `/settings/password`
5. Ga terug en klik op "Instellingen" card
6. ✅ **Verwacht:** Je gaat naar `/settings/appearance`

---

## 🔒 Beveiliging Checks

### Beveiligingseisen Validatie
- ✅ Password minimaal 8 karakters
- ✅ Password bevat hoofdletters EN kleine letters
- ✅ Password bevat cijfers
- ✅ Password bevat symbolen (!@#$%^&*)
- ✅ Password niet in database van gelekte passwords (Have I Been Pwned check)

### Session Beveiliging
- ✅ Login throttling (max 5 pogingen per minuut)
- ✅ CSRF protection actief
- ✅ Session regeneration na login
- ✅ Remember token wordt ge-refresh bij password reset

### Password Reset Beveiliging
- ✅ Reset tokens zijn uniek per gebruiker
- ✅ Tokens expiren na 24 uur (1440 minuten)
- ✅ Tokens zijn one-time gebruik (automatisch invalid na gebruik)
- ✅ Rate limiting op reset link requests (60 seconden throttle)

---

## 📋 Snelle Test Checklist

```
[ ] Login pagina is bereikbaar via /login
[ ] Inloggen met admin@barroc.nl / Password123! werkt
[ ] Verkeerde credentials tonen foutmelding
[ ] Dashboard is alleen bereikbaar na login
[ ] Niet-ingelogde gebruikers worden geredirect naar login
[ ] Password reset link kan worden aangevraagd
[ ] Reset link wordt gegenereerd (check logs)
[ ] Nieuw wachtwoord instellen werkt
[ ] Nieuwe wachtwoord voldoet aan beveiligingseisen
[ ] Dashboard toont correcte gebruikersinformatie
[ ] Alle dashboard links werken correct
```

---

## 🐛 Troubleshooting

### Database errors
```powershell
php artisan migrate:fresh --seed
```

### Vite not running
```powershell
npm run dev
```

### Cache issues
```powershell
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Session issues
```powershell
php artisan session:clear
```

---

## 📝 Extra Opmerkingen

- **Email in Development:** Emails worden gelogd naar `storage/logs/laravel.log` in plaats van verzonden
- **Herd:** Als je Herd gebruikt, is de applicatie automatisch bereikbaar zonder `php artisan serve`
- **Two-Factor:** 2FA is beschikbaar maar niet verplicht voor testgebruikers

---

## ✨ Geïmplementeerde Features

✅ **Login functionaliteit**
- Werkende login pagina op `/login`
- Authenticatie met email/wachtwoord
- Rate limiting (5 pogingen per minuut)
- Foutafhandeling met duidelijke berichten
- Redirect naar dashboard na succesvolle login
- Middleware bescherming voor beveiligde routes

✅ **Password Reset functionaliteit**  
- Reset link aanvragen via email
- Unieke tokens per reset request
- 24 uur expiratie op reset links
- Wachtwoord validatie (8+ chars, mixed case, cijfers, symbolen)
- Controle tegen gelekte passwords

✅ **Dashboard**
- Gepersonaliseerd welkomstbericht
- Snelle links naar profiel, beveiliging, instellingen
- Account informatie overzicht
- Modern responsive design
- Dark mode support

✅ **Beveiliging**
- CSRF protection
- Session regeneration
- Password hashing met bcrypt
- Rate limiting op login en password reset
- Middleware authentication
- Remember token refresh bij password reset

---

Veel succes met testen! 🚀☕
