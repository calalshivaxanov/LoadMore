<?php

sleep(1);

try
{
    $db = new PDO("mysql:host=localhost;dbname=loadmore;charset=utf8","root","2352ceka20");
}
catch (PDOException $e)
{
    echo $e->getMessage();
}



if (isset($_GET['all']))
{
    $returnArray = [];
    $id = $_POST['id'];
    $sorgu = $db->query("SELECT * FROM movzular WHERE id > $id ORDER BY id ASC limit 2")->fetchAll(PDO::FETCH_ASSOC);

    $count = $db->query("SELECT * FROM movzular WHERE id > $id ORDER BY id ASC limit 2")->rowCount();

    $returnArray['data'] = $sorgu;
    $returnArray['count'] = $count;
    echo json_encode($returnArray);
}

?>