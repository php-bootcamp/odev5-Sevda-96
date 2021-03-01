<?php
include("connect_db.php");
include("scripts.php");

?>
<br /><br />
<dive class="container">
    <form method="post">
        <h2 class="text-info " style="text-align:center;">Ürün Ekle</h2><br />
        <div class="container">
            <div class="row-center">
                <div class="form group">
                    <?php $select=$conn->query("SELECT * FROM category",PDO::FETCH_OBJ); ?>
                    <select class="form-control form-control-lg" name="category_uniqid">
                        <?php while($ctg=$select->fetch()): ?>
                        <option value="<?=$ctg->category_uniqid.'|'.$ctg->category_name ?>"><?=$ctg->category_name?>
                        </option>
                        <?php endwhile; ?>
                    </select><br />
                    <input type="text" name="product" class="form-control form-control-lg" type="text"
                        placeholder="Ürün Ekle"></br>
                    <input type="text" name="price" class="form-control form-control-lg" type="text"
                        placeholder="Fiyat Ekle"></br>
                    <input type="text" name="description" class="form-control form-control-lg" type="text"
                        placeholder="Tanım Ekle"></br>
                    <input type="text" name="content" class="form-control form-control-lg" type="text"
                        placeholder="İçerik Ekle"></br>
                    <input type="submit" name="submit" class="btn btn-info btn-lg btn-block" />
                </div>
            </div>
        </div>
    </form>
    </div>

    <?php

if(isset($_POST['submit'])){
    if(!empty($_POST['category_uniqid']) && !empty($_POST['product']) && !empty($_POST['price']) && !empty($_POST['description'])
    && !empty($_POST['content'])){
        $category=$_POST['category_uniqid'];
        $product=$_POST['product'];
        $price=$_POST['price'];
        $description=$_POST['description'];
        $content=$_POST['content'];

       
        $arr=array(explode('|', $category, 2));
        $category=$arr[0][0];
        $category_name=$arr[0][1];

        $uniqid=md5(uniqid(mt_rand(), true));
        $uniqid=substr($uniqid,0,12);
        
        $insert=$conn->prepare("INSERT INTO products(products_uniqid,products_name,price,description,content,category_uniqid,category_name) VALUES(:uniqid,:product,:price,:description,:content,:category,:category_name)");
        $insert->execute([
            'uniqid'=>$uniqid,
            'product'=>$product,
            'price'=>$price,
            'description'=>$description,
            'content'=>$content,
            'category'=>$category,
            'category_name'=>$category_name,
        ]);
        header("Location:insert_products.php");
    }
    else{
        echo'<h3 class="text-danger" style="text-align:center;">Boş bırakılmaz!</h3>';
    }
}
?>