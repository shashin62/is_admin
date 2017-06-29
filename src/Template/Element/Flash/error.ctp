<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<script>
    new PNotify({
        title: 'Notification',
        text: '<?= $message ?>',
        addclass: "bg-danger"
    });
</script>
