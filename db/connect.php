<?php
class data 
{
    function connect()
    {
        //select1
        $conn = new mysqli('localhost', 'root', '', 'quanlyphongkham');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $conn->set_charset('utf8');
        return $conn;
    }

    function executeLesult($sql)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn, $sql);
        $list = [];
        while ($row = mysqli_fetch_array($result, 1)) {
            $list[] = $row;
        }
        mysqli_close($conn);
        return $list;
    }
    function execute($sql)
    {
        //cap nhat chen
        $conn = $this->connect();
        mysqli_query($conn, $sql);

        mysqli_close($conn);

    }
    function phantrang($sql){
        $conn = $this->connect();
        $table=mysqli_query($conn,$sql);
        return $table;
        mysqli_close($conn);

    }
    Function dem(){
        $conn = $this->connect();
        $sql="Select * from thuoc";
        $result=mysqli_query($conn, $sql);
        return mysqli_num_rows($result);
        mysqli_close($conn);
    }
    Function demtenbacsi($tenbacsi){
        $conn = $this->connect();
        $sql='SELECT * FROM bacsi where ID_Bacsi in (SELECT ID_Bacsi from lichlamviec WHERE ID_Bacsi='.$tenbacsi.')';
        $result=mysqli_query($conn, $sql);
        return mysqli_num_rows($result);
        mysqli_close($conn);
    }
    Function dem1($id){
        $conn = $this->connect();
        $sql='Select * from lichhen where (Trangthai="Hoàn thành" or Trangthai="Hủy") and ID_Bacsi='.$id;
        $result=mysqli_query($conn, $sql);
        return mysqli_num_rows($result);
        mysqli_close($conn);
    }

    Function demlich($id1){
        $conn = $this->connect();
        $sql='Select * from lichhen where (Trangthai="Hoàn thành" or Trangthai="Hủy") and ID_Benhnhan='.$id1;
        $result=mysqli_query($conn, $sql);
        return mysqli_num_rows($result);
        mysqli_close($conn);
    }
    function delete_appointment($id){
		$delete = $this->db->query("DELETE FROM appointment_list where id = ".$id);
		if($delete)
			return 1;
	}
    function executeSingLesult($sql)
    {
        //select 1 row
        $conn = $this->connect();
        $result = mysqli_query($conn, $sql);
        $row = null;
        if ($result != null) {
            $row = mysqli_fetch_array($result, 1);
        }
        return $row;
    }
}
