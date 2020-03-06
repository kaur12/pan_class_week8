<?php 
function createUser($fname, $username, $password, $email){
    $pdo = Database::getInstance()->getConnection();

    //TODO: build the proper SQL query with the infomation above
    // execute it to create a user in tbl_user;
    $create_user_query = 'INSERT INTO tbl_user(user_fname, user_name, user_pass, user_email)';
    $create_user_query .= ' VALUES(:fname, :username, :password, :email)';
    $create_user_set = $pdo->prepare($create_user_query);
    $create_user_result = $create_user_set->execute(
        array(
            ':fname'=>$fname,
            ':username'=>$username,
            ':password'=>$password,
            ':email'=>$email
        )
    );
    //TODO: based on the execution result, if everything goes through
    // redirect to the index.php
    // Otherwise, return a error message

    if($create_user_result){
        redirect_to('index.php');
    }else{
        return 'This individual sucks!';
    }
}

function getSingleUser($id){
    //TODO: set up database connection
    $pdo = Database::getInstance()->getConnection();

    //TODO: run the proper SQL query to fetch the user based on $id
    $get_user_query = 'SELECT * FROM tbl_user WHERE user_id = :id';
    $get_user_set = $pdo->prepare($get_user_query);
    $get_user_result = $get_user_set->execute(
        array(
            ':id'=>$id
        )
        );

    //TODO: return the user data if the above query went through
    //otherwise, return some error message
    if($get_user_result){
        return $get_user_set;
    }else{
        return 'There was a problem accessing';
    }
}

function editUser($id, $fname, $username, $passowrd, $email){
    //TODO: get the database  connection

    $pdo = Database::getInstance()->getConnection();

    //TODO: Run the proper SQL query to update tbl_user

    $update_user_query = 'UPDATE tbl_user SET user_fname=:fname, user_name=:username, user_pass=:password, user_email=:email WHERE user_id=:id';
    $update_user_set = $pdo->prepare($update_user_query);
    $update_user_result = $update_user_set->execute(
        array(
            ':fname'=>$fname,
            ':username'=>$username,
            ':password'=>$password,
            ':email'=>$email,
            ':id'=>$id
        )
    );

    //TODO: if the update SQL query went through redirect user to index.php
    //Otherwise return some error message

    if($update_user_result){
        redirect_to('index.php');
    }else{
        return 'Update failed....';
    }
}