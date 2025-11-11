# Projekt-Roadmap: Wo ist das Drachenei? Forum

Dieses Dokument skizziert die notwendigen Schritte zur Umwandlung der aktuellen Laravel-Anwendung in ein spezialisiertes Forum für "Craftattack 13: Wo ist das Drachenei?", mit einem Fokus auf Twitch- und Discord-OAuth-Authentifizierung und einem Rollen-System.

## 1. Benutzerrollen-Definition und -Implementierung

*   [ ] **Ziel:** Einführung eines Rollen-Systems für Benutzer (`admin`, `moderator`, `user`).
*   [ ] **Schritte:**
    *   [ ] Erstellung eines PHP-Enums (`App\Enums\UserRole`) für die Rollen `Admin`, `Moderator`, `User`.
    *   [ ] Hinzufügen einer `role`-Spalte (String oder Enum-Typ) zur `users`-Tabelle über eine neue Migration.
    *   [ ] Aktualisierung des `User`-Models, um die `role`-Eigenschaft zu nutzen und Standardwerte festzulegen (z.B. `UserRole::User` als Standard).

## 2. Authentifizierungssystem-Anpassung (OAuth Only)

*   [ ] **Ziel:** Entfernung der E-Mail/Passwort-Authentifizierung und Implementierung von Twitch- und Discord-OAuth als einzige Anmeldemethoden.
*   [ ] **Schritte:**
    *   [ ] **Entfernung der Standard-Authentifizierung:**
        *   [ ] Deaktivierung oder Entfernung aller Routen, Controller-Methoden und Views, die sich auf E-Mail/Passwort-Registrierung und -Login beziehen (z.B. `Auth::routes()`, `LoginController`, `RegisterController`).
        *   [ ] Anpassung der `User`-Model-Eigenschaften (z.B. `password` auf `nullable` setzen oder entfernen, `email_verified_at` anpassen).
    *   [ ] **Twitch OAuth Integration:**
        *   [ ] Installation und Konfiguration von Laravel Socialite.
        *   [ ] Hinzufügen der Twitch-Provider-Konfiguration in `config/services.php`.
        *   [ ] Implementierung der OAuth-Routen und Controller-Logik für Twitch (Weiterleitung, Callback, Benutzererstellung/Login).
    *   [ ] **Discord OAuth Integration:**
        *   [ ] Recherche und Integration eines geeigneten Discord Socialite Providers (z.B. `socialiteproviders/discord`). Falls kein passender Provider gefunden wird, manuelle Implementierung des OAuth-Flows.
        *   [ ] Hinzufügen der Discord-Provider-Konfiguration in `config/services.php`.
        *   [ ] Implementierung der OAuth-Routen und Controller-Logik für Discord.
    *   [ ] **Multi-Provider-Verknüpfung:**
        *   [ ] Entwicklung einer Strategie zur Verknüpfung mehrerer OAuth-Konten (Twitch, Discord) mit einem einzigen Benutzerkonto, idealerweise basierend auf der E-Mail-Adresse.
        *   [ ] Erstellung einer neuen Migration und Tabelle (z.B. `social_accounts`) zur Speicherung von Provider-spezifischen IDs, Access/Refresh-Tokens und der Verknüpfung zur `users`-Tabelle.

## 3. Datenbank-Migrationen

*   [ ] **Ziel:** Aktualisierung der Datenbankstruktur zur Unterstützung der neuen Rollen und OAuth-Verknüpfungen.
*   [ ] **Schritte:**
    *   [ ] Migration zur Hinzufügung der `role`-Spalte zur `users`-Tabelle.
    *   [ ] Migration zur Erstellung der `social_accounts`-Tabelle (falls erforderlich).

## 4. Forum-Kernfunktionalität (Spätere Phase)

*   [ ] **Ziel:** Implementierung der grundlegenden Forum-Funktionen.
*   [ ] **Schritte:**
    *   [ ] Erstellung von Models, Controllern und Views für Themen (`Topics`) und Beiträge (`Posts`).
    *   [ ] Implementierung von CRUD-Operationen für Themen und Beiträge.
    *   [ ] Anzeige von Themen und Beiträgen in einer übersichtlichen Struktur.

## 5. Autorisierung und Berechtigungen

*   [ ] **Ziel:** Sicherstellung, dass Benutzeraktionen basierend auf ihren Rollen eingeschränkt sind.
*   [ ] **Schritte:**
    *   [ ] Implementierung von Laravel Gates oder Policies zur Rollen-basierten Autorisierung (z.B. nur Admins/Moderatoren können Beiträge löschen oder bearbeiten).

## 6. Deutsche Lokalisierung

*   [ ] **Ziel:** Sicherstellung, dass die gesamte Anwendung auf Deutsch ist.
*   [ ] **Schritte:**
    *   [ ] Überprüfung und Anpassung aller Frontend-Texte, Validierungsnachrichten und Systemmeldungen auf Deutsch.