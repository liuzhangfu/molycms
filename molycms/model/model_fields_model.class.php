<?php
// +----------------------------------------------------------------------
// | MOLYCMS	自定义模型字段模型
// +----------------------------------------------------------------------
//

defined('MOLYCMS_PATH') or exit;

class model_fields extends model {
	function __construct() {
		$this->table = 'model_fields';	// 表名
		$this->pri = array('id');	// 主键
		$this->maxid = 'id';		// 自增字段
	}
        
    public function get_fields_by_model ($id){
        return $this->find_fetch(array('model'=>$id));
    }

    public function del_fields_by_model($id){
        foreach ($this->get_fields_by_model($id) as $field) {
            $this->delete($field['id']);
        }
        return true;
    }
    
    public function check_duplicate_field($name,$model_id){
        $where = array('name'=>$name,'model'=>$model_id);
        if($this->find_count($where)>0){
            return TRUE;
        }  else {
            return FALSE;
        }
    }

    public function get_fields_by_model_name($table_name){
        $fields = array();
        $result = $this->models->find_fetch(array('tablename'=>$table_name));
        if($result){
            $fields = $this->get_fields_by_model($result['id']);
        }
        return $fields;
    }
}
