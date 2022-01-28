<?php
defined('C5_EXECUTE') or die('Access Denied.');

$previewURL = $previewURL ?? '';
?>
    <div style="height: 100%">
        <iframe height="100%" width="100%" src="<?= h($previewURL) ?>"></iframe>
    </div>
<?php if (isset($message)) { ?>
    <script>
        ConcreteAlert.notify(<?= json_encode($message) ?>);
    </script>
<?php }
