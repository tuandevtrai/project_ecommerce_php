<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../lib/database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class slider
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function show_slider(){
        $query="select * from tbl_slider where type='1' order by sliderId asc";
        $result=$this->db->select($query);
        return $result;
    }
    public function show_all_slider(){
        $query="select * from tbl_slider order by sliderId asc";
        $result=$this->db->select($query);
        return $result;
    }
    public function insert_slider($data,$file)
    {
        $silderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);
        

        // Kiem tra hinh anh va lay hinh anh cho vao folder uploads
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;
        
        

        if ($silderName == '' || $type == '' || $file_name=='') {
            $alert = "<span class='error'> Please enter all fields</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "insert into tbl_slider(sliderName,image,type)
                    values('$silderName',' $unique_image',  '$type')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'> Insert slider Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Insert slider Failed</span>";
                return $alert;
            }
        }
    }
    public function del_slider($sliderId){
        $sliderId=mysqli_real_escape_string($this->db->link,$sliderId);
        $query="delete from tbl_slider
                where sliderId='$sliderId'";
        $result=$this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'> Deleted slider Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Deleted slider Failed</span>";
            return $alert;
        }
    }
    public function update_slider_on($sliderId){
        $sliderId=mysqli_real_escape_string($this->db->link,$sliderId);
        $query="update tbl_slider
                set type='0'
                where sliderId='$sliderId'";
        $result=$this->db->update($query);
        if ($result) {
            $alert = "<span class='success'> Updated slider Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Updated slider Failed</span>";
            return $alert;
        }
    }
    public function update_slider_off($sliderId){
        $sliderId=mysqli_real_escape_string($this->db->link,$sliderId);
        $query="update tbl_slider
                set type='1'
                where sliderId='$sliderId'";
        $result=$this->db->update($query);
        if ($result) {
            $alert = "<span class='success'> Updated slider Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'> Updated slider Failed</span>";
            return $alert;
        }
    }
    

}
?>