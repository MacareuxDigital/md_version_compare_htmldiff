<?php
defined('C5_EXECUTE') or die('Access Denied.');

$previewURL = $previewURL ?? '';
?>
<div style="height: 100%">
    <iframe style="height: 100%; width: 100%; border: none;" src="<?= h($previewURL) ?>"></iframe>
</div>
