<?php require_once __DIR__ . '/i18n.php'; ?>
<form method="get" class="pandemic-language" aria-label="<?php echo pandemic_text('Language'); ?>">
    <?php foreach ($_GET as $key => $value) {
        if ($key !== 'lang' && is_string($value)) { ?>
            <input type="hidden" name="<?php echo pandemic_escape($key); ?>" value="<?php echo pandemic_escape($value); ?>">
        <?php }
    } ?>
    <label for="pandemic-language"><?php echo pandemic_text('Language'); ?></label>
    <select name="lang" id="pandemic-language">
        <?php foreach (pandemic_supported_locales() as $code => $label) { ?>
            <option value="<?php echo $code; ?>"<?php echo pandemic_locale() === $code ? ' selected' : ''; ?>><?php echo pandemic_escape($label); ?></option>
        <?php } ?>
    </select>
    <button type="submit"><?php echo pandemic_text('Apply'); ?></button>
</form>
<style>
    .pandemic-language { display:flex; flex-wrap:wrap; gap:0.6em; align-items:center; justify-content:flex-end; padding:0.75em 1em; }
    .pandemic-language label { margin:0; }
    .pandemic-language select, .pandemic-language button { width:auto; margin:0; padding:0.35em 0.65em; }
</style>
