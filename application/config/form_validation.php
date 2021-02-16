<?php



$config = array(


      'login'  => array(
                               array(  'field' => 'username','label' => 'Email','rules' => 'required'),
                               array(  'field' => 'password','label' => 'Password','rules' => 'required')
                            ),

      'create_user'  => array(
                             array(  'field' => 'first_name','label' => 'First Name','rules' => 'required|alpha'),
                             array(  'field' => 'last_name','label' => 'Last Name','rules' => 'required|alpha'),
                             array(  'field' => 'email','label' => 'Email','rules' => 'required|valid_email'),
                             array(  'field' => 'phone_number','label' => 'Phone Number','rules' => 'numeric|min_length[10]|max_length[10]'),
                             array(  'field' => 'user_type','label' => 'Type of user','rules' => 'required')
                        ),
);

$config['error_prefix'] = '<p style="color:red">';
$config['error_suffix'] = '</p>';

?>
