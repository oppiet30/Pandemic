# Pandemic — English interface

The player and administrator screens, game controls, registration forms,
result messages and password-recovery email text are displayed in English.
The application uses native PHP and MySQL/MariaDB, with `ASW` as its web directory.

Database tables, column names, stored country/status/color values, form field
names and API parameters retain their existing names. `display.php` translates
stored labels only when displaying them. Custom player names, game titles and
descriptions are displayed as entered. Database translation is a separate next step.

## Password-recovery email

Configure `PANDEMIC_SMTP_USERNAME` and `PANDEMIC_SMTP_PASSWORD` in the PHP web
server's environment. The recovery script reads these variables rather than
using the original hardcoded email credentials. Keep the values outside git.
The existing Gmail SMTP host, port and recovery-link URL still need configuration
for your installation; this translation does not send test emails.

## Validation

The application PHP files were syntax checked with PHP 8.3. Standalone and inline
JavaScript were syntax checked with Node. Rendered PHP fixtures covered lobby,
active-player, waiting-player, victory and registration screens. Checks also
confirmed that form identifiers, submitted option values, links and existing
SQL statements were preserved. A live game against a configured database has
not been tested as part of the translation.

## Gameplay regression checks

With PHP CLI, MySQLi and a dedicated test MariaDB/MySQL server available:

```bash
MYSQL_TEST_HOST=127.0.0.1 MYSQL_TEST_USER=root php tests/gameplay.php
```

Run this from the repository root. Optional variables are `MYSQL_TEST_PORT` and
`MYSQL_TEST_PASSWORD`. The test creates a randomly named database, imports schema
and board metadata (not the sample accounts), and drops that database afterward.
The test account needs permission to create and drop databases. GitHub Actions
runs it against an isolated MariaDB service on GitHub's servers.

These regressions check startup under strict SQL mode, initial setup, turn
advancement, epidemic targets, curing and cross-game isolation, four-cure victory,
defeat JSON responses, and login validation. Passing them does not establish
complete fidelity to the official board-game rules or a full security review.
