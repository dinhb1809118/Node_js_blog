<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">

</head>

<body>
    <?php require_once 'conect.php';
        if(isset($_GET['id'])){
            $idfix=$_GET['id'];
            
        }
        if(isset($_POST['add'])){
            $name=$_POST['name'];
            $pricelast=$_POST['pricelast'];
            $pricenow=$_POST['pricenow'];
            $description=$_POST['description'];
            $details=$_POST['details'];
           
            if(!empty($_FILES["fileimg"]["name"])){
                $target_dir = "../uploads/";
                $imagepath=basename($_FILES["fileimg"]["name"]);
                $target_file = $target_dir . $imagepath;
                
                move_uploaded_file($_FILES["fileimg"]["tmp_name"], $target_file);

                $sql=mysqli_query($conn,"UPDATE `products` SET 
                `products_name`='$name',`products_price`='$pricenow',`products_price_last`='$pricelast',`products_image`='$imagepath',`products_details`='$details',`products_description`='$description' 
                WHERE `products_id`=$idfix");
 
            }else{
                
                $sql=mysqli_query($conn,"UPDATE `products` SET 
                `products_name`='$name',`products_price`='$pricenow',`products_price_last`='$pricelast',`products_details`='$details',`products_description`='$description' 
                WHERE `products_id`=$idfix");

            }
            
            // var_dump($_FILES["fileimgs"]["name"][0]);
            // exit;
            if(!empty($_FILES["fileimgs"]["name"]) && $_FILES["fileimgs"]["name"][0]!=""){
                $target_dirs = "../uploads/";
                $imagepaths=$_FILES["fileimgs"]["name"];
                // var_dump($imagepaths);exit;
                
                foreach($imagepaths as $key => $value){
                    move_uploaded_file($_FILES["fileimgs"]["tmp_name"][$key], $target_dirs . $value);
                    

                }
                
                if($sql){
                   
                        $deleteimg=mysqli_query($conn,"DELETE FROM `image` WHERE `products_id`=$idfix");
                        foreach($imagepaths as $key => $value){
                            $sqls=mysqli_query($conn,"INSERT INTO `image`( `products_id`, `image_link`) VALUES ('$idfix','$value')");
        
                        }

                    
                }
               
 
            }

            
           
            
           
        }
        if(isset($_GET['id'])){
            $idfix=$_GET['id'];
            $sqlproductfix=mysqli_query($conn,"SELECT * FROM `products` WHERE `products_id`=$idfix");
            $sqlimgfix=mysqli_query($conn,"SELECT * FROM `image` WHERE `products_id`=$idfix");
        }

     ?>
    <div class="app">
        <div class="app-flex">
            <div class="navbar">
                <div class="navbar-heading">
                    <img src="./img/shopping-logo-svgrepo-com.svg" class="navbar-heading-logo"></img>
                    <div class="navbar-heading-text">
                        <b>SHOPPING</b> ADMIN
                    </div>
                </div>
                <div class="navbar-container">
                    <div class="navbar-container-item">
                        <a href="index.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="fal fa-search"></i></div>
                            <div class="navbar-container-link-text">Xem Sản Phẩm</div>
                        </a>
                    </div>
                    <div class="navbar-container-item">
                        <a href="add.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="fal fa-plus"></i></div>
                            <div class="navbar-container-link-text">Thêm Sản Phẩm</div>
                        </a>
                    </div>
                    <div class="navbar-container-item">
                        <a href="products.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="fal fa-wrench"></i></div>
                            <div class="navbar-container-link-text">Sửa Sản Phẩm</div>
                        </a>
                    </div>
                    <div class="navbar-container-item">
                        <a href="products.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="fal fa-trash"></i></div>
                            <div class="navbar-container-link-text">Xóa Sản Phẩm</div>
                        </a>
                    </div>
                    <div class="navbar-container-item">
                        <a href="index.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="fal fa-plus"></i></div>
                            <div class="navbar-container-link-text">Thêm Màu & Size</div>
                        </a>
                    </div>
                    <div class="navbar-container-item">
                        <a href="order.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="far fa-eye"></i></div>
                            <div class="navbar-container-link-text">Xem Đơn Hàng</div>
                        </a>
                    </div>
                    <div class="navbar-container-item">
                        <a href="advertisement.php" class="navbar-container-link">
                            <div class="navbar-container-link-icon"><i class="fal fa-plus"></i></div>
                            <div class="navbar-container-link-text">Thêm Quảng Cáo</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="container-heading">
                    <div class="container-heading-flex">
                        <div class="container-heading-text">
                            <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                            <lord-icon
                                src="https://cdn.lordicon.com/vlupvdhl.json"
                                trigger="loop"
                                colors="primary:#ffffff,secondary:#e83a30"
                                style="width:50px;height:50px">
                            </lord-icon>
                            SỬA SẢN PHẨM
                        </div>
                        <div class="container-heading-right">
                        <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
                        <lord-icon
                            src="https://cdn.lordicon.com/dxjqoygy.json"
                            trigger="loop"
                            colors="primary:#e86830,secondary:#ffffff"
                            style="width:50px;height:50px">
                        </lord-icon>
                            <div class="container-heading-name">Trang Của ADMIN</div>

                        </div>

                    </div>
                </div>
                <form method="POST" action="" id="myform" enctype="multipart/form-data">
                    <?php while($showproductfix=mysqli_fetch_assoc($sqlproductfix)){ ?>
                    <div class="container-big">
                        <div class="container-conatiner">
                            <div class="container-add">
                                <div class="container-add-products-margin">
                                    <div class="container-name">
                                        <div class="container-name-text container-name-text-center">Nhập Tên Sản Phẩm:
                                        </div>
                                        <div class="container-text name-flex">
                                            <input type="text" value="<?php echo $showproductfix['products_name'];?>"
                                                required name="name" class="container-input container-input-flex"
                                                placeholder="Nhập tên sản phẩm">
                                        </div>

                                    </div>

                                    <div class="container-price">
                                        <div class="container-price-last">
                                            <div class="container-name-text container-name-text-center">Nhập giá cũ:
                                            </div>
                                            <div class="container-text">
                                                <input type="number"
                                                    value="<?php echo $showproductfix['products_price_last'];?>"
                                                    required name="pricelast" min="1" max="99999999"
                                                    class="container-input" placeholder="giá cũ">
                                            </div>

                                        </div>
                                        <div class="container-price-now">
                                            <div class="container-name-text">Nhập giá mới:</div>
                                            <div class="container-text">
                                                <input type="number"
                                                    value="<?php echo $showproductfix['products_price'];?>" required
                                                    name="pricenow" min="1" max="99999999" class="container-input"
                                                    placeholder="giá mới">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="container-image-avatar">
                                        <div class="container-name-text container-name-text-center">Ảnh sản phẩm:
                                        </div>
                                        <div class="container-text">
                                            <input type="file" name="fileimg" accept=".jpg,.jpeg,.png"
                                                class="container-input-file">
                                            <div class="show-image-avatar">
                                                <img src="../uploads/<?php echo $showproductfix['products_image'];?>" alt=""
                                                    class="show-avatar">

                                            </div>   
                                        </div>

                                    </div>
                                    <div class="container-image-avatar">
                                        <div class="container-name-text container-name-text-center">Ảnh khác sản phẩm:
                                        </div>
                                        <div class="container-text">
                                            <input type="file" name="fileimgs[]"  accept=".jpg,.jpeg,.png"
                                                class="container-input-file" multiple="multiple">
                                            <div class="show-details-image">
                                                <?php while($showimgdetails=mysqli_fetch_assoc($sqlimgfix)){ ?>
                                                <img src="../uploads/<?php echo $showimgdetails['image_link'] ;?>"
                                                    alt="" class="show-details-img">
                                                <?php } ?>

                                            </div>
                                        </div>

                                    </div>
                                    <div class="container-details">
                                        <div class="container-name-text container-name-text-center">Giới thiệu Sản Phẩm:
                                        </div>
                                        <div class="container-text">
                                            <textarea name="details" required cols="100" rows="10"
                                                class="container-input"><?php echo $showproductfix['products_details'];?></textarea>
                                        </div>

                                    </div>
                                    <div class="container-description">
                                        <div class="container-name-text container-name-text-center">Mô tả Sản Phẩm:
                                        </div>
                                        <div class="container-text">
                                            <textarea name="description" required cols="100" rows="10"
                                                class="container-input"><?php echo $showproductfix['products_description'];?></textarea>
                                        </div>

                                    </div>
                                    <div class="container-add-button">
                                        <button name="add" class="adds-button">
                                            <span></span><span></span><span></span><span></span>
                                            Sửa sản phẩm
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
</body>


</html>