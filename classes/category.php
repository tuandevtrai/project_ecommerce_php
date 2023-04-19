<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../lib/database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class  category
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_category($catName)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);

        if (empty($catName)) {
            $alert = "<span class='error'> Please enter category Name</span>";
            return $alert;
        } else {
            $query = "insert into tbl_category(catName)
                    values('$catName') ";;
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
    public function insert_post_category($post_cate_name,$post_cate_desc,$post_cate_status){
        $post_cate_name = $this->fm->validation($post_cate_name);
        $post_cate_desc = $this->fm->validation($post_cate_desc);
        $post_cate_status = $this->fm->validation($post_cate_status);
        $post_cate_name = mysqli_real_escape_string($this->db->link, $post_cate_name);
        $post_cate_desc = mysqli_real_escape_string($this->db->link, $post_cate_desc);
        $post_cate_status = mysqli_real_escape_string($this->db->link, $post_cate_status);

        if (empty($post_cate_name)||empty($post_cate_desc)||empty($post_cate_status)) {
            $alert = "<span class='error'> Category post must be not empty</span>";
            return $alert;
        } else {
            $query = "insert into tbl_category_post(title,description,status)
                    values('$post_cate_name','$post_cate_desc','$post_cate_status')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'> Insert Category post Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Insert Category post Failed</span>";
                return $alert;
            }
        }
    }
    public function show_category()
    {
        $query = "select * from tbl_category order by catId asc";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_category($catName, $id)
    {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $id = mysqli_real_escape_string($this->db->link, $id);

        if (empty($catName)) {
            $alert = "<span class='error'> Please enter category Name</span>";
            return $alert;
        } else {
            $query = "update tbl_category
                    set catName='$catName'
                    where catId='$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'> Updated Category Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Updated Category Failed</span>";
                return $alert;
            }
        }
    }
    public function getcatbyId($id)
    {
        $query = "select * from tbl_category 
                    where catId='$id' limit 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function delete_category($id)
    {
        $query = "delete  from tbl_category 
                    where catId='$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Category deleted Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Category deleted Category Failed</span>";
            return $alert;
        }
        return $result;
    }
    public function show_category_frontend()
    {
        $query = "select * from tbl_category order by catId asc";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_by_cat($catId)
    {
        $query = "select * from tbl_product 
                where catId='$catId' order by productId desc limit 8";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_name_by_cat($catId)
    {
        $query="select * from tbl_category
                where catId='$catId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function check_empty_in_cart($catId){
        $query="select * from tbl_product,tbl_category
                where tbl_product.catId=tbl_category.catId 
                and tbl_product.catId='$catId'";
        $result=$this->db->select($query);
        return $result;
    }
}
?>