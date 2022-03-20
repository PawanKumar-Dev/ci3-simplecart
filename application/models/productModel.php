<?php
defined('BASEPATH') or exit('No direct script access allowed');

class productModel extends CI_Model
{

        public function getAllProducts()
        {
                $query = $this->db->get('products');
                return $query->result();
        }

        public function getSingleProduct($proid)
        {
                $query = $this->db->where('id', $proid)->get('products');
                return $query->row();
        }


        public function insertCustomerData($data)
        {
                if($this->db->insert('customers', $data)) {
                        return $this->db->insert_id();
                } else {
                        return false;
                }
        }


        public function insertOrdersData($orderdata)
        {
                if($this->db->insert('orders', $orderdata)) {
                        return $this->db->insert_id();
                } else {
                        return false;
                }
        }


        public function insertOrderItems($orderitems)
        {
                if($this->db->insert('order_items', $orderitems)) {
                        return true;
                } else {
                        return false;
                }
        }

}
