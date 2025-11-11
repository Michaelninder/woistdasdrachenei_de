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

*   [ ] **Ziel:** Implementierung der grundlegenden Forum-Funktionen.
*   [ ] **Schritte:**
    *   [ ] Erstellung von Models, Controllern und Views für Themen (`Threads`) und Nachrichten (`ThreadMessages`).
    *   [ ] Implementierung von CRUD-Operationen für Themen und Nachrichten.
    *   [ ] Anzeige von Themen und Nachrichten in einer übersichtlichen Struktur.
    *   [ ] Implementierung von Medien-Uploads für Nachrichten (z.B. Bilder, Videos).

## 5. UUIDs für Migrationen

*   [ ] **Ziel:** Verwendung von UUIDs anstelle von Auto-Increment-IDs für Primärschlüssel in relevanten Tabellen.
*   [ ] **Schritte:**
    *   [ ] Überprüfung bestehender Migrationen und Aktualisierung, um UUIDs für Primärschlüssel zu verwenden (z.B. `users`, `social_accounts`, `threads`, `thread_messages`).
    *   [ ] Sicherstellen, dass zukünftige Migrationen standardmäßig UUIDs verwenden.

## 6. Autorisierung und Berechtigungen

*   [ ] **Ziel:** Sicherstellung, dass Benutzeraktionen basierend auf ihren Rollen eingeschränkt sind.
*   [ ] **Schritte:**
    *   [ ] Implementierung von Laravel Gates oder Policies zur Rollen-basierten Autorisierung (z.B. nur Admins/Moderatoren können Beiträge löschen oder bearbeiten).

## 7. Deutsche Lokalisierung

*   [ ] **Ziel:** Sicherstellung, dass die gesamte Anwendung auf Deutsch ist.
*   [ ] **Schritte:**
    *   [ ] Überprüfung und Anpassung aller Frontend-Texte, Validierungsnachrichten und Systemmeldungen auf Deutsch.