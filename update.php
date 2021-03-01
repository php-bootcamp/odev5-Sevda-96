<?php 
include("scripts.php");
include("connect_db.php");
?>
<br /><br />
<dive class="container">
    <form method="post">
        <h2 class="text-success " style="text-align:center;">Ürün Düzenle</h2><br />
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
                    <?php $id=$_GET['id'];$select2=$conn->query("SELECT *FROM products WHERE products_uniqid='$id'",PDO::FETCH_OBJ);$select2->execute(['id'=>$_GET['id']]);?>
                    <?php while($prd=$select2->fetch()):?>
                    <input type="text" name="product" class="form-control form-control-lg"
                        value="<?=$prd->products_name?>" type="text" placeholder="Ürün İsmi" /></br>
                    <input type="text" name="price" class="form-control form-control-lg" type="text"
                        value="<?=$prd->price?>" placeholder="Fiyat Ekle" /></br>
                    <input type="text" name="description" class="form-control form-control-lg" type="text"
                        value="<?=$prd->description?>" placeholder="Tanım Ekle" /></br>
                    <input type="text" name="content" class="form-control form-control-lg" type="text"
                        value="<?=$prd->content?>" placeholder="İçerik Ekle" /></br>
                    <?php endwhile; ?>
                    <input type="submit" name="submit" class="btn btn-success btn-lg btn-block" />

                </div>
            </div>
        </div>
    </form>
    </div>
    <?php 

if(isset($_POST['submit'])){
    if(!empty($_POST['category_uniqid']) && !empty($_POST['product']) && !empty($_POST['price']) && !empty($_POST['description'])
    && !empty($_POST['content'])){
        $id=$_GET['id'];
        $category=$_POST['category_uniqid'];
        $product=$_POST['product'];
        $price=$_POST['price'];
        $description=$_POST['description'];
        $content=$_POST['content'];

        
        $arr=array(explode('|', $category, 2));
        $category=$arr[0][0];
        $category_name=$arr[0][1];

        $update=$conn->prepare("UPDATE products SET products_name=:product,price=:price,description=:description,content=:content,category_uniqid=:category,category_name=:category_name WHERE products_uniqid=:id ");
        $update->execute([
            'product'=>$product,
            'price'=>$price,
            'description'=>$description,
            'content'=>$content,
            'category'=>$category,
            'category_name'=>$category_name,
            'id'=>$id,
        ]);
        header("Location:index.php");
    }
    else{
        echo'<h3 class="text-danger" style="text-align:center;">Boş bırakılmaz!</h3>';
    }
}