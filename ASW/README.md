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
