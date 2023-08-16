<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list</title>
    <link rel="stylesheet" href="product List.css">
    <link href="https://fonts.cdnfonts.com/css/neon-led" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;500&display=swap" rel="stylesheet">
</head>

<body>


    <div id="header">
        <h1 style="display: inline; ">product List</h1>  
       
    
    <a href="https://juniortest-hasan-brimo.000webhostapp.com/Add_product.php">
        <button  id="ADD" class="bot">ADD</button></a>

 <form action="" method="post">
    <input type="submit" id="#delete-product-btn" value="MASS DELETE" name="mass_delete" class="bot">
   
</div>

<div id="products">
    
   <?php
class PRODUCTSHOW{
    private $servername;
    private $username;
    private $password;
   private $dbname;
  

    protected function connect(){
        $this->servername ="localhost";
        $this->username="id21145485_root";
        $this->password="Hasanbrimo2@";
        $this->dbname="id21145485_products";
        $conn= new mysqli(  $this->servername ,$this->username,$this->password,$this->dbname);
        if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
        return $conn;
    }
    public function ProductShow(){
        $conn = $this->connect();
        $sql = "SELECT * FROM product";
        $result =mysqli_query($conn,$sql);
       
     
        while($line=mysqli_fetch_array($result)){
            echo '<div id="'.$line[0].'"><div class="checkbox-wrapper-12">
            <div class="cbx">
            <input type="checkbox" name="deleteProduct[]" value="' . $line[0] . '"class=".delete-checkbox">
              <label for="cbx-12"></label>
              <svg width="15" height="14" viewbox="0 0 15 14" fill="none">
                <path d="M2 8.36364L6.23077 12L13 2"></path>
              </svg>
            </div>
            <!-- Gooey-->
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
              <defs>
                <filter id="goo-12">
                  <fegaussianblur in="SourceGraphic" stddeviation="4" result="blur"></fegaussianblur>
                  <fecolormatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 22 -7" result="goo-12"></fecolormatrix>
                  <feblend in="SourceGraphic" in2="goo-12"></feblend>
                </filter>
              </defs>
            </svg>
          </div> ';

            
      echo"<h3>".$line[0]."</h3>". $line[2]."<br>".$line[1]."$<br>";
      switch($line[3]){
        case"DVD":{
            $sql1 = "SELECT size FROM dvd WHERE sku='" . $line[0] . "'";
            $result1 =mysqli_query($conn,$sql1);  
            while($line1=mysqli_fetch_array($result1))
            echo "size:".$line1["size"].
        " MB<div id=\"dvd\" class=\"pics\"><img src=\"dvd.png\" style\"  height: 100px; width: 100px;\"></div></div>";
        }
        
        case"Book":{
            $sql1 = "SELECT weigh FROM book WHERE sku='" . $line[0] . "'";
            $result1 =mysqli_query($conn,$sql1);  
            while($line1=mysqli_fetch_array($result1))
            echo "weigh:".$line1["weigh"]." KG<div id=\"book\" class=\"pics\"><img src=\"book.png\"></div></div>";
        }
        case"furniture":{
            $sql1 = "SELECT * FROM furniture WHERE sku='" . $line[0] . "'";
            $result1 = mysqli_query($conn, $sql1);
            
            while ($line1 = mysqli_fetch_array($result1)) {
                echo "Dimension: " . $line1["height"] . "x" . $line1["width"] . "x" . $line1["length"] . "<div id=\"furniture\" class=\"pics\"><img src=\"pngwing.com.png\"></div></div>";

            }
            
        }
      }
      
        }
       
       }
       public function ProducdDelete($sku){
        $conn = $this->connect();
    $type=null;
        $sql= "SELECT type FROM product WHERE sku ='" .$sku. "'";
        $result = mysqli_query($conn, $sql);
       if ($result) 
    $row = $result->fetch_assoc();
    if ($row) 
        
       
          $sql_delete_type = "DELETE FROM  ".strtolower($type)."  WHERE sku = '" . $sku . "'";
           $type_result = mysqli_query($conn, $sql_delete_type);
          
            

        $sql_delete_product = "DELETE FROM product WHERE sku ='" .$sku. "'";
        $product_result = mysqli_query($conn, $sql_delete_product);
        echo"<style>#".$sku."{ display: none;}</style>";
       
    }
       public function __construct(){

       }
}
$msg="";
 

   $show= new PRODUCTSHOW();
   $show->ProductShow();

if(isset($_POST['mass_delete'])){
    if(!empty($_POST["deleteProduct"])){
        $delete= new PRODUCTSHOW();
    foreach($_POST["deleteProduct"] as $deleteProduct){
      $delete->ProducdDelete($deleteProduct);
    }
}
else{
$msg="<br>select product";
}
}

?>

 
</form >
</div>

<p style="text-align: center;"><?php echo$msg ?></p>
<div id=wallpaper>
   
    <img src="AdobeStock_484083627.png">
</div>
<div id=wallpaper1>
<img src="AdobeStock_495370525 (1).png">
</div>

</body>
</html>