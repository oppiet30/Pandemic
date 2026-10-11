<?php
/** Render representative pages without a database or outgoing email. */
set_error_handler(function ($severity, $message, $file, $line) {
    if (error_reporting() & $severity) throw new ErrorException($message, 0, $severity, $file, $line);
});
$_GET = array('jogo' => '1001');
$_COOKIE = array('user' => 'alice');
require __DIR__ . '/../ASW/display.php';
$assertions = 0;
$scripts = array();
function translation_expect($condition, $message) {
    global $assertions;
    if (!$condition) throw new RuntimeException($message);
    $assertions++;
}
function render_fixture($file, $variables = array()) {
    extract($variables, EXTR_SKIP);
    ob_start();
    try {
        include __DIR__ . '/../ASW/' . $file;
        return ob_get_contents();
    } finally {
        ob_end_clean();
    }
}
function record_scripts($name, $html) {
    global $scripts;
    preg_match_all('/<script\b[^>]*>(.*?)<\/script>/s', $html, $matches);
    foreach ($matches[1] as $index => $script) {
        if (trim($script) !== '') $scripts[$name . ':' . $index] = $script;
    }
}
// These stubs isolate view presentation from database game logic, which has its own suite.
function checkPlayer($id, $player, $conn) { return $player === 'alice' || $player === 'bob'; }
function verificaCidadeInfectada($city, $game, $conn) { return true; }
function contaInfecoes($city, $game, $conn) { return 1; }
function verificaSeDoencaEstaErradicada($game, $color, $conn) { return $color === 'Azul'; }
function obtemTurnoDoJogador($game, $turn, $conn) { return 'alice'; }
function verificaNumeroJogadasFeitas($game, $conn) { return 0; }
function verificaSePodeCurarDoenca($game, $player, $conn) { return true; }
function obtemCartasJogador($game, $player, $conn) {
    return array(array('id_carta' => 2, 'carta' => 'Lisboa', 'cor' => 'Azul'));
}

translation_expect(pandemic_resolve_locale('pt', 'en') === 'pt', 'Explicit language takes priority');
translation_expect(pandemic_resolve_locale(null, 'pt') === 'pt', 'Saved language is used');
translation_expect(pandemic_resolve_locale('../../db_config', 'pt') === 'pt', 'Invalid path-like language cannot select a file');
translation_expect(pandemic_resolve_locale(array('pt'), array('en')) === 'en', 'Malformed language values fall back safely');
translation_expect(pandemic_resolve_locale('fr', 'invalid') === 'en', 'English is the default');
$en = pandemic_catalog('en');
$pt = pandemic_catalog('pt');
translation_expect(array_keys($en['messages']) === array_keys($pt['messages']), 'Catalogs have matching keys');
translation_expect(pandemic_escape('<b>"&') === '&lt;b&gt;&quot;&amp;', 'Labels and attributes are escaped');

