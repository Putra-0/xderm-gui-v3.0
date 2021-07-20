<?php

?>

<script>
$.get("http://ip-api.com/json", function (response) {
    $("#ip").html(response.query);
    $("#isp").html(response.isp + " (" + response.countryCode + ")");
}, "jsonp");
</script>

