<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../lib/database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function add_to_cart($productId, $quantity)
    {
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $sId = session_id();

        $query = "select * from tbl_product
                where productId='$productId' limit 1";
        $result = $this->db->select($query)->fetch_assoc();

        $query_cart = "select * from tbl_cart
                    where productId='$productId' and sId='$sId'";

        $check_cart = $this->db->select($query_cart);
        if ($check_cart) {
            $msg = "Product already added";
            return $msg;
        } else {
            $query_insert = "insert into tbl_cart(productId,sId,productName,price,quantity,image)
            values('$productId','$sId','" . $result['productName'] . "','" . $result['price'] . "','$quantity','" . $result['image'] . "')";
            $insert_cart = $this->db->insert($query_insert);
            if ($insert_cart) {
                header('location:cart.php');
            } else {
                header('location:404.php');
            }
        }
    }
    public function get_product_cart()
    {
        $sId = session_id();
        $query = "select * from tbl_cart where sId='$sId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_quantity_cart($quantity, $cartId)
    {
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);

        $query = "update tbl_cart
                set quantity='$quantity'
                where cartId='$cartId'";
        $result = $this->db->update($query);
        if ($result) {
            header('location:cart.php');
        } else {
            $msg = "<span  class='error'>Product quantity updated not successfully</span>";
            return $msg;
        }
    }
    public function del_in_cart($id)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "delete from tbl_cart
                where cartId='$id'";
        $result = $this->db->delete($query);
        if ($result) {
            header('location:cart.php');
        } else {
            $alert = "<span class='error'> Deleted product Failed</span>";
            return $alert;
        }
    }
    public function check_cart()
    {
        $sId = session_id();
        $query = "select * from tbl_cart where sId='$sId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function del_all_data_cart()
    {
        $sId = session_id();
        $query = "delete  from tbl_cart where sId='$sId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function insertOrder($customer_id)
    {
        $sId = session_id();
        $query = "select * from tbl_cart
                where sId='$sId'";
        $get_product = $this->db->select($query);
        if ($get_product) {
            while ($result = $get_product->fetch_assoc()) {
                $productId = $result['productId'];
                $productName = $result['productName'];
                $quantity = $result['quantity'];
                $price = $result['price']*$quantity;
                $image = $result['image'];
                $customerId = $customer_id;

                $query_order="insert into tbl_order(productId,productName,quantity,price,image,customerId)
                values('$productId','$productName','$quantity','$price','$image','$customerId')";
                $insert_order=$this->db->insert($query_order);

            }
        }
    }
    public function get_amount_price($customerId){
    
        $query="select price from tbl_order where customerId='$customerId' ";
        $get_price=$this->db->select($query);
        return $get_price;
    }
    public function get_cart_ordered($customerId){
        $query="select * from tbl_order where customerId='$customerId' ";
        $get_price=$this->db->select($query);
        return $get_price;
    }
    public function check_order($customerId){
        $query="select * from tbl_order where customerId='$customerId' ";
        $result=$this->db->select($query);
        return $result;
    }
    public function get_compare($customerId){
        $query="select * from tbl_compare
                where customerId='$customerId'";
        $result=$this->db->select($query);
        return $result;
    }
    public function del_in_compare($customerId){
        $query="delete from tbl_compare
                where customerId='$customerId'";
        $result=$this->db->delete($query);
        return $result;
    }
    public function get_wishlist($customerId){
        $query="select * from tbl_wishlist
                where customerId='$customerId'";
        $result=$this->db->select($query);
        return $result;
    }
    


    /** ADMIN */
    public function get_inbox_cart(){
        $query="select * from tbl_order order by date_order asc ";
        $result=$this->db->select($query);
        return $result;
    }
    public function pendding($id,$time,$price){
        $id=mysqli_real_escape_string($this->db->link,$id);
        $time=mysqli_real_escape_string($this->db->link,$time);
        $price=mysqli_real_escape_string($this->db->link,$price);

        $query="update tbl_order
                set status='1'
                where id='$id' and date_order='$time' and price='$price'";
        $result=$this->db->update($query) ;
        if($result){
            $alert = "<span class='success'> Updated status successfully</span>";
            return $alert;
        }else{
            $alert = "<span class='error'> Updated status Failed</span>";
            return $alert;
        }
    }
    // public function shifting($id, $time, $price){
    //     $id=mysqli_real_escape_string($this->db->link,$id);
    //     $time=mysqli_real_escape_string($this->db->link,$time);
    //     $price=mysqli_real_escape_string($this->db->link,$price);

    //     $query="update tbl_order
    //             set status='3'
    //             where id='$id' and date_order='$time' and price='$price'";
    //     $result=$this->db->update($query) ;
    //     if($result){
    //         $alert = "<span class='success'> Updated status successfully</span>";
    //         return $alert;
    //     }else{
    //         $alert = "<span class='error'> Updated status Failed</span>";
    //         return $alert;
    //     }
    // }

    public function del_shifted($id,$time,$price){
        $id=mysqli_real_escape_string($this->db->link,$id);
        $time=mysqli_real_escape_string($this->db->link,$time);
        $price=mysqli_real_escape_string($this->db->link,$price);

        $query="delete from tbl_order
        where id='$id' and date_order='$time' and price='$price'";
        $result=$this->db->delete($query);
        if($result){
            $alert = "<span class='success'> Deleted order successfully</span>";
            return $alert;
        }else{
            $alert = "<span class='error'> Deleted order Failed</span>";
            return $alert;
        }
    }
    public function shifted_confirm($id, $time, $price){
        $id=mysqli_real_escape_string($this->db->link,$id);
        $time=mysqli_real_escape_string($this->db->link,$time);
        $price=mysqli_real_escape_string($this->db->link,$price);

        $query="update tbl_order
                set status='2'
                where customerId='$id' and date_order='$time' and price='$price'";
        $result=$this->db->update($query);
        if($result){
            $alert = "<span class='success'> Update status successfully</span>";
            return $alert;
        }else{
            $alert = "<span class='error'> Update status Failed</span>";
            return $alert;
        }
    }
    // END ADMIN

}
?>