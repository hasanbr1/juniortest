<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="add product.css">
</head>
<body>
<form action="" method="post" id="product_form">
    <div id="header">
        <h1 style="display: inline; ">product Add</h1>  
        <input type="submit" id="save" name="save" value="save">
       <input type="submit" id="cancel" value="cancel" name="cancel">
</div>
<div id="Maincontiner">
<div id="continer">
  
    <label for="sku">SKU :</label>
    <input type="text" id="sku" name ="sku"><br>
    <label for="name">Name :</label>
    <input type="text" id="name" name ="name"><br>
    <label for="price">Price ($):</label>
    <input type="number" id="price" name ="price" min="0"><br>
    <br>
    
   <label id="help_massege" style="width:100%">choose the type of your product</label>
    <select id="productType" name="type"required class="custom-select sources" >
    
    <option value="0" >category</option>
        <option value="DVD" >DVD</option>
        <option value="Book" >Book</option>
        <option value="furniture">furniture</option>
    </select>
    
    </div>
 
    <div id="dvd_form" class="form">
    <label class="HB">Please, provide size</label><br>
    <label for="size"style="width:110px">size (MB) :</label>
    <input type="number" id="size" name ="size"min="0">
</div>
      
    <div id="book_form" class="form">
         <label class="HB">Please, provide weigh</label><br>
    <label for="weigh" style="width:105px">weigh (KG) :</label>
    <input type="number" id="weigh" name ="weigh"min="0">
</div>
    <div id="furniture_form" class="form">
        <label class="HB">Please, provide dimensions</label><br>
    <label for="width"style="width:110px">Width (CM) :</label>
    <input type="number" id="width" name ="width"min="0"><br>
    <label for="length"style="width:110px">Length (CM) :</label>
    <input type="number" id="length" name ="length"min="0"><br>
    <label for="height"style="width:110px">Height (CM) :</label>
    <input type="number" id="height" name ="height"min="0"><br>
</div>
</form>

<?php

class Product{
    private $servername;
    private $username;
    private $password;
   private $dbname;
   public $price;
   public$sku;
   public$name;
   public$type;

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
    private function PriceCheck(){
      if($this->price <= 0)
        echo"<p id=\"helpms\">Please enter a valid price</p>";
       
      else
      $this->AddProduct($this->price,$this->sku,$this->name,$this->type);
    }
    public function ProductList(){
       echo "<script>window.location.replace('https://juniortest-hasan-brimo.000webhostapp.com/');</script>";
    }
    private function CheckSku($sku){
        $conn = $this->connect();
        $sql = "SELECT * FROM product WHERE sku=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $sku);
        $stmt->execute();
        $result = $stmt->get_result();
        $numRows=$result->num_rows;
       
        if($numRows>0 ){
            echo("<p id=\"helpms\">this sku is used</p>");
           }
           elseif($sku==null){
            echo("<p id=\"helpms\">Please enter a valid sku</p>");
           }
            else{
                $this->PriceCheck();
                
            }
    }
    private function AddProduct($price,$sku,$name,$type){
       
           
            $sql="insert into product(price,sku,name,type)values('$price','$sku','$name','$type')";
            $result=$this->connect()->query($sql);
            $this->CheckType($type);
    }
    private function CheckType($type){
       
            $Myproduct= new $type($this->sku);
  
    }
    public function Undo($sku){
        $conn=$this->connect();
        $sql_delete_product = "DELETE FROM product WHERE sku ='" .$sku. "'";
        $product_result = mysqli_query($conn, $sql_delete_product);
    }
 
    public function __construct($price,$sku,$name,$type){
      
    $this->price=$price;
    $this->sku=$sku;
    $this->type=$type;
    $this->name=$name;
  $this->CheckSku($sku);
        
    }
    


}
class Book extends Product{
    private $weigh;
    public $sku;
    private function AddBook(){
           $sql="insert into book(weigh,sku)values('$this->weigh','$this->sku')";
    $result=$this->connect()->query($sql);
    $this->ProductList();
    }
    private function Checkweigh(){
        if($this->weigh ==null){
            $this->Undo($this->sku);
        echo("<p id=\"helpms\">Please enter a valid weigh</p>");
        }
    else
     $this->AddBook();
    }
public function __construct($sku){
    $this->weigh=$_POST['weigh'];
    $this->sku=$sku;
   $this->Checkweigh();
 
}
}
class DVD extends Product{
    private $size;
    public $sku;
    private function CheckSize(){
        if($this->size ==null){
            $this->Undo($this->sku);
        echo("<p id=\"helpms\">Please enter a valid weigh</p>");
        }
    else
    $this->AddDvd();
    }
    private function AddDvd(){
           $sql="insert into dvd(size,sku)values('$this->size','$this->sku')";
        $result=$this->connect()->query($sql);
        $this->ProductList();
    }
    public function __construct($sku){
        $this->size=$_POST['size'];
        $this->sku=$sku;
       $this->CheckSize();
    }
    }
    
class Furniture extends Product{
    private $width,$height,$length;
    public $sku;
    private function Checkparameters(){
        if($this->width ==null){
            $this->Undo($this->sku);
        echo("<p id=\"helpms\">Please enter a valid width</p>");
        }
        elseif($this->height ==null){
            $this->Undo($this->sku);
        echo("<p id=\"helpms\">Please enter a valid height</p>");
        }
        elseif($this->length ==null){
            $this->Undo($this->sku);
        echo("<p id=\"helpms\">Please enter a valid length</p>");
        }
    else
    $this->AddFurniture();
    }
    private function AddFurniture(){
        $sql="insert into furniture(sku,height,width,length)values('$this->sku','$this->height','$this->width','$this->length')";
        $result=$this->connect()->query($sql);
      $this->ProductList();
       
    }
 
    public function __construct($sku){
        $this->sku=$sku;
      $this->width=$_POST['width'];
      $this->height=$_POST['height'];
      $this->length=$_POST['length'];
      $this->Checkparameters();
     
    }
 }
 
if(isset($_POST['save'])){
   
    $name = $_POST['name'];
    $sku = $_POST['sku'];
    $price = $_POST['price'];
    $type= $_POST['type'];
    $product = new Product($price,$sku,$name,$type);
   
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel'])) {
   echo "<script>window.location.replace('https://juniortest-hasan-brimo.000webhostapp.com/');</script>";
}



?>
</div>
<div id=wallpaper>
<img src="360_F_566693467_PI0meebM2eVnIQq3qHneiB7TkRTgXiEo.jpg">
</div>
<div id=wallpaper1>
<img src="AdobeStock_271984202.jpeg">
</div>
<script src="Add_product.js"></script>

</body>
</html>