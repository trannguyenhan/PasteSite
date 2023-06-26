<!DOCTYPE html>
<html lang="en">

<!-- Styles, Scripts & Metas -->

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="./_styles/tailwinds.css">
    <link rel="stylesheet" href="./_styles/index.css">
    <link rel="stylesheet" href="./_styles/prism.css">
    <link rel="icon" href="./_styles/favicon.png">
    <title>PasteSite - Create New Paste</title>
    <meta charset="UTF-8">
</head>

<?php

$PASTE_FOUND = false;
require_once("./database.php");

if (isset($_POST["name"])) {
    if (isset($_POST["mark"])) {
        if (isset($_POST["content"])) {
            $ID = toID(6);
            $CREATED = time();
            $MARK = strval(htmlentities($_POST["mark"]));
            $CONTENT = $SQL->real_escape_string($_POST["content"]);
            $NAME = $SQL->real_escape_string(strval(htmlentities($_POST["name"])));
            if (!isset($NAME)) {
                $NAME = "Unnamed Paste";
            }
            $QUERY = $SQL->query("INSERT INTO pastes(created, id, mark, name, content) VALUES('$CREATED', '$ID', '$MARK', '$NAME', '$CONTENT')");
            if ($QUERY == true) {
                echo json_encode([
                    "Success" => true,
                    "Message" => "Successfuly created paste"
                ]);
                header("Location: ./edit.php?id=$ID");
            } else {
            }
        }
    }
}

if (isset($_GET["id"])) {
    $ID = htmlentities($_GET["id"]);
    $get_paste_query_count = $SQL->query("SELECT COUNT(*) AS 'COUNT' FROM pastes WHERE id = '$ID'");
    while ($count = $get_paste_query_count->fetch_assoc()) {
        if ($count["COUNT"] > 0) {
            $get_paste_query = $SQL->query("SELECT * FROM pastes WHERE id = '$ID'");
            while ($row = $get_paste_query->fetch_assoc()) {
                $CONTENT =  htmlentities($row["content"]);
                $MARK = htmlspecialchars($row["mark"]);
                $NAME = htmlspecialchars($row["name"]);
            }
            global $MARK;
            global $CONTENT;
            global $NAME;
            $PASTE_FOUND = true;
        } else {
            header("Location: ./index.php");
        }
        global $PASTE_FOUND;
    }
}
if ($PASTE_FOUND == false) {
    header("Location: ./index.php");
}

?>

