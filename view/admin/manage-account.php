            <?php
            // var_dump($getAcc);
            require_once("././model/accountManageModel.php");
            if(isset($_POST["save"])){

                $newAcc = new AccountManageModel();
                // sanitize
                $newAcc->username = htmlentities($_POST["uname"]);
                $newAcc->password = htmlentities($_POST["pw"]);
                $newAcc->firstName = htmlentities($_POST["fname"]);
                $newAcc->middleName = htmlentities($_POST["mname"]);
                $newAcc->lastName = htmlentities($_POST["lname"]);
                $newAcc->nameExt = htmlentities($_POST["nameExt"]);
                $newAcc->role = htmlentities($_POST["role"]);

                if($newAcc->addAccount()){
                    header('location: manage-account.php');
                }else{
                    echo'An error occured while adding in the database.';
                }
                
            }
            ?>
            <script>
                $('.js-example-basic-single').select2({
                    placeholder: 'Select An Option'
                    dropdownParent: '#addAccountModal'
                });
            </script>
            <!-- Modal -->
            <div class="modal fade" id="addAccountModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Admin Account Form</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="" id="addStudent">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="" class="form-label">Username</label>
                                    <input type="text" name="uname" class="form-control" placeholder="e.g. admin?">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" name="pw" class="form-control" placeholder="********">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">First name</label>
                                    <input type="text" name="fname" class="form-control" placeholder="e.g. Sanicare">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Middle name</label>
                                    <input type="text" name="mname" class="form-control" placeholder="e.g. Plastic">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Last name</label>
                                    <input type="text" name="lname" class="form-control" placeholder="e.g. Stem">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Name Ext.</label>
                                    <input type="text" name="nameExt" class="form-control" placeholder="e.g. Sr./Jr.">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Role</label>
                                    <select class="form-control js-example-basic-single" name="role" id="role" style="width: 100%;">
                                        <option value="">Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="super_admin">Super Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Insert your photo</label>
                                    <input class="form-control" type="file" id="formFile">
                                </div>
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="save" class="btn btn-primary">Save Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="row text-start py-3 px-2">
                        <div class="col-md-8 col-12 align-items-center d-flex justify-content-start">
                            <div class="card-header">
                                <h2>Account Management</h2>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 align-items-center d-flex justify-content-center">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addAccountModal">
                                Add Account
                            </button>
                        </div>
                        <div class="col-md-12 col-12 align-items-center py-4 px-0 text-center d-flex justify-content-center" 
                        style="width: 100%; height: 490px;">
                            <div class="table-responsive">
                                <table class="table caption-top table-striped table-hover" id="user">
                                    <caption>List of Admin Users</caption>
                                    <thead class="table-dark">
                                        <th scope="col">ID</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Photo</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date Added</th>
                                        <th scope="col">Action</th>
                                    </thead>
                                    <tbody class="table-group-divider" id="">
                                        <?php
                                        if($getAcc) {
                                            foreach($getAcc as $item) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $item['id'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['username'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['password'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['firstName']." ".$item['middleName']." ".$item['lastName']." ".$item['nameExt']  ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['role'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['accountPhoto'] ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if($item['status'] == 0) {
                                                            $item['status'] = "Active";
                                                        } else {
                                                            $item["status"] = "Inactive";
                                                        }
                                                        ?>
                                                        <?= $item['status'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $item['createdAt'] ?>
                                                    </td>
                                                    <td>
                                                        action
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>