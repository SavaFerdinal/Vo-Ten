<?php
session_start();
$con = mysqli_connect('localhost','root', '', 'voten');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_POST['save_excel_data']))
{
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach($data as $row)
        {
            if($count > 0)
            {
                $id_user = $row['0'];
                $fullname = $row['1'];
                $id_kelas = $row['2'];
                $jk = $row['3'];
                $pemilih = $row['4'];

                $userQuery = "INSERT INTO t_user (id_user,fullname,id_kelas,jk,pemilih) VALUES ('$id_user','$fullname','$id_kelas','$jk','$pemilih')";
                $result = mysqli_query($con, $userQuery);
                $msg = true;
            }
            else
            {
                $count = "1";
            }
        }

        if(isset($msg))
        {
            $_SESSION['message'] = "Successfully Imported";
            header('Location: list.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Imported";
            header('Location: list.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid File";
        header('Location: list.php');
        exit(0);
    }
}
?>