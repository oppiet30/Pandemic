-- Revert the table names, then restore the matching old application code.
RENAME TABLE
    `admins` TO `admin`,
    `cards` TO `cartas`,
    `player_cards` TO `cartas_jogador`,
    `cities` TO `cidades`,
    `city_infections` TO `cidades_infectadas`,
    `disease_cures` TO `doencas_erradicadas`,
    `game_states` TO `estado_jogo`,
    `games` TO `jogo`,
    `users` TO `user`;
