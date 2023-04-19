<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../lib/database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class comment
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_comment($productId, $tenbinhluan, $binhluan)
    {
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $tenbinhluan = mysqli_real_escape_string($this->db->link, $tenbinhluan);
        $binhluan = mysqli_real_escape_string($this->db->link, $binhluan);
       

        if ($tenbinhluan == '' && $binhluan == '') {
            $alert = "<span class='error'> Please enter all fields</span>";
            return $alert;
        } else {
            $query = "insert into tbl_comment(commentName,detailComment,productId)
            values('$tenbinhluan','$binhluan','$productId')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'> Insert comment successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>  Insert comment  failed</span>";
                return $alert;
            }
        }
    }
    public function show_comment($productId)
    {
        $productId = mysqli_real_escape_string($this->db->link, $productId);

        $query = "select * from tbl_comment
                where productId='$productId'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>