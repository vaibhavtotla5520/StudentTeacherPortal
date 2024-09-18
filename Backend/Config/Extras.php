<?php

class Extras
{
    public static function view($view_name)
    {
        header("Location:" . WEBSITE_URL . $view_name . ".php");
    }

    public static function sendView($view_name, $data = [])
    {
        echo "<form id='redirectForm' action='" . WEBSITE_URL . $view_name . ".php' method='POST'>";

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $sub_key => $sub_value) {
                    echo "<input type='hidden' name='" . htmlspecialchars($key) . "[$sub_key]' value='" . htmlspecialchars($sub_value) . "'>";
                }
            } else {
                echo "<input type='hidden' name='" . htmlspecialchars($key) . "' value='" . htmlspecialchars($value) . "'>";
            }
        }

        echo "</form>";

        echo "<script type='text/javascript'>
                document.getElementById('redirectForm').submit();
              </script>";

        exit();
    }


}
