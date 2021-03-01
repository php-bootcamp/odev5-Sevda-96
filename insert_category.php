<?php
include("connect_db.php");
include("scripts.php");
?>
<br /><br />
<dive class="container">
    <form method="post">
        <h2 class="text-success" style="text-align:center;">Katagori Ekle</h2><br />
        <div class="container">
            <div class="row-center">
                <div class="form group">
                    <input type="text" name="category" class="form-control form-control-lg" type="text"
                        placeholder="Katagori Ekle"></br>
                    <input type="submit" name="submit" class="btn btn-success btn-lg btn-block" />
                </div>
            </div>
        </div>
    </form>
    </div>
    <?php

if(isset($_POST['submit'])){
    if(!empty($_POST['category'])){
        $category=$_POST['category'];
        $uniqid=md5(uniqid(mt_rand(), true));
        $uniqid=substr($uniqid,0,12);
        
        $insert=$conn->prepare("INSERT INTO category(category_uniqid,category_name) VALUES(:uniqid,:category)");
        $insert->execute([
            'uniqid'=>$uniqid,
            'category'=>$category,
        ]);
        header("Location:insert_category.php");
       
    }
    else{
        echo'<h3 class="text-danger" style="text-align:center;">Boş bırakılmaz!</h3>';
    }
}
?>
    <br /><br />
    <h2 class="text-dark" style="text-align:center;">Kategori Listesi</h2><br />
    <dive class="container">
        <dive class="row justify-content-md-center">
            <div class="col-sm-6">
                <div class="table table table-responsive">
                    <table class="table table-hover table-md " style="border:0px;">
                        <thead class="table-success">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Kategory</th>
                            </tr>
                        </thead>
                        <?php $select=$conn->query("SELECT * FROM category",PDO::FETCH_OBJ); ?>
                        <?php $i=0; while($ctg=$select->fetch()): ?>
                        <tbody>
                            <tr class="table-light">
                                <th scope="row">
                                    <?$i++?>
                                </th>
                                <td><?=$ctg->category_name?></td>
                            </tr>
                        </tbody>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>