<?php
/**
 * Created by PhpStorm.
 * User: zhenglfsir
 * Date: 2016/10/6
 * Time: 18:24
 */
namespace Common\Model;
use Think\Model;

class MenuModel extends Model {
    private $_db = '';
    public function __construct()
    {
        parent::__construct();
        $this->_db = M('menu');
    }

    public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 0;
        }
        $this->_db->add($data);
    }

    public function getMenus($data, $page, $pageSize=10) {
        $data['status'] = array('neq', -1 );
        $offset = ($page - 1) * $pageSize;
        $list = $this->_db->where($data)->order('menu_id desc')->limit($offset, $pageSize)->select();
        return $list;
    }

    public function getMenusCount($data = array()) {
        $data['status'] = array('neq', -1);
        return $this->_db->where($data)->count();
    }

    public function find($id) {
        if(!$id || !is_numeric($id)) {
            return array();
        }
        return $this->_db->where('menu_id='.$id)->find();
    }

    public function updateMenuById($id, $data) {
        if(!$id || !is_numeric($id)) {
            throw_exception('ID不合法');
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新数据不合法');
        }
        $this->_db->where('menu_id='.$id)->save($data);
    }

    public function updateStatusById($id, $status) {
    }
}

