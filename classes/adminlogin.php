<?php
$filepath=realpath(dirname(__FILE__));
require_once ($filepath.'/../lib/session.php');
Session::checkLogin();

require_once ($filepath.'/../lib/database.php');
require_once ($filepath.'/../helpers/format.php');

?>

<?php
class  adminlogin
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function login_admin($adminUser, $adminPass)
    {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if (empty($adminUser) || empty($adminPass)) {
            $alert = "Please enter Username and Password";
            return $alert;
        } else {
            $query = "select * from tbl_admin where adminUser='$adminUser' and adminPass='$adminPass'limit 1";
            $result = $this->db->select($query);

            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set('adminLogin', true);
                Session::set('adminId', $value['adminId']);
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminName', $value['adminName']);
                header('location:index.php');
            } else {
                $alert = "Username and Password are not match";
                return $alert;
            }
        }
    }
   
}
?>