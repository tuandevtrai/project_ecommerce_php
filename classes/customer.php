<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../lib/database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_customer($data)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if ($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == "") {
            $alert = "<span class='error'> Please enter all fields</span>";
            return $alert;
        } else {
            $check_email = "select * from tbl_customer
                        where email='$email' limit 1";
            $result_check = $this->db->select($check_email);
            if ($result_check) {
                $alert = "<span class='error'> Email already exist! Please enter another email</span>";
                return $alert;
            } else {
                $query = "insert into tbl_customer(name,city,zipcode,email,address,country,phone,password)
                        values('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";
                $result = $this->db->insert($query);
                if ($result) {
                    $alert = "<span class='success'> Created customer successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'> Created customer failed</span>";
                    return $alert;
                }
            }
        }
    }
    public function login_customer($data)
    {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        if ($email == "" || $password == "") {
            $alert = "<span class='error'> Please enter email and password</span>";
            return $alert;
        } else {
            $check = "select * from tbl_customer
                    where email='$email' and password='$password' and status_customer='1'";
            $result = $this->db->select($check);
            if ($result) {
                $value = $result->fetch_assoc();
                Session::set('customer_login', true);
                Session::set('customer_id', $value['id']);
                Session::set('customer_name', $value['name']);
                header('location:index.php');
            } else {
                $alert = "<span class='error'> Please enter email and password correctly </span>";
                return $alert;
            }
        }
    }
    public function show_customers($id)
    {

        $query = "select * from tbl_customer
                where id='$id' limit 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function show_order($order_code)
    {

        $query = "select * from tbl_order
                where order_code='$order_code'";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_customer($data, $id)
    {
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        //$country=mysqli_real_escape_string($this->db->link,$data['country']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);

        if ($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" ||  $phone == "") {
            $alert = "<span class='error'> Please enter all fields</span>";
            return $alert;
        } else {
            $query = "update tbl_customer
                set name='$name',address='$address',city='$city',zipcode='$zipcode',phone='$phone',email='$email'
                where id='$id'";
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'> Updated profile successfully </span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Updated profile failed </span>";
                return $alert;
            }
        }
    }
    public function get_all_customer(){
        $query="select * from tbl_customer";
        $result=$this->db->select($query);
        return $result;
    }
    public function update_status_on($id){
        $id=mysqli_real_escape_string($this->db->link,$id);
        $query="update tbl_customer
                set status_customer='0'
                where id='$id'";
        $result=$this->db->update($query);
        return $result;
    }
    public function update_status_off($id){
        $id=mysqli_real_escape_string($this->db->link,$id);
        $query="update tbl_customer
                set status_customer='1'
                where id='$id'";
        $result=$this->db->update($query);
        return $result;
    }
    
}
?>