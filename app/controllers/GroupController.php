<?php

session_start();
require_once '../config/headers.php';
require_once '../app/models/Group.php';

class GroupController
{

    public function all()
    {
        $date = isset($_GET['date']) ? $_GET['date'] : null;
        
        $group = new Group();
        $groups = $group->all();

        if (count($groups) > 0) {
            foreach ($groups as $key => $value) {
                echo '<div class="col-12 col-md-4 col-lg-3 mb-3">';
                echo '<div class="card">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title"><i class="fa fa-comments"></i>&nbsp;' . $value['name'] . '</h5>';
                echo '<p class="card-text">' . $value['name'] . '</p>';
                echo '<button type="button" class="btn btn-purple" onclick="loadMessages({user: \'1\' ,group:\'' . $value['id'] . '\', date: \''.$date.'\'});">Entrar <i class="fa fa-sign-in"></i></button>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo json_encode(array('message' => 'Nenhum grupo encontrado'));
        }
    }   
}
