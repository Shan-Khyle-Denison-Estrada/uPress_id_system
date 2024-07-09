<?php
include_once("model/studModel.php");
include_once("model/empModel.php");
$client = new StudentModel();
$client1 = new EmployeeModel();  

if(isset($_POST["type"]) == "addStud"){
    handleAddStud($client);
}

function handleAddStud($objModel){
    var_dump($objModel);
    $type = $_POST["type"];
    $formtype = $_POST["formType"];
    $studId = $_POST["studnum"];
    $wmsuEmail = $_POST["wmsuEmail"];
    $firstname = $_POST["firstName"];
    $middlename = $_POST["middleName"];
    $familyname = $_POST["familyName"];
    $nameExt = $_POST["nameExt"];
    $program = $_POST["programs"];
    $emgfname = $_POST["firstNameEmg"];
    $emgMname = $_POST["middleNameEmg"];
    $emgLname = $_POST["familyNameEmg"];
    $emgNameExt = $_POST["nameExtEmg"];
    $emgAddress = $_POST["address"];
    $emgContact = $_POST["contactNumber"];
    $photo = uploadImage('userPhoto');
    $signature = uploadImage('signature');
    $cor = uploadImage('cor');
    $oldId = uploadImage('oldId');
    $oldIdBack = uploadImage('oldIdBack');
    $aol = uploadImage('aol');

    $newClient = $objModel->requestId(
        $type, $formtype, $studId, $wmsuEmail, $firstname, $middlename, $familyname, $nameExt,
            $program, $emgfname, $emgMname, $emgLname, $emgNameExt, $emgAddress, $emgContact, $photo, $signature, $cor, $oldId, $oldIdBack, $aol
    );
    if ($newClient) {
        echo json_encode(['message'=>'Successfully added '.$firstname.' '.$familyname,'status'=>'success']);
    } else {
        echo json_encode(['message'=>'Failed to add'.$firstname.' '.$familyname,'status'=>'error']);
    }

}



function uploadImage($fieldName) {
    $errors = array();
    $uploadedFiles = array();

    $allowedExtensions = array("jpeg", "jpg", "png", "gif");
    foreach ($_FILES as $fileKey => $fileArray) {
        if (isset($fileArray)) {
            foreach ($fileArray['tmp_name'] as $key => $tmp_name) {
                $file_name = $fileArray['name'][$key];
                $file_tmp = $fileArray['tmp_name'][$key];
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);

                if (!in_array($ext, $allowedExtensions)) {
                    $errors[] = "Extension not allowed for $file_name, please choose a JPEG, JPG, PNG, or GIF file.";
                    continue;
                }

                $filename = basename($file_name, "." . $ext);
                $photoName = $filename . time() . "." . $ext;
                $uploadPath = "uploads/account/" . $photoName;

                if (move_uploaded_file($file_tmp, $uploadPath)) {
                    $uploadedFiles[$fileKey][] = $photoName;
                } else {
                    $errors[] = "Failed to upload $file_name.";
                }
            }
        }
    }

    if (!empty($errors)) {
        echo json_encode($errors);
        return false;
    }

    return $uploadedFiles[$fieldName][0] ?? false;
}

function getUploadPath($fileKey) {
    $uploadPaths = [
        "accountPhoto" => "account",
        "userPhoto" => "student",
        "signature" => "student",
        "cor" => "student",
        "oldId" => "student",
        "oldIdBack" => "student",
        "aol" => "student"
    ];
    return $uploadPaths[$fileKey] ?? "other";
}
?>