<body class="slidein bg-dark">
<div class="flex flex-row">
    <div class="w-full flex flex-wrap justify-center">
        <div class="w-11/12 flex flex-wrap justify-center">
            <!-- Basic Form, POST Method To Upload large Data -->
            <form method="POST" action="" class="py-2 w-full mb-10 mt-10" enctype="multipart/form-data">
                <div class="md:grid-cols-2 grid">
                    <div>
                        <h1 class="w-full md:w-auto text-gray-200 text-xl text-opacity-80">CREATE NEW PASTE</h1>
                    </div>
                    <div class="space-x-3">
                        <!-- Highlighting Languages Add More If Needed https://prismjs.com/download.html -->
                        <select required name="mark" class="ml-3 w-full md:w-auto mt-5 float-right md:mt-0 px-8 text-gray-200 py-3 border-r-4 border-dark-400 focus:outline-none rounded-md bg-dark-400">
                            <option value="none" <?php if($MARK == 'none') echo 'selected'; ?>>None</option>
                            <option value="c" <?php if($MARK == 'c') echo 'selected'; ?>>C</option>
                            <option value="go" <?php if($MARK == 'go') echo 'selected'; ?>>Go</option>
                            <option value="csharp" <?php if($MARK == 'csharp') echo 'selected'; ?>>C#</option>
                            <option value="cpp" <?php if($MARK == 'cpp') echo 'selected'; ?>>C++</option>
                            <option value="css" <?php if($MARK == 'css') echo 'selected'; ?>>CSS</option>
                            <option value="ejs" <?php if($MARK == 'ejs') echo 'selected'; ?>>Ejs</option>
                            <option value="sql" <?php if($MARK == 'sql') echo 'selected'; ?>>SQL</option>
                            <option value="xml" <?php if($MARK == 'xml') echo 'selected'; ?>>XML</option>
                            <option value="lua" <?php if($MARK == 'lua') echo 'selected'; ?>>Lua</option>
                            <option value="txt" <?php if($MARK == 'txt') echo 'selected'; ?>>Txt</option>
                            <option value="git" <?php if($MARK == 'git') echo 'selected'; ?>>Git</option>
                            <option value="php" <?php if($MARK == 'php') echo 'selected'; ?>>Php</option>
                            <option value="pug" <?php if($MARK == 'pug') echo 'selected'; ?>>Pug</option>
                            <option value="dot" <?php if($MARK == 'dot') echo 'selected'; ?>>Dot</option>
                            <option value="sass" <?php if($MARK == 'sass') echo 'selected'; ?>>Sass</option>
                            <option value="html" <?php if($MARK == 'html') echo 'selected'; ?>>HTML</option>
                            <option value="dart" <?php if($MARK == 'dart') echo 'selected'; ?>>Dart</option>
                            <option value="twig" <?php if($MARK == 'twig') echo 'selected'; ?>>Twig</option>
                            <option value="nginx" <?php if($MARK == 'nginx') echo 'selected'; ?>>Nginx</option>
                            <option value="perl" <?php if($MARK == 'perl') echo 'selected'; ?>>Perl</option>
                            <option value="ruby" <?php if($MARK == 'ruby') echo 'selected'; ?>>Ruby</option>
                            <option value="toml" <?php if($MARK == 'toml') echo 'selected'; ?>>Toml</option>
                            <option value="rust" <?php if($MARK == 'rust') echo 'selected'; ?>>Rust</option>
                            <option value="yaml" <?php if($MARK == 'yaml') echo 'selected'; ?>>Yaml</option>
                            <option value="java" <?php if($MARK == 'java') echo 'selected'; ?>>Java</option>
                            <option value="haxe" <?php if($MARK == 'haxe') echo 'selected'; ?>>Haxe</option>
                            <option value="batch" <?php if($MARK == 'batch') echo 'selected'; ?>>Batch</option>
                            <option value="python" <?php if($MARK == 'python') echo 'selected'; ?>>Python</option>
                            <option value="kotlin" <?php if($MARK == 'kotlin') echo 'selected'; ?>>Kotlin</option>
                            <option value="matlab" <?php if($MARK == 'matlab') echo 'selected'; ?>>Matlab</option>
                            <option value="docket" <?php if($MARK == 'docket') echo 'selected'; ?>>Docker</option>
                            <option value="prolog" <?php if($MARK == 'prolog') echo 'selected'; ?>>Prolog</option>
                            <option value="fortran" <?php if($MARK == 'fortran') echo 'selected'; ?>>Fortran</option>
                            <option value="groovy" <?php if($MARK == 'groovy') echo 'selected'; ?>>Groovy</option>
                            <option value="haskell" <?php if($MARK == 'haskell') echo 'selected'; ?>>Haskell</option>
                            <option value="lua" <?php if($MARK == 'lua') echo 'selected'; ?>>URI + URL</option>
                            <option value="clojure" <?php if($MARK == 'clojure') echo 'selected'; ?>>Clojure</option>
                            <option value="markdown" <?php if($MARK == 'markdown') echo 'selected'; ?>>Markdown</option>
                            <option value="typescript" <?php if($MARK == 'typescript') echo 'selected'; ?>>Typecript</option>
                            <option value="chaiscript" <?php if($MARK == 'chaiscript') echo 'selected'; ?>>ChaiScript</option>
                            <option value="js" <?php if($MARK == 'js') echo 'selected'; ?>>Javascript</option>
                            <option value="objectivec" <?php if($MARK == 'objectivec') echo 'selected'; ?>>Objective-C</option>
                            <option value="as" <?php if($MARK == 'as') echo 'selected'; ?>>Actionscript</option>
                            <option value="vb" <?php if($MARK == 'vb') echo 'selected'; ?>>Visual Basics</option>
                            <option value="dns-zone-file" <?php if($MARK == 'dns-zone-file') echo 'selected'; ?>>DNS Zone File</option>
                        </select>
                        <button name="submit" type="submit" formmethod="POST" class="float-right w-full md:w-auto mt-5 md:mt-0 border-2 bg-violet hover:bg-dark-400 duration-500 transition border-violet px-8  text-gray-200 py-2  rounded-md">SAVE</button>
                        <a href="<?php echo "paste.php?id=$ID" ?>"><button name="view" type="button" class="float-right w-full md:w-auto mt-5 md:mt-0 border-2 bg-violet hover:bg-dark-400 duration-500 transition border-violet px-8  text-gray-200 py-2  rounded-md">VIEW</button></a>
                    </div>
                </div>
                <!-- Paste Name -->
                <input required autocomplete="off" value="<?php echo $NAME ?>" name="name" type="text" class="normal-font transition duration-500 focus:border-violet border-transparent border-2 bg-dark-400 w-full rounded-md px-4 py-3 mt-5 focus:outline-none text-gray-200" placeholder="ENTER PASTE TITLE">
                <!-- Paste Content -->
                <textarea required id="content" name="content" placeholder="ENTER PASTE CONTENT" class="flex lined transition duration-500 focus:border-violet border-transparent border-2 content mt-5 normal-font rounded-md resize-none w-full h-auto focus:outline-none bg-dark-400 py-4 px-4 text-gray-300 h-screen"><?php if (isset($CONTENT)) { echo $CONTENT; } ?></textarea>
            </form>
        </div>
    </div>
</div>
</body>

</html>