# Projekt-Roadmap: Wo ist das Drachenei? Forum

Dieses Dokument skizziert die notwendigen Schritte zur Umwandlung der aktuellen Laravel-Anwendung in ein spezialisiertes Forum für "Craftattack 13: Wo ist das Drachenei?", mit einem Fokus auf Twitch- und Discord-OAuth-Authentifizierung und einem Rollen-System.

## 1. Benutzerrollen-Definition und -Implementierung

*   [x] **Ziel:** Einführung eines Rollen-Systems für Benutzer (`admin`, `moderator`, `user`).
*   [x] **Schritte:**
    *   [x] Erstellung eines PHP-Enums (`App\Enums\UserRole`) für die Rollen `Admin`, `Moderator`, `User`.
    *   [x] Hinzufügen einer `role`-Spalte (String oder Enum-Typ) zur `users`-Tabelle über eine neue Migration.
    *   [x] Aktualisierung des `User`-Models, um die `role`-Eigenschaft zu nutzen und Standardwerte festzulegen (z.B. `UserRole::User` als Standard).

## 2. Authentifizierungssystem-Anpassung (OAuth Only)

*   [x] **Ziel:** Entfernung der E-Mail/Passwort-Authentifizierung und Implementierung von Twitch- und Discord-OAuth als einzige Anmeldemethoden.
*   [x] **Schritte:**
    *   [x] **Entfernung der Standard-Authentifizierung:**
        *   [x] Deaktivierung oder Entfernung aller Routen, Controller-Methoden und Views, die sich auf E-Mail/Passwort-Registrierung und -Login beziehen (z.B. `Auth::routes()`, `LoginController`, `RegisterController`).
        *   [x] Anpassung der `User`-Model-Eigenschaften (z.B. `password` auf `nullable` setzen oder entfernen, `email_verified_at` anpassen).
    *   [x] **Twitch OAuth Integration:**
        *   [x] Installation und Konfiguration von Laravel Socialite.
        *   [x] Hinzufügen der Twitch-Provider-Konfiguration in `config/services.php`.
        *   [x] Implementierung der OAuth-Routen und Controller-Logik für Twitch (Weiterleitung, Callback, Benutzererstellung/Login).
    *   [x] **Discord OAuth Integration:**
        *   [x] Recherche und Integration eines geeigneten Discord Socialite Providers (z.B. `socialiteproviders/discord`). Falls kein passender Provider gefunden wird, manuelle Implementierung des OAuth-Flows.
        *   [x] Hinzufügen der Discord-Provider-Konfiguration in `config/services.php`.
        *   [x] Implementierung der OAuth-Routen und Controller-Logik für Discord.
    *   [x] **Multi-Provider-Verknüpfung:**
        *   [x] Entwicklung einer Strategie zur Verknüpfung mehrerer OAuth-Konten (Twitch, Discord) mit einem einzigen Benutzerkonto, idealerweise basierend auf der E-Mail-Adresse.
        *   [x] Erstellung einer neuen Migration und Tabelle (z.B. `social_accounts`) zur Speicherung von Provider-spezifischen IDs, Access/Refresh-Tokens und der Verknüpfung zur `users`-Tabelle.

## 3. Datenbank-Migrationen

*   [x] **Ziel:** Aktualisierung der Datenbankstruktur zur Unterstützung der neuen Rollen und OAuth-Verknüpfungen.
*   [x] **Schritte:**
    *   [x] Migration zur Hinzufügung der `role`-Spalte zur `users`-Tabelle.
    *   [x] Migration zur Erstellung der `social_accounts`-Tabelle (falls erforderlich).

## 4. Forum-Kernfunktionalität (Spätere Phase)

*   [x] **Ziel:** Implementierung der grundlegenden Forum-Funktionen.
*   [x] **Schritte:**
    *   [x] Erstellung von Models für Themen (`Threads`) und Nachrichten (`ThreadMessages`). (Migrations sind ebenfalls erstellt)
    *   [x] Implementierung von CRUD-Operationen für Themen und Nachrichten.
    *   [x] Anzeige von Themen und Nachrichten in einer übersichtlichen Struktur.
    *   [x] Implementierung von Medien-Uploads für Nachrichten (z.B. Bilder, Videos). (Migration ist erstellt)

## 5. UUIDs für Migrationen

*   [x] **Ziel:** Verwendung von UUIDs anstelle von Auto-Increment-IDs für Primärschlüssel in relevanten Tabellen.
*   [x] **Schritte:**
    *   [x] Überprüfung bestehender Migrationen und Aktualisierung, um UUIDs für Primärschlüssel zu verwenden (z.B. `users`, `social_accounts`, `threads`, `thread_messages`).
    *   [ ] Sicherstellen, dass zukünftige Migrationen standardmäßig UUIDs verwenden.

## 6. Autorisierung und Berechtigungen

*   [x] **Ziel:** Sicherstellung, dass Benutzeraktionen basierend auf ihren Rollen eingeschränkt sind.
*   [x] **Schritte:**
    *   [x] Implementierung von Laravel Gates oder Policies zur Rollen-basierten Autorisierung (z.B. nur Admins/Moderatoren können Beiträge löschen oder bearbeiten).
    *   [x] Erstellung von `ThreadPolicy` und `ThreadMessagePolicy`.
    *   [x] Registrierung der Policies in `AuthServiceProvider`.
    *   [x] Aktualisierung der `ThreadController` und `ThreadMessageController` zur Nutzung der Policies.

## 7. Custom Error Handling

*   [x] **Ziel:** Implementierung einer benutzerdefinierten Fehlerbehandlung für Nicht-Validierungsfehler.
*   [x] **Schritte:**
    *   [x] Erstellung einer `pages.error`-Ansicht zur Anzeige von Fehlercodes.
    *   [x] Anpassung des `Handler.php`, um HTTP-Fehler (einschließlich 404) abzufangen und die `pages.error`-Ansicht zurückzugeben.

## 8. Controller- und View-Refactoring

*   [x] **Ziel:** Trennung von API- und Web-Controllern und Erstellung von Views für die Web-Controller.
*   [x] **Schritte:**
    *   [x] Verschieben der bestehenden `ThreadController` und `ThreadMessageController` in den `Api/` Namespace.
    *   [x] Erstellung neuer Web-Controller (`ThreadController`, `ThreadMessageController`), die Views zurückgeben.
    *   [x] Erstellung des `layouts.app`-Views.
    *   [x] Erstellung von Views für die Web-Controller (z.B. `threads/index.blade.php`, `threads/show.blade.php`, `threads/create.blade.php`, `thread_messages/edit.blade.php`).
    *   [x] Aktualisierung der Routen in `routes/web.php`, um auf die neuen Web- und API-Controller zu verweisen.