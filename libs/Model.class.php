<?php
	class Model{
		protected $db ;
		public function __construct($dsn,$usr,$pwd){
			try{
				$this->db = new PDO($dsn,$usr,$pwd);
			}catch(PDOException $e){
				echo "Not connect to database!".$e->getMessage();
				die;
			}
		}
		public function execSQL($sql){
			$dbh = $this->db->prepare($sql);
			$dbh->execute();
			return $dbh;
		}
		public function fetchOne($sql){
			$dbh = $this->execSQL($sql);
			$rs = $dbh->fetch(PDO::FETCH_ASSOC);
			//var_dump($dbh);
			return $rs;
		}
		public function fetch($sql){
			$dbh = $this->execSQL($sql);
			$rs = $dbh->fetchAll(PDO::FETCH_ASSOC);
			return $rs;
		}
		public function fetchAll($tbl,$where){
			$sql  ="SELECT * FROM $tbl WHERE {$where}";
			$dbh = $this->execSQL($sql);
			$rs = $dbh->fetchAll(PDO::FETCH_ASSOC);
			//var_dump($dbh);
			return $rs;
		}
		public function insert($tblName,$ar){
			$f = 0;
			$aListKeys 		= array_keys($ar);
			$aListValues 	= array_values($ar);
			$listField 		= implode(',',$aListKeys);
			$listValue		= implode(',',$aListValues);
			$sql = "INSERT INTO {$tblName}({$listField})
			VALUES({$listValue})";
			if($this->execSQL($sql)){
				$f = 1;
			}
			return $f;
		}
		public function checkExitst($tbl,$where){
			$f = 'NO';
			$sql = "SELECT COUNT(1) as TOTAL
					FROM {$tbl} WHERE {$where}";
			$rs = $this->fetchOne($sql);
			if(intval($rs['TOTAL'])>0){
				$f  = 'YES';
			}
			return $f;
		}

		public function deleteId($tbl,$id){
			$f = 'NO';
			$sql = "DELETE FROM {$tbl} WHERE Id = '$id'";
			if($this->execSQL($sql)){
				$f = 'YES';
			}
			return $f;
		}
		public function editInfo($tbl,$pl,$id){
			$f=0;
			$sql = "UPDATE {$tbl} SET {$pl} WHERE Id = $id";
			if ($this->execSQL($sql)) {
				$f = 1;
			}
			return $f;
		}

		public function delete($tbl,$where){
			$f = 'NO';
			$sql = "DELETE FROM {$tbl} WHERE {$where}";
			if($this->execSQL($sql)){
				$f = 'YES';
			}
			return $f;
		}

		public function fetchJoin($sql){
			$dbh = $this->execSQL($sql);
			$rs = $dbh->fetchAll(PDO::FETCH_ASSOC);
			//var_dump($dbh);
			return $rs;
		}

	}