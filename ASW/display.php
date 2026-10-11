<?php
require_once __DIR__ . '/i18n.php';

/** Translate presentation labels without changing stored values. */
function pandemic_label($value) {
    $labels = pandemic_catalog()['labels'];
    return isset($labels[$value]) ? $labels[$value] : $value;
}

function pandemic_display($value) {
    return htmlspecialchars(pandemic_label((string) $value), ENT_QUOTES, 'UTF-8');
}

function pandemic_display_list($value) {
    return implode(', ', array_map('pandemic_display', explode(', ', (string) $value)));
}

/** Translate generated card markup only at the display boundary, never before game logic uses it. */
function pandemic_display_cards($html) {
    return preg_replace_callback('/>([^<>]*)</', function ($match) {
        return '>' . pandemic_display($match[1]) . '<';
    }, $html);
}
