<?php
/*
Author: Prasad Kirpekar
Email: prasadkirpekar@outlook.com
Licence: GPL V3
Copyright: Prasad Kirpekar

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class DB{
	private $host='HOST HERE';
	private $username='USERNAME HERE';
	private $password='PASSWORD HERE';
	private $db='DBNAME HERE';
	private $conn;
	var $error;
	private function db_connect(){
		$conn=new mysqli($this->host,$this->username,$this->password,$this->db);
		if(mysqli_connect_error()) die("Site is offline we are working on it");
		else{
			$this->conn=$conn;
			return true;
		}
	}
	private function db_disconnect(){
		mysqli_close($this->conn);
	}
	function get_id($table,$column,$value){
		if($this->db_connect()){
			$sql="select id from $table where $column=$value;";
			
			$result=$this->conn->query($sql);
			if(!mysqli_errno($this->conn)){
				if(mysqli_num_rows($result)==1){
				$result=mysqli_fetch_array($result);	
				$this->db_disconnect(); return $result[0];}
				else { $this->db_disconnect(); return false;}
				}
			else{ $this->error=mysqli_error($this->conn); $this->db_disconnect(); return false;}
		}
	}
	function delete_($table,$column,$value){
		if($this->db_connect()){
			$sql="delete from $table where $column=$value;";
			$result=$this->conn->query($sql);
			if(!mysqli_errno($this->conn)){
			$this->db_disconnect(); return true;}
			else{ $this->error=mysqli_error($this->conn); $this->db_disconnect(); return false;}
		}	
	}
	function ToArray($result) {
	    $rows = array();
	    while($row = $result->fetch_assoc()) {
	        $rows[] = $row;
	    }
	    return $rows;
	}
	function get_($table,$get,$column,$value){
		if($this->db_connect()){
			if($column!=''&&$value!=''){
				$sql="select $get from $table where $column=$value;";
				$result=$this->conn->query($sql);
				if(!mysqli_errno($this->conn)){
					$result=$this->resultToArray($result);
					$this->db_disconnect(); return $result;
				}
				else{ $this->error=mysqli_error($this->conn); echo $this->error; $this->db_disconnect(); return false;}
			}
			else{
				$sql="select $get from $table";
				$result=$this->conn->query($sql);
				if(!mysqli_errno($this->conn)){
					$result=$this->ToArray($result);
					$this->db_disconnect(); return $result;
				}
				else{ $this->error=mysqli_error($this->conn); $this->db_disconnect(); return false;}
			}
		}	
	}
	function put_($table,$columns,$values){
		if($this->db_connect()&&count($columns)==count($values)){
			 $i=0;
			 $len=count($columns);
			$sql="insert into $table(";
			foreach ($columns as $column){
				$sql.=$column;
				if($len-1!=$i){
					$sql.=",";
				}
				$i++;
			}
			$sql.=') values(';
			$i=0;
			foreach ($values as $value){
				$sql.=$value;
				if($len-1!=$i){
					$sql.=',';
				}
				$i++;
			}
			$sql.=");";
			
			$this->conn->query($sql);
			if(!mysqli_errno($this->conn)){$this->db_disconnect(); return true;}
			else{ $this->error=mysqli_error($this->conn); $this->db_disconnect(); return false;}
		}
	}
	function update_($table,$column,$value,$tcolumn,$tvalue){
		if($this->db_connect()){
		$sql="update $table set $column=$value where $table.$tcolumn=$tvalue;";
		$this->conn->query($sql);
		if(!mysqli_errno($this->conn)){$this->db_disconnect(); return true;}
		else{ $this->error=mysqli_error($this->conn); $this->db_disconnect(); return false;}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
?>
