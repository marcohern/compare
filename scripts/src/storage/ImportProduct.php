<?php

require_once('src/Database.php');

class ImportProduct {

	protected static $idCol = '_id';
	protected static $processIdCol = '_processId';
	protected $db;
	protected $_processId;
	
	public function __construct(Database $db) {
		$this->db = $db;
		$this->_processId = 0;
	}

	public function getProcessId() {
		$record = $this->db->selectSingle('ids',['code' => 'import-process']);
		$this->_processId = $record['value'];
		$next = $this->_processId + 1;
		$record = ['value' => $next ];
		$this->db->update('ids', 'code', 'import-process', $record);
		return $this->_processId;
	}

	public function save($table, &$data) {
		foreach($data as $row) {
			$signature = $row['signature'];

			$record = $this->db->selectSingle($table, ['signature' => $signature]);
			$row['_processId'] = $this->_processId;
			if ($record) {
				//update]
				$row['_counter']= $record['_counter']+1;
				$row['_updated'] = date("Y-m-d H:i:s");
				$this->db->update($table, 'signature', $signature, $row);
			} else {
				//create
				$row['_created'] = date("Y-m-d H:i:s");
				$row['_counter'] = 1;
				$row['_updated'] = null;
				$this->db->insert($table, $row);
			}
			
		}
	}
}
?>