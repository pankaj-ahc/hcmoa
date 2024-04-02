<?php
function pre(...$object)
{
    echo '<pre>';
    if (count($object) == 2 and is_numeric($object[1]) and $object[1] != 0) {
        echo json_encode($object[0], JSON_PRETTY_PRINT);
    } else {
        foreach ($object as $obj) {
            print_r($obj);
            echo "<br/>";
        }
    }
    echo '</pre>';
}

date_default_timezone_set('Asia/Kolkata');
$folderPath = "./data/";
$pattern = "voting_" . date("d.M.Y");

function getMaxDir()
{
    global $folderPath, $pattern;

    if (is_dir($folderPath)) {
        // Use glob to find directories that match the pattern
        $matchingDirectories = glob($folderPath . $pattern . "-*", GLOB_ONLYDIR);

        $dir = [];
        foreach ($matchingDirectories as $item) {
            $num = explode("-", $item)[1];
            $dir[] = $num;
        }
        sort($dir);
        return array_pop($dir);
    } else {
        echo "The folder $folderPath does not exist.";
    }
}

function newSession()
{
    global $folderPath, $pattern;
    $max = getMaxDir();
    $folderName = $folderPath . $pattern . "-" . (++$max);
    if (!is_dir($folderName)) {
        mkdir($folderName, 0777, true);
        session_destroy();
    } else {
        echo "The Session already exists $folderName.";
    }
}

function getSession()
{
    if (isset($_SESSION["dataPath"])) {
        return $_SESSION["dataPath"];
    }
    global $folderPath, $pattern;
    $max = getMaxDir();
    $dataPath = $folderPath . $pattern . "-" . $max;
    $_SESSION["dataPath"] = $dataPath;
    return $dataPath;
}

function saveVote($data)
{
    $session = getSession();
    echo $session . "/" . date("H.i.s") . ".json";
    file_put_contents($session . "/" . date("H.i.s") . ".json", $data);
}

function getJson($file)
{
    $json = file_get_contents($file);
    return json_decode($json);
}

function getPosts()
{
    return getJson("./data/posts.json");
}

function getCandidates()
{
    return getJson("./data/candidates.json");
}

function getKey($post)
{
    return str_ireplace(" ", "_", strtolower($post));
}

function PostUI($post)
{
    $key = getKey($post);
    $html = "<h2 class='my-2 text-center text-decoration-underline hide'>$post</h2>";
    $html .= $key === "executive_members"?"<div id='status' style='position: absolute;text-align: left;left: 30px;background: forestgreen;width: auto;color: yellow;
}'></div>":"";
    $html .="<div class='candidate_container d-flex flex-wrap justify-content-center align-items-center' id='container_{$key}'></div>";
    return $html;
}

function createDigitalSignKey(){

}