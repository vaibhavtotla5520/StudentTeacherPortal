<?php
require_once "../Config/Database.php";

class UserModel extends Database
{

    protected function LoginModel($email, $password)
    {
        if (!empty($email) && !empty($password)) {
            $query = "SELECT id,name FROM teachers WHERE email='" . $email . "' AND password='" . $password . "' LIMIT 1;";
            $result = $this->connect()->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $return_arr = [
                    "status" => 1,
                    "id" => $row["id"],
                    "name" => $row["name"]
                ];

                return $return_arr;
            } else {
                return [
                    "status" => 2
                ];
            }
        } else {
            return [
                "status" => 0
            ];
        }
    }

    protected function registerTeacher($name, $email, $password)
    {
        $query = "SELECT id,name FROM teachers WHERE email='" . $email . "' LIMIT 1;";
        $result = $this->connect()->query($query);
        if ($result->num_rows > 0) {
            // $row = $result->fetch_assoc();
            return 0;
        } else {
            $insert_query = "INSERT INTO teachers (name, email, password) VALUES ('" . $name . "', '" . $email . "', " . $password . ");";
            if ($this->connect()->query($insert_query) === TRUE) {
                return 1;
            }
            return 2;
        }
    }

    protected function check_student($stu_name, $subject, $mark)
    {
        $query = "SELECT * FROM students WHERE name='" . $stu_name . "' AND subject='" . $subject . "' LIMIT 1;";
        $result = $this->connect()->query($query);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id = $row['id'];
            $mark = !$mark ? 0 : $mark;
            $update_query = "UPDATE students SET mark = " . $mark . " WHERE id = " . $id . ";";
            if ($this->connect()->query($update_query) === TRUE) {
                return 1;
            }
            return 0;
        } else {
            $result = $this->add_student($stu_name, $subject, $mark);
            return $result ? 2 : 0;
        }
    }

    protected function add_student($stu_name, $subject, $mark)
    {
        $mark = !$mark ? 0 : $mark;
        $insert_query = "INSERT INTO students (name, subject, mark) VALUES ('" . $stu_name . "', '" . $subject . "', " . $mark . ");";
        if ($this->connect()->query($insert_query) === TRUE) {
            return true;
        }
        return false;
    }

    protected function edit_student($id, $stu_name, $subject, $mark)
    {
        $mark = !$mark ? 0 : $mark;
        $update_query = "UPDATE students SET name = '" . $stu_name . "', subject = '" . $subject . "', mark = " . $mark . " WHERE id = " . $id . ";";
        // die($update_query);
        if ($this->connect()->query($update_query) === TRUE) {
            return 1;
        }
        return 0;
    }

    protected function delete_student($id)
    {
        $delete_query = "DELETE FROM students WHERE id = " . $id . ";";
        if ($this->connect()->query($delete_query) === TRUE) {
            return 1;
        }
        return 0;
    }
}
