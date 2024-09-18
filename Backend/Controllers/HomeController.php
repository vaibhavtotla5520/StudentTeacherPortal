<?php

require_once "../Models/UserModel.php";

class HomeController extends UserModel
{

    public function login($post)
    {
        $email = !empty($post['email']) ? $post['email'] : false;
        $password = !empty($post['password']) ? $post['password'] : false;
        $return = ['message' => ""];
        if ($email && $password) {
            $res = $this->LoginModel($email, $password);
            if ($res['status'] == 1) {
                $_SESSION['id'] = $res['id'];
                $_SESSION['name'] = $res['name'];

                Extras::sendView("dashboard", ['message' => 'Logged In!']);
            } else if ($res['status'] == 2) {
                Extras::sendView("index", ['message' => 'Wrong Credentials']);
            }
        } else {
            Extras::sendView("index", ['message' => 'Parameters Can not Be Empty']);;
        }
        return $return;
    }

    public function register($post) {
        $name = !empty($post['name']) ? $post['name'] : false;
        $email = !empty($post['email']) ? $post['email'] : false;
        $password = !empty($post['password']) ? $post['password'] : false;
        $cnfPassword = !empty($post['cnf-password']) ? $post['cnf-password'] : false;
        if($email && $password && $cnfPassword) {
            if($password === $cnfPassword) {
                $res = $this->registerTeacher($name, $email, $password);
                if ($res == 0) {
                    Extras::sendView("register", ['message' => 'Already a User, Try Login!']);
                } else if ($res == 1) {
                    Extras::sendView("index", ['message' => 'Registered Successfuly!']);
                }
            } else {
                Extras::sendView("register", ['message' => 'Confirm Password is not same']);
            }
        } else {
            Extras::sendView("register", ['message' => 'Parameters Can not Be Empty']);
        }
    }

    public function logout($id)
    {
        if ($_SESSION['id'] == $id) {
            session_destroy();
            Extras::sendView("index", ['message' => 'Logged Out']);
        }
    }

    public function AddStudent($post)
    {
        $student_name = !empty($post['student_name']) ? $post['student_name'] : false;
        $subject = !empty($post['subject']) ? $post['subject'] : false;
        $mark = !empty($post['mark']) ? $post['mark'] : false;

        if ($student_name && $subject && $mark >= 0) {
            $res = $this->check_student($student_name, $subject, $mark);
            if ($res == 1) {
                Extras::sendView('dashboard', ['message' => 'The Student with the subject Already exist, so we have updated the marks']);
            } else if ($res == 2) {
                Extras::sendView('dashboard', ['message' => 'Student Entry Added Successfuly']);
            } else {
                Extras::sendView('dashboard', ['message' => 'Oops,Someting Went Wrong!']);
            }
        } else {
            Extras::sendView('dashboard', ['message' => 'Everyting is Required']);
        }
    }

    public function EditStudent($post)
    {
        $student_name = !empty($post['student_name']) ? $post['student_name'] : false;
        $subject = !empty($post['subject']) ? $post['subject'] : false;
        $mark = !empty($post['mark']) ? $post['mark'] : false;
        $id = !empty($post['id']) ? $post['id'] : false;

        if ($student_name && $subject && $mark >= 0 && $id) {
            $res = $this->edit_student($id, $student_name, $subject, $mark);
            if ($res == 1) {
                Extras::sendView('dashboard', ['message' => 'Student ' . $student_name . ' got Updated!']);
            } else {
                Extras::sendView('dashboard', ['message' => 'Oops,Someting Went Wrong!']);
            }
        }
    }

    public function deleteStudent($get)
    {
        if (!empty($get['id'])) {
            $id = $get['id'];
            $name = $get['name'];
            $this->delete_student($id);
            Extras::sendView('dashboard', ['message' => 'Student ' . $name . ' got Deleted!']);
        }
    }
}
