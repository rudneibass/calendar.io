<?php

session_start();
require_once '../config/headers.php';
require_once '../app/models/Group.php';
require_once '../app/models/User.php';

class GroupController
{

    public function all()
    {
        $date = isset($_GET['date']) ? $_GET['date'] : null;
        $user = isset($_GET['user']) ? $_GET['user'] : null;

        $userModel = new User();
        $userRecord = $userModel->getUserBySlug($user);

        $group = new Group();
        $groups = $group->all();
        $html = 
        '<div class="card" style="border-color: #5a3894 !important;">
            <div class="card-body p-3">
                <div class="d-flex">
                    <div style="border-radius: 50%; width: 45px; height: 45px; background-color:rgb(203, 183, 235); display: flex; justify-content: center; align-items: center;">
                        <span>'.strtoupper($userRecord['name'][0]).'</span>
                    </div>
                    <div class="px-2" style="display: flex; flex-direction: column; justify-content: center;">
                        <span  style="font-size: 1rem">'.$userRecord['name'].'</span>
                        <small class="text-muted">'.strftime('%d de %B de %Y', strtotime($date)).'</small>
                    </div>
                </div>
            </div>
        </div>';
        
        if(!count($groups)){
            echo json_encode(array('message' => 'Nenhum grupo encontrado'));
        }

        $html .= 
        '<div class="row mt-4">';
            if (count($groups) > 0) {
                foreach ($groups as $key => $value) {
                    $html .= 
                    '<div class="col-12 col-md-4 col-lg-3 mb-3">
                        <div class="card" style="border-color: #5a3894 !important;">
                            <div class="card-body text-center">
                                <div style="border-radius: 50%; width: 60px; height: 60px; background-color:rgb(203, 183, 235); display: flex; justify-content: center; align-items: center; margin: auto;">
                                    <span style="font-size: 1.5rem">'.strtoupper($value['name'][0]).'</span>
                                </div>
                                <h5 class="card-title mt-2">
                                    ' . $value['name'] . '
                                </h5>
                                <button type="button" class="btn btn-sm btn-purple" onclick="loadMessages({user: \''.$user.'\' ,group:\'' . $value['id'] . '\', date: \''.$date.'\'});">
                                    Entrar 
                                    <i class="fa fa-sign-in"></i>
                                </button>
                            </div>
                        </div>
                    </div>';
                }
            }
            $html .= 
        '</div>';
        echo $html;    
    }   
}
