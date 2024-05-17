<script>
  const baseURL = "<?= base_url()?>"
</script>

<?php


if (!function_exists('esc')) {
  function esc($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
  }
}
if(isset($js)){
  foreach ($js as $groupScript) {
    if(is_array($groupScript)) {
      foreach ($groupScript as $script) {
        printf('<script src="%s"></script>', base_url(($script)));
      }
    } else {
      printf('<script src="%s"></script>', base_url(($groupScript)));
    }
  }
  
}

if(isset($custom_js)){
  foreach ($custom_js as $groupScript) {
    if(is_array($groupScript)) {
      foreach ($groupScript as $script) {
        printf('<script src="%s"></script>', base_url(esc($script)."?".filemtime($script)));
      }
    } else {
      printf('<script src="%s"></script>', base_url(esc($groupScript)."?".filemtime($groupScript)));
    }
  }
  
}
?>