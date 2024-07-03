<?php
include_once("model/accountManageModel.php");
$newAcc = new AccountManageModel();

if (isset($_POST["type"])) {
    switch ($_POST["type"]) {
        case 'add':
            handleAddAccount($newAcc);
            break;
        case 'save':
            handleSaveAccount($newAcc);
            break;
        case 'delete':
            handleDeleteAccount($newAcc);
            break;
    }
}

function handleAddAccount($accountModel) {
    var_dump('est');
    $uname = htmlentities($_POST["uname"]);
    $pw = htmlentities($_POST["pw"]);
    $fname = htmlentities($_POST["fname"]);
    $middleName = htmlentities($_POST["mname"]);
    $lastName = htmlentities($_POST["lname"]);
    $nameExt = htmlentities($_POST["nameExt"]);
    $role = htmlentities($_POST["role"]);
    $img = uploadImage('accountPhoto');

    $addAcc = $accountModel->addAccount($uname, $pw, $fname, $middleName, $lastName, $nameExt, $role, $img);

    if ($addAcc) {
        setSessionMessage(true, "Account Created Successfully!", "Account Creation Failed!!");
    } else {
        setSessionMessage(false, "Account Created Successfully!", "Account Creation Failed!!");
    }
    

}

// function handleSaveAccount($accountModel) {
//     $conn = new PDOModel();
//     $db = $conn->getDb();

//     $id = $_POST['id'];
//     $fetch_acc = [];

//     try {
//         $stmt = $db->prepare("SELECT * FROM account WHERE id='$id'");
//         // $stmt->execute();
//         if(mysqli_num_rows($stmt) > 0) {
//             while($row = mysqli_fetch_array($stmt)){
//                 array_push($fetch_acc, $row);
//                 header('content-type: application/json');
//                 echo json_encode($fetch_acc);
//             }
//         }

//     } catch (PDOException $e) {
//         // Handle any errors
//         echo "Error: " . $e->getMessage();
//         return false;
//     }

    // $uname = htmlentities($_POST["uname"]);
    // $pw = htmlentities($_POST["pw"]);
    // $fname = htmlentities($_POST["fname"]);
    // $middleName = htmlentities($_POST["mname"]);
    // $lastName = htmlentities($_POST["lname"]);
    // $nameExt = htmlentities($_POST["nameExt"]);
    // $role = htmlentities($_POST["role"]);
    // $img = uploadImage('accountPhoto');

    // if ($img !== false) {
    //     $updateAcc = $accountModel->updateAccount($id, $uname, $pw, $fname, $middleName, $lastName, $nameExt, $role, $img);
    //     setSessionMessage($updateAcc, "Account Updated Successfully!", "Account Update Failed!!");
    // }
// }
function handleSaveAccount($accountModel) {
    $conn = new PDOModel();
    $db = $conn->getDb();

    $id = $_POST['id'];
    $fetch_acc = [];

    try {
        $stmt = $db->prepare("SELECT * FROM account WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $fetch_acc = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($fetch_acc);
        } else {
            echo json_encode(["message" => "No account found with ID: $id"]);
        }

    } catch (PDOException $e) {
        // Handle any errors
        echo json_encode(["error" => "Error: " . $e->getMessage()]);
        return false;
    }
}


function handleDeleteAccount($accountModel) {
    $id = $_POST['id'];
    $deleteAcc = $accountModel->softDeleteAccount($id);
    setSessionMessage($deleteAcc, "Account Deleted Successfully!", "Account Deletion Failed!!");
}

function setSessionMessage($success, $successMessage, $failureMessage) {
    $_SESSION['message'] = $success ? $successMessage : $failureMessage;
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