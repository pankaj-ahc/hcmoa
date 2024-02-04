<?php
include "./include/header.php";

pre($_POST);

saveVote(json_encode($_POST));
include "./include/footer.php";

header("Location: ./voteSavedMsg.php");
