<?php
include("scripts.php");include("connect_db.php");?>
<!doctype html>

<br />
<h1 class="text-dark" style="text-align:center;">Ürünler Listesi</h1><br />
<div class="table table-responsive ">
    <table class="table table-hover table-md " style="border:0px;text-align:center;">
        <thead class="table-info">
            <tr>
                <th scope="col"></th>
                <th scope="col">Ürünler</th>
                <th scope="col">Fiyati</th>
                <th scope="col">Tanım</th>
                <th scope="col">İçerik</th>
                <th scope="col">Kategory</th>
                <th scope="col">Sil</th>
                <th scope="col">Düzenle</th>
            </tr>
        </thead>
        <tbody>
            <?php $select=$conn->query("SELECT *FROM products",PDO::FETCH_OBJ); ?>
            <?php  
            $count = $select->rowCount();
            if($count==0){
            echo"<h2>Henüz bir ürün eklemediniz</h2>";}
            ?>

            <?php $i=0; while($prd=$select->fetch()): ?>
            <tr class="table-light">
                <th scope="row"><?=++$i;?></th>
                <td><?=$prd->products_name?></td>
                <td><?=$prd->price?></td>
                <td><?=$prd->description?></td>
                <td><?=$prd->content?></td>
                <td><?=$prd->category_name?></td>
                <td><a href="delete.php?id=<?=$prd->products_uniqid?>" class="btn btn-warning  btn-sm">Sil</a></td>
                <td><a href="update.php?id=<?=$prd->products_uniqid?>" class="btn btn-success  btn-sm">Düzenle</a></td>
            </tr>
            <?php endwhile; ?>

        </tbody>
    </table>
</div>
<br /><br />
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="import.php" type="button" class="btn btn-success  col-md-4">İçe Aktar</a>
            <a href="insert_products.php" type="button" class="btn btn-info col-md-3">Yeni Ürün Ekle</a>
            <a href="insert_category.php" type="button" class="btn btn-danger col-md-4">Yeni Katagori Ekle</a>
        </div>

    </div>

</div>

<br />
<div class="container ">
    <div class="row ">
        <div class="col-sm-12 d-flex justify-content-center ">
            <a href="export.php" class="col-sm-6 btn btn-dark btn-lg">Dışa Aktar</a>
        </div>
    </div>
</div>
<br />
<div class="container">
    <div class="row">
        <?php $select=$conn->query("SELECT * FROM products",PDO::FETCH_OBJ); ?>
        <?php $i=0; while($ctg=$select->fetch()): ?>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-danger"><?=$ctg->category_name?></h4>
                    <h5 class="card-title"><?=$ctg->products_name?></h5>
                    <p class="card-text"><?=$ctg->description?></p>
                    <p class="card-text"><?=$ctg->content?></p>
                    <p class="card-text"><?=$ctg->price?></p>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>