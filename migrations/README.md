# English table names

Fresh installations use the English names in `asw024.sql`. Existing databases
need the forward migration **once**, together with the updated application code.
Do not import the full dump over an existing database.

| Original | English |
| --- | --- |
| `admin` | `admins` |
| `cartas` | `cards` |
| `cartas_jogador` | `player_cards` |
| `cidades` | `cities` |
| `cidades_infectadas` | `city_infections` |
| `doencas_erradicadas` | `disease_cures` |
| `estado_jogo` | `game_states` |
| `jogo` | `games` |
| `user` | `users` |

Only table names change. Columns, accounts, passwords, games, board metadata,
stored language values, indexes and relationships are retained. `disease_cures`
holds each game's four cure flags.

## Upgrade an existing database

From the repository root, replace `YOUR_DATABASE_ADMIN` and `asw024` with your
administrator account and database name if different.

1. Stop web requests to Pandemic during the upgrade.
2. Back up the database and confirm the command succeeds. Keep this file outside
   the served web directory:

   ```bash
   mariadb-dump -u YOUR_DATABASE_ADMIN -p --single-transaction asw024 > "$HOME/pandemic-before-table-rename.sql"
   ```

3. Check the current names:

   ```bash
   mariadb -u YOUR_DATABASE_ADMIN -p asw024 -e 'SHOW TABLES;'
   ```

   All nine original names must exist and none of the English target names may
   already exist. If the database already has the English names, skip the migration.
4. Deploy the updated code and rename the tables while web requests remain stopped:

   ```bash
   mariadb -u YOUR_DATABASE_ADMIN -p asw024 < migrations/001_english_table_names.sql
   ```

5. Confirm `SHOW TABLES` lists the English names, resume requests, and check login,
   game lists, and an existing game in the browser.

The migration uses one `RENAME TABLE` statement. A missing source table or a
conflicting target produces an error; do not ignore it or rerun blindly. It does
not recreate tables or delete sample data. Use a database administrator account
with permission to rename tables. Database-wide application grants continue to
apply; any grants specific to the old table names need updating separately.

## Revert

Stop requests, then run the reverse migration and restore the application code
from before the rename before resuming requests:

```bash
mariadb -u YOUR_DATABASE_ADMIN -p asw024 < migrations/001_english_table_names.down.sql
```

This is a separate reverse operation, not a transaction rollback. Both migration
files are intended for the exact set of names shown above. Update any external
scripts that refer to the original names as well.
