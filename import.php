<?php 
include("connect_db.php");
include("scripts.php");
?>
<br /><br />
<div class="container">

    <form method="post" enctype="multipart/form-data">
        <div class="form-group ">
            <label for="exampleFormControlFile1">Example file input</label><br />
            <input type="file" name="jsonFile" class="form-control-file" id="exampleFormControlFile1"><br />
            <input type="submit" name="submit" value="Import" name="buttomImport">
        </div>
    </form>
</div>

<?php 
if(isset($_POST['submit'])){

    copy($_FILES['jsonFile']['tmp_name'], 'jsonFiles/'.$_FILES['jsonFile']['name']);

    $data = file_get_contents('jsonFiles/'.$_FILES['jsonFile']['name']);

    $products = json_decode($data,true);

    foreach ($products as $product) {

        $stmt = $conn->prepare("INSERT INTO products(products_uniqid,products_name,price,description,content,category_uniqid,category_name) VALUES(:products_uniqid, :products_name, :price,:description,:content,:category_uniqid,:category_name)");
        $stmt->bindValue(':products_uniqid',$product['products_uniqid'], PDO::PARAM_STR);
        $stmt->bindValue(':products_name',$product['products_name'], PDO::PARAM_STR);
        $stmt->bindValue(':price',$product['price'], PDO::PARAM_STR);
        $stmt->bindValue(':description',$product['description'], PDO::PARAM_STR);
        $stmt->bindValue(':content',$product['content'], PDO::PARAM_STR);
        $stmt->bindValue(':category_uniqid',$product['category_uniqid'], PDO::PARAM_STR);
        $stmt->bindValue(':category_name',$product['category_name'], PDO::PARAM_STR);

        $stmt->execute();
    }
    header('Location:index.php?status=success');
  
}