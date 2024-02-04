<?php
include_once "./include/functions.php";

//pre($_POST);
if(!empty($_POST)){
    $data = $_POST;
    $json = [];
    $posts = getPosts();
    foreach ($posts as $i => $post) {
        echo getKey($post);
        $json[$post] = $data[getKey($post)];
    }
    pre($json);

    if(file_exists("./data/candidates.json")){
        rename("./data/candidates.json","./data/candidates-".date("d.M.Y_H.i.s").".json");
    }
    file_put_contents("./data/candidates.json",json_encode($json,JSON_PRETTY_PRINT));
}