$registration = array();
foreach (array('en', 'pt') as $locale) {
    $GLOBALS['pandemic_locale'] = $locale;
    $isPortuguese = $locale === 'pt';
    translation_expect(pandemic_t('Log in') === ($isPortuguese ? 'Entrar' : 'Log in'), 'Login label changes language');
    translation_expect(pandemic_t('Unlisted fixture text') === 'Unlisted fixture text', 'Missing translations have a readable fallback');
    translation_expect(pandemic_label('Lisboa') === ($isPortuguese ? 'Lisboa' : 'Lisbon'), 'City display changes without changing raw city');
    translation_expect(pandemic_label('Azul') === ($isPortuguese ? 'Azul' : 'Blue'), 'Color display is localized');
    translation_expect(pandemic_label('Iniciado') === ($isPortuguese ? 'Iniciado' : 'In progress'), 'Status display is localized');
    $cards = pandemic_display_cards('<span class="cartas Azul">Lisboa</span>');
    translation_expect($cards === '<span class="cartas Azul">' . ($isPortuguese ? 'Lisboa' : 'Lisbon') . '</span>', 'Card classes remain raw game colors');
    $json = pandemic_js_markup('<div>Login failed. Check your username and password.</div>');
    translation_expect(json_decode($json, true, 512, JSON_THROW_ON_ERROR) === '<div>' . pandemic_text('Login failed. Check your username and password.') . '</div>', 'JS messages retain valid JSON quoting');
    translation_expect(strpos($json, '<') === false, 'JS strings cannot close a script tag');

    $_GET = array('jogo' => '1001', 'search' => '"<&', 'lang' => $locale, 'ignored' => array('x'));
    $selector = render_fixture('language_selector.php');
    translation_expect(strpos($selector, 'name="jogo" value="1001"') !== false, 'Switching language retains game ID');
    translation_expect(strpos($selector, 'value="&quot;&lt;&amp;"') !== false, 'Preserved query values are escaped');
    translation_expect(strpos($selector, 'value="' . $locale . '" selected') !== false, 'Current language is selected');
    translation_expect(strpos($selector, 'name="ignored"') === false, 'Array query parameters are omitted');
    translation_expect(substr_count($selector, 'name="lang"') === 1, 'Only one language value is submitted');
    $_GET = array('jogo' => '1001');

    foreach (array('register.php', 'recover.php', 'password_rec.php', 'login.php', 'user_dash.php') as $file) {
        $html = render_fixture($file);
        record_scripts($locale . ':' . $file, $html);
        if ($file !== 'login.php') {
            translation_expect(strpos($html, '<html lang="' . $locale . '">') !== false, 'Document language matches selection: ' . $file);
            translation_expect(substr_count($html, 'id="pandemic-language"') === 1, 'One language selector per page: ' . $file);
        }
        if ($file === 'register.php') {
            translation_expect(strpos($html, 'placeholder="' . pandemic_text('First name') . '"') !== false, 'Registration placeholders are localized');
            translation_expect(strpos($html, 'value="Alemanha">' . ($isPortuguese ? 'Alemanha' : 'Germany') . '</option>') !== false, 'Country labels translate without changing stored values');
            preg_match_all('/<(?:input|option)\b[^>]*\bvalue="([^"]*)"/', $html, $values);
            $registration[$locale] = $values[1];
        }
    }
    // The create page connects to the database before rendering. Compile its inline
    // scripts separately here; only trusted template PHP expressions are evaluated.
    preg_match_all('/<script\b[^>]*>(.*?)<\/script>/s', file_get_contents(__DIR__ . '/../ASW/criar_jogo.php'), $createScripts);
    foreach ($createScripts[1] as $index => $source) {
        ob_start();
        try {
            eval('?>' . $source);
            record_scripts($locale . ':create:' . $index, '<script>' . ob_get_contents() . '</script>');
        } finally {
            ob_end_clean();
        }
    }

    $variables = array(
        'conn' => null,
        'nickname_jogador' => 'alice',
        'linha' => array('nome' => 'Your turn', 'descricao' => 'Log in', 'criador' => 'alice', 'jogador2' => 'bob', 'jogador3' => '', 'jogador4' => '', 'data_comeco' => '2026-10-11'),
        'verifica_jogo' => array('estado' => 'Iniciado', 'jogador1' => 'alice', 'jogador2' => 'bob', 'jogador3' => '', 'jogador4' => '', 'turno_jogador' => 1, 'n_turnos' => 2, 'surtos' => 0),
        'cidades' => array(array('id' => 1, 'nome' => 'Lisboa', 'conexoes' => 'Londres, Roma', 'cor' => 'Azul')),
        'centros_pesquisa' => array(),
        'estado_infecao' => array('velocidade' => 2, 'surtos' => 0),
        'cartas_jogador1' => '<span class="cartas Azul">Lisboa</span>',
        'cartas_jogador2' => '', 'cartas_jogador3' => '', 'cartas_jogador4' => '',
        'cidade_actual_jogador1' => array('nome' => 'Lisboa', 'cor' => 'Azul'),
        'cidade_actual_jogador2' => array('nome' => 'Roma', 'cor' => 'Azul'),
        'cidade_actual_jogador3' => array('nome' => '', 'cor' => ''),
        'cidade_actual_jogador4' => array('nome' => '', 'cor' => ''),
        'cidade_jogador' => array('id' => 1, 'nome' => 'Lisboa', 'cor' => 'Azul'),
        'cartas_disponiveis' => array('Lisboa'),
        'cartas_na_mao_jogador' => array('Azul' => array(2)),
        'pode_criar_cura' => true,
    );
    $lobby = render_fixture('view_jogo_novo.php', $variables);
    translation_expect(strpos($lobby, pandemic_text('Open slot')) !== false, 'Empty lobby slots are localized');
    $active = render_fixture('view_jogo_iniciado.php', $variables);
    record_scripts($locale . ':active', $active);
    translation_expect(strpos($active, 'id="move">' . pandemic_text('Move to another city')) !== false, 'Active-player controls are localized');
    translation_expect(strpos($active, 'botoes_cartas Azul" value="2"') !== false, 'Cure card ID and CSS color remain unchanged');
    translation_expect(strpos($active, "carta: 'Lisboa'") !== false, 'Research station requests use the raw city');
    translation_expect(strpos($active, '<td> Your turn </td>') !== false && strpos($active, '<td>Log in</td>') !== false, 'Game title and description are not translated as UI messages');
    $_COOKIE['user'] = 'bob';
    $variables['nickname_jogador'] = 'bob';
    $waiting = render_fixture('view_jogo_iniciado.php', $variables);
    record_scripts($locale . ':waiting', $waiting);
    translation_expect(strpos($waiting, pandemic_text('Waiting for your turn...')) !== false, 'Waiting-player message is localized');
    translation_expect(strpos($waiting, 'id="move"') === false, 'Waiting players do not receive active controls');
    $_COOKIE['user'] = 'alice';
    foreach (array('Vitoria' => 'Victory!', 'Derrota' => 'Game over!', 'Desistiram' => 'The players gave up.') as $status => $heading) {
        $variables['verifica_jogo']['estado'] = $status;
        $finished = render_fixture('view_jogo_terminado.php', $variables);
        translation_expect(strpos($finished, pandemic_text($heading)) !== false, 'Finished-game output is localized: ' . $status);
    }
}
translation_expect($registration['en'] === $registration['pt'], 'All registration input and option values are identical across languages');
if (isset($argv[1]) && $argv[1] === '--scripts-json') {
    echo json_encode(array('assertions' => $assertions, 'scripts' => $scripts), JSON_THROW_ON_ERROR);
} else {
    echo "$assertions translation and rendered-page assertions passed.\n";
}
