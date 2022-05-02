<html>
<head>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>

    <style>
        .item
        {
            padding: 10px;
            border: 1px;
            solid #ddd;
            margin-bottom: 10px;
        }
        button
        {
            background: #209665;
            padding: 10px;
            color: white;
            font-weight: 700;
        }

        .loading
        {
            padding: 6px;
            background: #fd7070;
            color: white;
            display: none;
        }

    </style>
</head>
<body>

<?php

try
{
$db = new PDO("mysql:host=localhost;dbname=loadmore;charset=utf8","root","2352ceka20");
}
catch (PDOException $e)
{
    echo $e->getMessage();
}
/*
switch ($_GET['mode'])
{
    case 'list';
        $id = $_POST['id'];
        echo $id;
        break;
}
*/
$all = $db->query("SELECT * FROM movzular ORDER BY id ASC limit 2")->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="content">
    <?php
    foreach ($all as $key => $value)
    {
        echo '<div data-id="'.$value['id'].'" class="item">'.$value['isim'].' => '.$value['yazi'].'</div>';
    }
    ?>



</div>

<p class="loading">Yüklənir...</p>

<button id="loadMore" type="button">Davamını Göstər</button>

<script>
    $(document).ready(function ()
    {
        $("#loadMore").click(function ()
        {
           var ID = $(".item:last").data("id"); //item classının ən son halının id`sini al

            $(".loading").show();

            $.ajax
            ({
                url:"ajax.php?all",
                type:"POST",
                dataType:"json",
                data:{id:ID},
                success:function (result)
                {

                    if(result.count != 0)
                    {
                    var html = "";
                    $.each(result.data,function (i,e)
                    {
                        html += '<div class="item" data-id="'+e.id+'">'+e.isim+' => '+e.yazi+'</div>';
                    });
                    $(".content").append(html);
                    }
                    else
                    {
                        $("#loadMore").remove();
                        $(".loading").hide();
                    }
                }
            });

        });
    });
</script>

</body>
</html>


