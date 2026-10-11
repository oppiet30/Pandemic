# Pandemic

[![Gameplay regression tests](https://github.com/oppiet30/Pandemic/actions/workflows/gameplay.yml/badge.svg?branch=master)](https://github.com/oppiet30/Pandemic/actions/workflows/gameplay.yml)

A browser-based cooperative disease-control game built with native PHP,
MySQL/MariaDB, JavaScript, and jQuery. This fork maintains the original project,
adds English and Portuguese interface support, and includes automated gameplay
regression checks.

Players join a game, move between cities, treat infections, build research
stations, and discover cures. The current interface supports games with two
to four players.

## Project status

This is a legacy application being maintained and improved. Automated checks
cover selected gameplay, login, and translation behavior. They do not establish
complete fidelity to the official board-game rules or production readiness.
A browser walkthrough on your configured server is recommended.

## Requirements

- PHP with the MySQLi extension.
- MariaDB or MySQL.
- Apache, another PHP-capable web server, or PHP's development server for local use.
- A browser with JavaScript enabled. The pages load jQuery, Bootstrap, and fonts
  from external services, so those resources need to be reachable.
- PHP CLI for tests, and Node.js for checking rendered JavaScript.

The application uses plain PHP; it does not require Laravel or a Composer
installation. PHPMailer is already included in the repository.

## Local setup

### 1. Clone your fork

```bash
gh repo clone oppiet30/Pandemic
cd Pandemic
```

### 2. Prepare a database

The bundled [asw024.sql](asw024.sql) contains the schema, board metadata, and
historical sample accounts and games. Import it into a new database; avoid
importing over a database that already contains your own data.

For example, create a database named `asw024` using your database administrator
account, then import the dump:

```sql
CREATE DATABASE asw024 CHARACTER SET utf8mb4;
```

```bash
mariadb -u YOUR_DATABASE_ADMIN -p asw024 < asw024.sql
```

Replace `YOUR_DATABASE_ADMIN` with the account you use to administer MariaDB.
Create a separate application database user with the permissions needed to
read and update this database. The included sample rows are retained; changing
the interface language does not translate or remove them.

### 3. Configure the connection

Edit your local `ASW/db_config.php` and set:

| Variable | Meaning |
| --- | --- |
| `$dbhost` | Database hostname and optional port. |
| `$dbuser` | Application database user. |
| `$dbpass` | That user's password. |
| `$dbname` | Database name, such as `asw024`. |

The current application reads these settings from that PHP file. Keep your
local credentials out of commits and pull requests.

### 4. Open the application

For Apache, point the virtual host's document root at the repository's **`ASW`
directory**. Keep the SQL dump and repository documentation outside the served
document root.

For a local development session, run this from the repository root:

```bash
cd ASW
php -S 127.0.0.1:8080
```

Open <http://127.0.0.1:8080/>. Stop the development server with Ctrl+C when done.
PHP's development server is intended for local development.

## Using the game

1. Register an account and log in.
2. Create a game or join an existing game from the game list.
3. Have another player join. The creator can start the game when the lobby allows it.
4. Use the game controls when it is your turn.

The administrator interface is under `/admin/` and uses separate administrator
records. Registering a player does not create an administrator account.

## English and Portuguese

Choose **English** or **Português** with the Language / Idioma selector, then
click Apply / Aplicar. English is the default. A cookie remembers your choice;
`?lang=en` and `?lang=pt` also select a language explicitly.

Both languages use the same game code, database, and gameplay fixes. Stored
city names, color/status identifiers, request values, and user-authored game
names and descriptions retain their existing values.

See [ASW/README.md](ASW/README.md) for language catalog maintenance and the
presentation helpers.

## Password-recovery email

The recovery script reads `PANDEMIC_SMTP_USERNAME` and
`PANDEMIC_SMTP_PASSWORD` from the PHP server's environment. Configure these
outside Git. The SMTP host, port, and recovery-link URL in
`ASW/send_recover.php` also need to match your installation.

The legacy recovery flow has not been validated end to end for public use.
Automated tests do not send email.

## Tests and GitHub Actions

Run these commands from the repository root.

Translation and rendered-page checks do not require a database:

```bash
php tests/i18n.php
node tests/check-inline-js.cjs
```

The Node command also runs the PHP assertions and checks the generated inline
JavaScript syntax; it does not execute browser interactions.

For gameplay and login checks, use a dedicated test database server and an
account allowed to create and drop databases:

```bash
MYSQL_TEST_HOST=127.0.0.1 MYSQL_TEST_USER=YOUR_TEST_USER php tests/gameplay.php
PANDEMIC_TEST_LOCALE=pt MYSQL_TEST_HOST=127.0.0.1 MYSQL_TEST_USER=YOUR_TEST_USER php tests/gameplay.php
```

Optional settings are `MYSQL_TEST_PORT` and `MYSQL_TEST_PASSWORD`. Each run
creates a randomly named database, imports the schema and board metadata,
and drops that database afterward. The tests do not import the sample accounts
or historical games.

[GitHub Actions](https://github.com/oppiet30/Pandemic/actions) checks PHP syntax,
translations, rendered JavaScript, and database regressions in both languages.
The workflow uses GitHub-hosted runners and an isolated MariaDB service.

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for pull request guidance and AI-assisted
commit attribution. Include a description of your change, relevant testing,
and any known limitations.
