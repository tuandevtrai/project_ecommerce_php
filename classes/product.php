<?php
$filepath = realpath(dirname(__FILE__));
require_once($filepath . '/../lib/database.php');
require_once($filepath . '/../helpers/format.php');
?>

<?php
class product
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_product($data, $files)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
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

        if ($productName == '' || $brand == '' || $category == '' || $productDesc == '' || $price == '' || $type == '' || $file_name == '') {
            $alert = "<span class='error'> Please enter all fields</span>";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "insert into tbl_product(productName,brandId,catId,productDesc,price,type,image)
                    values('$productName','$brand','$category','$productDesc','$price','$type',' $unique_image')";
            $result = $this->db->insert($query);
            if ($result) {
                $alert = "<span class='success'> Insert product Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Insert product Failed</span>";
                return $alert;
            }
        }
    }
    public function show_product()
    {
        //$query = "select * from tbl_product order by productId asc";
        $query = "select tbl_product.*,tbl_category.catName,tbl_brand.brandName
        from tbl_product inner join tbl_category
        on tbl_product.catId=tbl_category.catId
        inner join tbl_brand 
        on tbl_product.brandId=tbl_brand.brandId
        order by tbl_product.productId asc";
        $result = $this->db->select($query);
        return $result;
    }
    public function update_product($data, $files, $id)
    {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
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

        if ($productName == '' || $brand == '' || $category == '' || $productDesc == '' || $price == '' || $type == '') {
            $alert = "<span class='error'> Please enter all fields</span>";
            return $alert;
        } else {
            if (!empty($file_name))
            // neu nguoi dung chon anh moi
            {
                if ($file_size > 20482048) {
                    $alert = "<span class='error'> Image size should be less than 2MB!</span>";
                    return $alert;
                } else if (in_array($file_ext, $permited) === false) {
                    $alert = "<span class='error'> You can upload only:" . implode(',', $permited) . "</span>";
                    return $alert;
                }
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "update tbl_product set
                  productName='$productName',
                  brandId='$brand',
                  catId='$category',
                  productDesc='$productDesc',
                  price='$price',
                  type='$type',
                  image='$unique_image'
                 where productId='$id'";
            } else {
                // nguoi dung chon anh cu
                $query = "update tbl_product set
                productName='$productName',
                brandId='$brand',
                catId='$category',
                productDesc='$productDesc',
                price='$price',
                type='$type'
                where productId='$id'";
            }
            $result = $this->db->update($query);
            if ($result) {
                $alert = "<span class='success'>Updated product succeed</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Updated product failed</span>";
                return $alert;
            }
        }
    }
    public function getproductbyId($id)
    {
        $query = "select * from tbl_product 
                    where productId='$id' limit 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function delete_product($id)
    {
        $query = "delete  from tbl_product
                    where productId='$id'";
        $result = $this->db->delete($query);
        if ($result) {
            $alert = "<span class='success'>Product deleted Successfully</span>";
            return $alert;
        } else {
            $alert = "<span class='error'>Product deleted Category Failed</span>";
            return $alert;
        }
        return $result;
    }

    //END BACKEND

    // START CLIENT
    public function getproduct_featured()
    {
        $sp_tungtrang = 4;
        if (!isset($_GET['Trang'])) {
            $trang = 1;
        } else {
            $trang = $_GET['Trang'];
        }
        $tung_trang = ($trang - 1) * $sp_tungtrang;
        $query = "select * from tbl_product 
        where type= 1 limit $tung_trang,$sp_tungtrang";
        $result = $this->db->select($query);
        return $result;
    }
    public function getproduct_new()
    {
        $sp_tungtrang = 4;
        if (!isset($_GET['Trang'])) {
            $trang = 1;
        } else {
            $trang = $_GET['Trang'];
        }
        $tung_trang = ($trang - 1) * $sp_tungtrang;
        $query = "select * from tbl_product 
        order by productId desc limit $tung_trang,$sp_tungtrang";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_all_product()
    {
        $query = "select * from tbl_product ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_details($productId)
    {
        $query = "select tbl_product.*,tbl_category.catName,tbl_brand.brandName 
                from tbl_product inner join tbl_category
                on tbl_product.catId=tbl_category.catId
                inner join tbl_brand 
                on tbl_product.brandId=tbl_brand.brandId
                where tbl_product.productId='$productId' limit 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestKeyboard()
    {
        $query = "select * from tbl_product
                where brandId='18' order by productId desc limit 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestLaptop()
    {
        $query = "select * from tbl_product
                where brandId='14' order by productId desc limit 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestMarshall()
    {
        $query = "select * from tbl_product
                where brandId='24' order by productId desc limit 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function getLastestChair()
    {
        $query = "select * from tbl_product
                where brandId='25' order by productId desc limit 1";
        $result = $this->db->select($query);
        return $result;
    }
    public function insert_compare($productId, $customerId)
    {
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $customerId = mysqli_real_escape_string($this->db->link, $customerId);

        $check_compare = "select * from tbl_compare 
                        where productId='$productId' and customerId='$customerId'";
        $result_check_compare = $this->db->select($check_compare);
        if ($result_check_compare) {
            $alert = "<span class='error'> product already added to compare</span>";
            return $alert;
        } else {
            $query = "select * from tbl_product
            where productId='$productId'";
            $product = $this->db->select($query)->fetch_assoc();

            $insert_compare = "insert into tbl_compare(customerId,productId,productName,price,image)
                    values('$customerId','$productId','" . $product['productName'] . "','" . $product['price'] . "','" . $product['image'] . "')";
            $result = $this->db->insert($insert_compare);
            if ($result) {
                $alert = "<span class='success'> Insert compare Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Insert compare Failed</span>";
                return $alert;
            }
        }
    }
    public function insert_wishlist($productId, $customerId)
    {
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $customerId = mysqli_real_escape_string($this->db->link, $customerId);

        $check_wishlist = "select * from tbl_wishlist
                where productId='$productId' and customerId='$customerId'";
        $check_wishlist = $this->db->select($check_wishlist);
        if ($check_wishlist) {
            $alert = "<span class='error'> product already added to wishlist</span>";
            return $alert;
        } else {
            $query = "select * from tbl_product
                    where productId='$productId'";
            $product = $this->db->select($query)->fetch_assoc();
            $insert_wishlist = "insert into tbl_wishlist(customerId,productId,productName,price,image)
                            values('$customerId','$productId','" . $product['productName'] . "','" . $product['price'] . "','" . $product['image'] . "')";
            $result = $this->db->insert($insert_wishlist);
            if ($result) {
                $alert = "<span class='success'> Insert wishlist Successfully</span>";
                return $alert;
            } else {
                $alert = "<span class='error'> Insert wishlist Failed</span>";
                return $alert;
            }
        }
    }
    public function searching_product($tukhoa)
    {
        $tukhoa = $this->fm->validation($tukhoa);
        $tukhoa = mysqli_real_escape_string($this->db->link, $tukhoa);
        $query = "select * from tbl_product
                where productName like '%$tukhoa%'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_laptop()
    {
        $query = "select * from tbl_product
                where  catId='5'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_sounds()
    {
        $query = "select * from tbl_product
        where  catId='4'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_chairs(){
        $query = "select * from tbl_product
        where  catId='6'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_dell(){
        $query = "select * from tbl_product
        where  brandId='14'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_marshall(){
        $query = "select * from tbl_product
        where  brandId='24'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_product_akko(){
        $query = "select * from tbl_product
        where  brandId='18'";
        $result = $this->db->select($query);
        return $result;
    }
}
?>