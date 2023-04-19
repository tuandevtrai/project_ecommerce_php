<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../lib/database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class wishlist
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function del_in_wishlist($id,$customerId)
    {
        $productId = mysqli_real_escape_string($this->db->link, $id);
        $customerId = mysqli_real_escape_string($this->db->link, $customerId);
        
        $query="delete from tbl_wishlist
                where productId='$productId' and customerId='$customerId'";
        $result=$this->db->delete($query);
        return $result;
    }
    

}
?>