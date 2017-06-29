<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<script>
    new PNotify({
        title: 'Notification',
        text: '<?= $message ?>',
        type: '<?= $class ?>'
    });
</script>
