<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../lib/database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class post
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_post_category($post_cate_name, $post_cate_desc, $post_cate_status)
    {
        $post_cate_name = $this->fm->validation($post_cate_name);
        $post_cate_desc = $this->fm->validation($post_cate_desc);
        $post_cate_status = $this->fm->validation($post_cate_status);
        $post_cate_name = mysqli_real_escape_string($this->db->link, $post_cate_name);
        $post_cate_desc = mysqli_real_escape_string($this->db->link, $post_cate_desc);
        $post_cate_status = mysqli_real_escape_string($this->db->link, $post_cate_status);

        if ($post_cate_name == '' || $post_cate_desc == '' || $post_cate_status == '') {
            $alert = "<span class='error'> Category post must be not empty</span>";
            return $alert;
        } else {
            $query = "insert into tbl_category_post(post_title,description,status)
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
    public function show_post()
    {
        $query = "select * from tbl_category_post order by id_cate_post desc";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_post_update($id)
    {
        $query = "select * from tbl_category_post 
                    where id_cate_post='$id'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_status_on($statusId)
    {
        $statusId = mysqli_real_escape_string($this->db->link, $statusId);
        $query = "update  tbl_category_post
                set status='0'
                where id_cate_post='$statusId'";
        $result = $this->db->update($query);
        if ($result) {
            $alert = "<span class='success'> Updated status post Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Updated status post Failed</span>";
            return $alert;
        }
    }
    public function update_status_off($statusId)
    {
        $statusId = mysqli_real_escape_string($this->db->link, $statusId);
        $query = "update  tbl_category_post
                set status='1'
                where id_cate_post='$statusId'";
        $result = $this->db->update($query);
        if ($result) {
            $alert = "<span class='success'> Updated status post Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Updated status post Failed</span>";
            return $alert;
        }
    }
    public function del_post($id_cate_post)
    {
        $id_cate_post = mysqli_real_escape_string($this->db->link, $id_cate_post);
        $query = "delete from tbl_category_post
                where id_cate_post='$id_cate_post'";
        $result = $this->db->delete($query);
        return $result;
    }
    public function update_post($id, $title, $description)
    {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $title = mysqli_real_escape_string($this->db->link, $title);
        $description = mysqli_real_escape_string($this->db->link, $description);

        if ($title == '' || $description == '') {
            $alert = "<span class='error'> Category post must be not empty</span>";
            return $alert;
        } else {
            $query = "update tbl_category_post
                    set post_title='$title' , description='$description'
                    where id_cate_post='$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'> Updated status post Successfully</span>";
                return $alert;
                header('location:postlist.php');
            } else {
                $alert = "<span class='error'> Updated status post Failed</span>";
                return $alert;
            }
        }
    }
    public function show_post_name(){
        $query="select * from tbl_category_post";
        $result=$this->db->select($query);
        return $result;
    }
    public function get_all_post(){
        $query="select * from tbl_category_post";
        $result=$this->db->select($query);
        return $result;
    }
}
?>