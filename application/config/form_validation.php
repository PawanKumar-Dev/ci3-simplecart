<?php

$config = array (
	'checkout' => array(
        array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
        ),
        array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|valid_email'
        ),
        array(
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'required'
        ),
        array(
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required'
        )
    )
);


?>