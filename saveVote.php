<?php
include "./include/header.php";

saveVote(json_encode($_POST));

?>
<div class="text-center d-flex container justify-content-center align-items-center" style="font-size: xx-large;color: green;text-transform: uppercase;height: calc(100vh - 60px);">
    Your Vote saved successfully.
</div>

<script>
    setTimeout(function () {
        window.location.href = "./"
    }, 10 * 1000)
</script>
<?php
include "./include/footer.php";
?>