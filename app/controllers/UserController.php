<?php

session_start();
require_once '../config/headers.php';
require_once '../app/models/User.php';

class UserController
{

    public function loadUsers()
    {
        $userModel = new User();
        $userList = $userModel->all();

        $html = ''; 
        foreach ($userList as $key => $value) {
            $html .= 
            '<div class="col-12 col-md-3 col-lg-3 mb-3">
                <div class="card" style="border-color: #5a3894 !important;">
                    <div class="card-body text-center">
                        <div style="border-radius: 50%; width: 60px; height: 60px; background-color:rgb(203, 183, 235); display: flex; justify-content: center; align-items: center; margin: auto;">
                            <span style="font-size: 1.5rem">'.strtoupper($value['name'][0]).'</span>
                        </div>
                        <h6 class="card-title mt-2">
                            ' . $value['name'] . '
                        </h6>
                    </div>
                </div>
            </div>';
        }
            $html .= 
        '</div>';
        echo $html;    
    }   
}
