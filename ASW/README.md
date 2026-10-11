# Pandemic — English and Portuguese interface

The player and administrator screens, game controls, registration forms,
result messages and password-recovery email text support English and Portuguese.
The application uses native PHP and MySQL/MariaDB, with `ASW` as its web directory.

Database tables, column names, stored country/status/color values, form field
names and API parameters retain their existing names. `display.php` translates
stored labels only when displaying them. Custom player names, game titles and
descriptions are displayed as entered. Both languages share the same database
and gameplay fixes; switching languages does not require a migration.

## Choosing and maintaining a language

Use the Language / Idioma selector on player and administrator pages, then
click Apply / Aplicar. English is the default. A cookie remembers the choice
for a year; `?lang=en` or `?lang=pt` selects it explicitly. The selector preserves
scalar query parameters, including the current game ID. Invalid language values
fall back to the saved choice or English and cannot select arbitrary files.

`lang/en.php` and `lang/pt.php` contain presentation catalogs. `i18n.php` provides
the lookup and escaping helpers. English source strings are the message keys;
add a matching entry to each catalog when adding interface text. Use
`pandemic_text()` in HTML, `pandemic_t()` for plain text such as email subjects,
and `pandemic_js_markup()` for trusted application-authored HTML embedded in
JavaScript. Never pass user-authored text to a translation lookup or markup
helper. `display.php` handles stored city, country, color, and status labels at
the display boundary. Form values, API responses used as protocol tokens, and
CSS classes keep their existing identifiers.

## Password-recovery email

Configure `PANDEMIC_SMTP_USERNAME` and `PANDEMIC_SMTP_PASSWORD` in the PHP web
server's environment. The recovery script reads these variables rather than
using the original hardcoded email credentials. Keep the values outside git.
The existing Gmail SMTP host, port and recovery-link URL still need configuration
for your installation; this translation does not send test emails.

## Validation

GitHub Actions syntax checks application PHP and runs rendered-page assertions
for both languages, including registration, recovery, lobby, active-player,
waiting-player, and finished-game views. Node compiles their generated inline
JavaScript. These are fixture checks, not a browser walkthrough or a live SMTP
test. Run the translation suite without a database using:

```bash
php tests/i18n.php
node tests/check-inline-js.cjs
```

The Node command also runs the PHP translation assertions before checking scripts.

## Gameplay regression checks

With PHP CLI, MySQLi and a dedicated test MariaDB/MySQL server available:

```bash
MYSQL_TEST_HOST=127.0.0.1 MYSQL_TEST_USER=root php tests/gameplay.php
PANDEMIC_TEST_LOCALE=pt MYSQL_TEST_HOST=127.0.0.1 MYSQL_TEST_USER=root php tests/gameplay.php
```

Run this from the repository root. Optional variables are `MYSQL_TEST_PORT` and
`MYSQL_TEST_PASSWORD`. The test creates a randomly named database, imports schema
and board metadata (not the sample accounts), and drops that database afterward.
The test account needs permission to create and drop databases. GitHub Actions
runs it in both languages against an isolated MariaDB service on GitHub's servers.

These regressions check startup under strict SQL mode, initial setup, turn
advancement, epidemic targets, curing and cross-game isolation, four-cure victory,
defeat JSON responses, and login validation. Passing them does not establish
complete fidelity to the official board-game rules or a full security review.
