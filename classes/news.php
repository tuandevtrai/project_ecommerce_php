<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../lib/database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class news
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_new($data, $file){
        $title=mysqli_real_escape_string($this->db->link,$data['title']);
        $description=mysqli_real_escape_string($this->db->link,$data['description']);
        $content=mysqli_real_escape_string($this->db->link,$data['content']);
        $cate_post_id=mysqli_real_escape_string($this->db->link,$data['category_post_name']);
        $status=mysqli_real_escape_string($this->db->link,$data['status']);

        // Kiem tra hinh anh va lay hinh anh cho vao folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = time() . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if($title==''|| $description==''||$content==''||$cate_post_id==''||$status==''){
            $alert = "<span class='error'> Please enter all fields</span>";
            return $alert;
        }else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query="insert into tbl_new(title,description,content,category_post_id,image,status)
                    values('$title','$description','$content','$cate_post_id','$unique_image',$status)";
            $result=$this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'> Insert new Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Insert bew Failed</span>";
                return $alert;
            }
        }
    }
    public function show_new(){
        $query="select * from tbl_new order by id desc";
        $result=$this->db->select($query);
        return $result;
    }
    public function show_post_name(){
        $query="select tbl_new.*,tbl_category_post.post_title from tbl_new
                inner join tbl_category_post
                where tbl_new.category_post_id = tbl_category_post.id_cate_post
                order by tbl_new.id desc";
        $result=$this->db->select($query);
        return $result;
    }
    public function update_status_on($status_id){
        $status_id=mysqli_real_escape_string($this->db->link,$status_id);

        $query="update  tbl_new
                set status='0'
                where id='$status_id'";
        $result=$this->db->update($query);
        return $result;
    }
    public function update_status_off($status_id){
        $status_id=mysqli_real_escape_string($this->db->link,$status_id);

        $query="update  tbl_new
                set status='1'
                where id='$status_id'";
        $result=$this->db->update($query);
        return $result;
    }
    public function del_new($id){
        $id=mysqli_real_escape_string($this->db->link,$id);

        $query="delete from tbl_new
                where id='$id'";
        $result=$this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'> Delete new Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Delete bew Failed</span>";
            return $alert;
        }
    }
    public function get_new_by_id($id){
        $id=mysqli_real_escape_string($this->db->link,$id);
        $query="select * from tbl_new
                where id='$id'";
        $result=$this->db->select($query);
        return $result;
    }
    public function update_new($data, $file, $id){
        $title=mysqli_real_escape_string($this->db->link,$data['title']);
        $description=mysqli_real_escape_string($this->db->link,$data['description']);
        $content=mysqli_real_escape_string($this->db->link,$data['content']);
        $cate_post_id=mysqli_real_escape_string($this->db->link,$data['category_post_name']);
       

        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = time() . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if($title==''|| $description==''||$content==''||$cate_post_id==''){
            $alert = "<span class='error'> Please enter all fields</span>";
            return $alert;
        }else{
            if(!empty($file_name)){
                // nguoi dung chon anh moi
                if($file_size>20482048){
                    $alert="<span class='error'> Image size should be less than 2MB</span>";
                    return $alert;
                }else if(in_array($file_ext,$permited)===false){
                    $alert="<span class='error'> You can upload only:". implode(',',$permited)."</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp,$uploaded_image);
                $query="update tbl_new
                        set title='$title',
                        description='$description',
                        content='$content',
                        category_post_id='$cate_post_id',
                        image='$unique_image'
                        where id='$id'";
            }else{
                // nguoi dung chon anh cu
                $query="update  tbl_new
                        set title='$title',
                        description='$description',
                        content='$content',
                        category_post_id='$cate_post_id'
                        where id='$id'";
            }
            $result=$this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Updated new succeed</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Updated new failed</span>";
                return $alert;
            }
        }
    }
    public function get_tin_game(){
        $sp_tungtrang=4;
        if(!isset($_GET['Trang'])){
            $trang=1;
        }else{
            $trang=$_GET['Trang'];
        }
        $tung_trang=($trang-1)*$sp_tungtrang;
        $query="select * from tbl_new
                where category_post_id='14' limit $tung_trang,$sp_tungtrang";
        $result=$this->db->select($query);
        return $result;
    }
    public function get_tin_khoa_hoc(){
        $sp_tungtrang=4;
        if(!isset($_GET['Trang'])){
            $trang=1;
        }else{
            $trang=$_GET['Trang'];
        }
        $tung_trang=($trang-1)*$sp_tungtrang;
        $query="select * from tbl_new
                where category_post_id='15' limit $tung_trang,$sp_tungtrang";
        $result=$this->db->select($query);
        return $result;
    }
    public function get_tin_the_thao(){
        $sp_tungtrang=4;
        if(!isset($_GET['Trang'])){
            $trang=1;
        }else{
            $trang=$_GET['Trang'];
        }
        $tung_trang=($trang-1)*$sp_tungtrang;
        $query="select * from tbl_new
                where category_post_id='16' limit $tung_trang,$sp_tungtrang";
        $result=$this->db->select($query);
        return $result;
    }
    public function get_all_new()
    {
        $query = "select * from tbl_new ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_new_details($newId){
        $newId=mysqli_real_escape_string($this->db->link,$newId);

        $query="select * from tbl_new
                where id='$newId'";
        $result=$this->db->select($query);
        return $result;
    }

    
}
?>