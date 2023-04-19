<?php
$filepath=realpath(dirname(__FILE__));
require_once ($filepath.'/../lib/database.php');
require_once ($filepath.'/../helpers/format.php');
?>

<?php
class brand
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_brand($brandName)
    {
        $brandName = $this->fm->validation($brandName);

        $brandName = mysqli_real_escape_string($this->db->link, $brandName);

        if (empty($brandName)) {
            $alert = "<span class='error'> Please enter category Name</span>";
            return $alert;
        } else {
            $query = "insert into tbl_brand(brandName)
                    values('$brandName') ";;
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'> Insert Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Insert Category Failed</span>";
                return $alert;
            }
        }
    }
    public function show_brand()
    {
        $query = "select * from tbl_brand order by brandId asc";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_brand($brandName, $id)
    {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($brandName)) {
            $alert = "<span class='error'> Please enter brand Name</span>";
            return $alert;
        } else {
            $query = "update tbl_brand
                    set brandName='$brandName'
                    where brandId='$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'> Updated Brand Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Updated Brand Failed</span>";
                return $alert;
            }
        }
    }
    public function getbrandbyId($id)
    {
        $query = "select * from tbl_brand 
                    where brandId='$id' limit 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function delete_brand($id)
    {
        $query = "delete  from tbl_brand
                    where brandId='$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Brand deleted Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Brand deleted Failed</span>";
            return $alert;
        }
        return $result;
    }
}
?>