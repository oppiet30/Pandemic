<?php
/** Small presentation-only translation layer; never translate database/API values. */
function pandemic_supported_locales() {
    return array('en' => 'English', 'pt' => 'Português');
}

function pandemic_resolve_locale($requested, $saved) {
    $supported = pandemic_supported_locales();
    foreach (array($requested, $saved) as $locale) {
        if (is_string($locale) && isset($supported[$locale])) {
            return $locale;
        }
    }
    return 'en';
}

$pandemic_requested_locale = isset($_GET['lang']) ? $_GET['lang'] : null;
$pandemic_saved_locale = isset($_COOKIE['pandemic_lang']) ? $_COOKIE['pandemic_lang'] : null;
$GLOBALS['pandemic_locale'] = pandemic_resolve_locale($pandemic_requested_locale, $pandemic_saved_locale);
if (is_string($pandemic_requested_locale)
    && isset(pandemic_supported_locales()[$pandemic_requested_locale])
    && !headers_sent() && PHP_SAPI !== 'cli') {
    setcookie('pandemic_lang', $GLOBALS['pandemic_locale'], array(
        'expires' => time() + 365 * 24 * 60 * 60,
        'path' => '/',
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ));
}
unset($pandemic_requested_locale, $pandemic_saved_locale);

function pandemic_locale() {
    // Revalidate even when a CLI test changes the active locale.
    return pandemic_resolve_locale($GLOBALS['pandemic_locale'], null);
}

function pandemic_catalog($locale = null) {
    static $catalogs = array();
    $locale = pandemic_resolve_locale($locale, pandemic_locale());
    if (!isset($catalogs[$locale])) {
        $catalogs[$locale] = require __DIR__ . '/lang/' . $locale . '.php';
    }
    return $catalogs[$locale];
}

/** English source strings are catalog keys. Missing entries fall back to English. */
function pandemic_t($source) {
    $catalog = pandemic_catalog();
    return isset($catalog['messages'][$source]) ? $catalog['messages'][$source] : $source;
}

function pandemic_escape($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function pandemic_text($source) {
    return pandemic_escape(pandemic_t($source));
}

/** Only pass trusted, application-authored markup (never user text) to this helper. */
function pandemic_markup($html) {
    return preg_replace_callback('/>([^<>]*)</u', function ($match) {
        $text = trim($match[1]);
        if ($text === '') {
            return $match[0];
        }
        $source = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
        $translated = pandemic_t($source);
        if ($translated === $source) {
            return $match[0];
        }
        return '>' . str_replace($text, pandemic_escape($translated), $match[1]) . '<';
    }, $html);
}

function pandemic_js_markup($html) {
    return json_encode(pandemic_markup($html), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
}
