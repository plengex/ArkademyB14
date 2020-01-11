<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "arkademy");

// menampilkan data product
$result = mysqli_query($conn, "SELECT * FROM product JOIN category ON category_id=id_category JOIN cashier ON cashier_id=id_cashier ORDER BY id ASC");
$products = [];
while($product = mysqli_fetch_assoc($result)){
  $products[] = $product;
}

// menampilkan data cashier dan category
$cashier = mysqli_query($conn, "SELECT * FROM cashier");
$cashiers = [];
while($cshr = mysqli_fetch_assoc($cashier)){
  $cashiers[] = $cshr;
}

$category = mysqli_query($conn, "SELECT * FROM category");
$categories = [];
while($ctgr = mysqli_fetch_assoc($category)){
  $categories[] = $ctgr;
}

// tambah data
if ( isset($_POST["submit"]) ){
  $product_name   = htmlspecialchars($_POST["product_name"]);
  $price          = htmlspecialchars($_POST["price"]);
  $category_id    = htmlspecialchars($_POST["category_id"]);
  $cashier_id     = htmlspecialchars($_POST["cashier_id"]);

  $query_insert = "INSERT INTO product VALUES (NULL, '$product_name', '$price', '$category_id', '$cashier_id')";
  mysqli_query($conn, $query_insert);

  if (mysqli_affected_rows($conn) > 0){
    echo "
          <script>
            alert('Berhasil menambahkan data');
            document.location.href = 'index.php';
          </script>
    ";
  } else {
    echo "
          <script>
            alert('Gagal menambahkan data!!!');
            document.location.href = 'index.php';
          </script>
    ";
  }
}

// edit data
if ( isset($_POST["edit"]) ){
  // var_dump($_POST);die;
  $id             = $_POST["id"];
  $product_name   = htmlspecialchars($_POST["product_name"]);
  $price          = htmlspecialchars($_POST["price"]);
  $category_id    = htmlspecialchars($_POST["category_id"]);
  $cashier_id     = htmlspecialchars($_POST["cashier_id"]);

  $query_update = "UPDATE product SET 
                    product_name = '$product_name',
                    price = '$price',
                    category_id = '$category_id',
                    cashier_id = '$cashier_id'
                    WHERE id = $id";

  mysqli_query($conn, $query_update);

  if (mysqli_affected_rows($conn) > 0){
    echo "
          <script>
            alert('Data berhasil diubah!');
            document.location.href = 'index.php';
          </script>
    ";
  } else {
    echo "
          <script>
            alert('Data gagal diubah!');
            document.location.href = 'index.php';
          </script>
    ";
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
      input[type=number]::-webkit-inner-spin-button, 
      input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
      }
    </style>

    <title>Arkademy Test</title>
  </head>
  <body>

    <nav class="navbar navbar-light bg-light" style="box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);">
        <div class="container">
            <a class="navbar-brand" href="#" style="font-size: 30px; font-weight: 800;">
                <img src="logo-arkademy.svg" width="99" height="45" class="d-inline-block align-top" alt="">
                ARKADEMY COFFEE SHOP
            </a>
            <button class="btn my-2 my-sm-0 pl-5 pr-5" type="button" data-toggle="modal" data-target="#exampleModalCenter" style="color: #fff; background-color: #ff9fb0; border-color: #ff9fb0; box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2); font-weight: 800;">ADD</button>
        </div>
    </nav>

    <div class="container" style="margin-top: 150px;">
        <div class="card" style="border-radius: 20px; box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.1);">
            <table class="table table-borderless" style="text-align: center;">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Cashier</th>
                    <th scope="col">Product</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                <?php foreach( $products as $p ) : ?>
                  <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $p["cashier_name"] ?></td>
                    <td><?= $p["product_name"] ?></td>
                    <td><?= $p["category_name"] ?></td>
                    <td><?= "Rp".number_format($p["price"], 2, ',', '.'); ?></td>
                    <td><a href="" data-toggle="modal" data-target="#exampleModalCenter<?= $p["id"] ?>"><span class="badge badge-success">Edit</span></a> | <a href="hapus.php?id=<?= $p["id"] ?>&name=<?= $p["cashier_name"] ?>"><span class="badge badge-danger">Delete</span></a></td>
                  </tr>
                <?php $i++; ?>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">ADD</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <div class="form-group">
                  <label for="cashier_id">Cashier Name</label>
                  <select class="form-control" id="cashier_id" name="cashier_id">
                    <?php foreach( $cashiers as $cs ) : ?>
                    <option value="<?= $cs["id_cashier"] ?>"><?= $cs["cashier_name"] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="product_name">Product Name</label>
                  <input type="text" class="form-control" id="product_name" name="product_name">
                </div>
                <div class="form-group">
                  <label for="category_id">Category</label>
                  <select class="form-control" id="category_id" name="category_id">
                    <?php foreach( $categories as $ct ) : ?>
                    <option value="<?= $ct["id_category"] ?>"><?= $ct["category_name"] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="number" class="form-control" id="price" name="price">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="submit" class="btn btn-primary">Add</button>
            </form>
            </div>
        </div>
        </div>
    </div>


    <?php foreach( $products as $pr ) : ?>
    <!-- Modal Edit -->
    <div class="modal fade" id="exampleModalCenter<?= $pr["id"] ?>" tabindex="1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">EDIT</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                <input type="hidden" name="id" value="<?= $pr["id"] ?>">
                <div class="form-group">
                  <label for="cashier_id">Cashier Name</label>
                  <select class="form-control" id="cashier_id" name="cashier_id">
                    <option value="<?= $pr["id_cashier"] ?>"><?= $pr["cashier_name"] ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="product_name">Product Name</label>
                  <input type="text" class="form-control" id="product_name" name="product_name" value="<?= $pr["product_name"] ?>">
                </div>
                <div class="form-group">
                  <label for="category_id">Category</label>
                  <select class="form-control" id="category_id" name="category_id">
                    <option value="<?= $pr["id_category"] ?>"><?= $pr["category_name"] ?></option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="number" class="form-control" id="price" name="price" value="<?= $pr["price"] ?>">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="edit" class="btn btn-primary">Edit</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    <?php endforeach;?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>