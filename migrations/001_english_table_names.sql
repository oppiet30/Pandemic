-- Run once against an existing database with the original table names.
-- Stop application requests and back up the database before running this file.
RENAME TABLE
    `admin` TO `admins`,
    `cartas` TO `cards`,
    `cartas_jogador` TO `player_cards`,
    `cidades` TO `cities`,
    `cidades_infectadas` TO `city_infections`,
    `doencas_erradicadas` TO `disease_cures`,
    `estado_jogo` TO `game_states`,
    `jogo` TO `games`,
    `user` TO `users`;
