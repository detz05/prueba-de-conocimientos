<?php
require_once("connect.php");

header('Content-Type: application/json');

$sql = new Connection();

if($sql->isConnected):
    $post = json_decode(file_get_contents('php://input'), true);
    
    if($post['isEdit']):
        $update = $sql->indelup("UPDATE students SET name = ?, p_one = ?, p_two = ?, p_three = ? WHERE id = ?", $post['name'], $post['parOne'], $post['parTwo'], $post['parThree'], $post['id']);        
        return print_r(json_encode($update ? $post : false));        
    else:
        if($post['id'] == 0):
            $insert = $sql->indelup("INSERT INTO students(name, p_one, p_two, p_three) VALUES(?,?,?,?)", $post['name'], $post['parOne'], $post['parTwo'], $post['parThree']);
            return print_r(json_encode($insert ? $post : false));
        else:
            $delete = $sql->indelup("DELETE FROM students WHERE id = ?", $post['id']);
            return print_r(json_encode($delete ? true : false));
        endif;
    endif;
    
else:
    return print_r(json_encode(false));
endif;


return;