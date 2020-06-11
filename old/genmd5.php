<title>GEN MD5</title>



<body>

<p>INFORME NA URL UM VALOR PARA O PARAMETRO 'str'. Ex: __DIR__/genmd5.php?str=teste</p>
<p><?php

if(isset($_GET["str"])){

    echo strtoupper(md5(trim($_GET["str"])));

}
?></p>
</body>