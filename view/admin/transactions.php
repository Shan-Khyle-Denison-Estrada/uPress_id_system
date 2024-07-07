            <?php
            include_once("././model/transactionManageModel.php");
            $obj = new TransactionManageModel();
            $get = $obj->getAll();
            ?>

            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="row text-start py-3 px-2">
                        <div class="col-md-8 col-12 align-items-center d-flex justify-content-start">
                            <div class="card-header">
                                <h2>Client Transactions</h2>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 align-items-center d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#StudentModal">
                                <i class="fa-solid fa-circle-plus"></i> Student
                            </button>
                        </div>
                        <div class="col-md-12 col-12 align-items-center py-4 px-0 text-center d-flex justify-content-center"
                            style="width: 100%;">
                            <div class="table-responsive">
                                <table class="table caption-top table-striped table-hover" id="transactions"
                                    style="width: 100%;">
                                    <thead class="table-dark">
                                        <th scope="col">Client ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Transaction Type</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </thead>
                                    <tbody class="table-group-divider" id="">
                                        <?php
                                            if ($get) {
                                                foreach ($get as $item) {
                                         ?>
                                        <tr>
                                            <td class="clientID" style="width: 40px;"><?= $item['client_id'] ?></td>
                                            <td style="max-width: 60px; overflow: hidden; text-overflow: ellipsis;"
                                                title="<?= $item['firstName']." ".$item['middleName']." ".$item['lastName']." ".$item['nameExt'] ?>">
                                                <?= strlen($item['firstName']." ".$item['middleName']." ".$item['lastName']." ".$item['nameExt']) > 15 ?
                                                substr($item['firstName']." ".$item['middleName']." ".$item['lastName']." ".$item['nameExt'], 0, 15) . '...' :
                                                $item['firstName']." ".$item['middleName']." ".$item['lastName']." ".$item['nameExt'] ?>
                                            </td>
                                            <td><?= $item['clientType'] ?></td>
                                            <td><?= $item['formType'] ?></td>
                                            <td style="width: 80px !important;"><?= $item['createdAt'] ?></td>
                                            <td>
                                                <?php
                                                    if ($item['status'] == 0) {
                                                        $item['status'] = 'Pending';
                                                    } else if ($item['status'] == 1) {
                                                        $item['status'] = 'Completed';
                                                    }
                                                ?>
                                                <span
                                                    class="badge text-bg-<?= $item['status'] == 'Completed' ? 'success' : 'danger' ?>">
                                                    <?= $item['status'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <a href="#" title="View"
                                                            class=" btn btn-info btn-cirlce btn-sm">
                                                            <i class="fa-solid fa-eye" style="padding: 0;"></i>
                                                        </a>
                                                        <a href="#" title="Edit"
                                                            class=" btn btn-success btn-cirlce btn-sm">
                                                            <i class="fa-solid fa-pen-to-square"
                                                                style="padding: 0;"></i>
                                                        </a>
                                                        <a href="#" title="Edit"
                                                            class=" btn btn-danger btn-cirlce btn-sm">
                                                            <i class="fa-solid fa-trash" style="padding: 0;"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                                }   
                                            } else {
                                        ?>
                                        <tr>
                                            <td colspan="9" class="text-center">No data available</td>
                                        </tr>
                                        <?php
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
            <!-- Add Modal -->
            <div class="modal fade" id="StudentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-2" id="staticBackdropLabel">Student Info</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" id="addStudent" enctype="multipart/form-data">
                            <div class="modal-body" style="max-height: calc(100vh - 200px); overflow-y: auto;">
                                <div class="row container-fluid">
                                    <h6>Enter your basic information correctly</h6>
                                    <!-- Radio Buttons -->
                                    <div
                                        class="container-fluid d-flex flex-row justify-content-center align-content-center m-0 py-2 gap-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="formType" value="New"
                                                id="new" checked onclick="text(0)">
                                            <label class="form-check-label ps-2" for="new">New</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="formType"
                                                value="Replacement" id="rep" onclick="text(1)">
                                            <label class="form-check-label ps-2" for="rep">Replacement</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="formType" value="Lost"
                                                id="lost" onclick="text(2)">
                                            <label class="form-check-label ps-2" for="lost">Lost</label>
                                        </div>
                                    </div>
                                    <!-- Radio Buttons End -->
                                    <div>
                                        <label for="">Student Number</label>
                                        <input type="text" name="studnum" id="studId" placeholder="e.g. 2021-00398"
                                            required>
                                    </div>
                                    <div>
                                        <label for="">WMSU Email</label>
                                        <input type="text" name="wmsuEmail" id="wmsuEmail"
                                            placeholder="e.g. qb202100398@wmsu.edu.ph" required>
                                    </div>
                                    <div>
                                        <label for="">First Name</label>
                                        <input type="text" name="firstName" id="fname" placeholder="e.g. Angelo John"
                                            required>
                                    </div>
                                    <div>
                                        <label for="">Middle Name</label>
                                        <input type="text" name="middleName" id="mname" placeholder="e.g. Sinsuan">
                                    </div>
                                    <div>
                                        <label for="">Family Name</label>
                                        <input type="text" name="familyName" id="famname" placeholder="e.g. Landiao"
                                            required>
                                    </div>
                                    <div>
                                        <label for="">Name Ext.</label>
                                        <input type="text" name="nameExt" id="ext" placeholder="e.g. Sr./Jr.">
                                    </div>
                                    <div>
                                        <label for="">Program/Strand</label>
                                        <select class="js-example-theme-single" name="programs" id="select-program">
                                            <option value="">Select a program</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="addStud" id="add" class="btn btn-primary">Add
                                    Student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- edit modal -->
            <div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="editAccountForm" method="post" action="" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editAccountModalLabel">Edit Account</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="editId" name="id">
                                <div class="mb-3">
                                    <label for="editUname" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="editUname" name="uname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editPw" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="editPw" name="pw" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editFname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="editFname" name="fname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editMname" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="editMname" name="mname">
                                </div>
                                <div class="mb-3">
                                    <label for="editLname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="editLname" name="lname" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editNameExt" class="form-label">Name
                                        Extension</label>
                                    <input type="text" class="form-control" id="editNameExt" name="nameExt">
                                </div>
                                <div class="mb-3">
                                    <label for="editRole" class="form-label">Role</label>
                                    <input type="text" class="form-control" id="editRole" name="role" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editAccountPhoto" class="form-label">Account
                                        Photo</label>
                                    <input type="file" class="form-control" id="editAccountPhoto" name="accountPhoto[]"
                                        accept="image/*">
                                </div>
                                <!-- <input type="hidden" name="type" value="save"> -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="save">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
$(document).ready(function() {
    var table = $('#transactions').DataTable({
        // dom: 'Bfrtip',
        layout: {
            topStart: {
                buttons: [
                    'copy', 'csv', 'pdf'
                ]
            }
        }
    });

    // $('#addAccountModal .js-example-basic-single').select2({
    //     placeholder: 'Select An Option',
    //     dropdownParent: $('#addAccountModal')
    // });
    // // Initialize Select2 for Edit Account Modal
    // $('#editAccountModal .js-example-basic-single').select2({
    //     placeholder: 'Select An Option',
    //     dropdownParent: $('#editAccountModal')
    // });

    $(document).on('submit', '#addStudent', function(e) {
        e.preventDefault();
        var formdata = new FormData(this);
        formdata.append("type", "addStud");
        console.log(formdata);

        $.ajax({
            method: 'post',
            url: "transactionController.php",
            data: formdata,
            contentType: false,
            processData: false,
            success: function(data) {
                alert('Form submitted successfully');
                $("#studId").val("");
                $("#wmsuEmail").val("");
                $("#fname").val("");
                $("#mname").val("");
                $("#famname").val("");
                $("#ext").val("");
                $("#select-program").val("");
                $("#fnameEmg").val("");
                $("#mnameEmg").val("");
                $("#famnameEmg").val("");
                $("#extEmg").val("");
                $("#addEmg").val("");
                $("#contactEmg").val("");
                $("#userPhoto").val("");
                $("#signature").val("");
                $("#cor").val("");
                $("#frontId").val("");
                $("#backId").val("");
                $("#affidavit").val("");
            },
            error: function(error) {
                console.log(error);
                alert('Error submitting form');
            }
        });
    });
});
            </script>
            <!-- <script>
$(document).ready(function() {
    $('#addAccount').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("type", "add"); // Add the additional field
        console.log(formData);
        $.ajax({
            type: 'POST',
            url: '/add-account',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // console.log(response);
                alert('Account Created Successfully');
                $("#uname").val("");
                $("#pw").val("");
                $("#fname").val("");
                $("#mname").val("");
                $("#lname").val("");
                $("#nameExt").val("");
                $("#role").val("");
                $("#accountPhoto").val("");

                $('#addAccountModal').modal('hide');
            },
            error: function(error) {
                console.log(error);
                alert('Error submitting form');
            }
        });
    });

    $(document).on('click', '.edit-btn', function(e) {
        e.preventDefault();

        var selectedID = $(this).closest('tr').find('.accID').text();
        console.log(selectedID);

        var formData = new FormData();
        formData.append("type", "save");
        formData.append('accId', selectedID);

        $.ajax({
            type: 'POST',
            url: '/edit-account',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
            }
        });
    });

    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var id = $(this).data('id');

        if (confirm('Are you sure you want to delete this account?')) {
            var formData = new FormData();
            formData.append('id', id);
            formData.append('type', 'delete');
            $.ajax({
                url: 'del-account',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    var res = JSON.parse(response);
                    if (res.success) {
                        alert('Account deleted successfully');
                        // location.reload();
                        row.remove();
                    } else {
                        alert('Failed to delete account: ' +
                            res.message
                        ); // Log the specific error message
                    }
                },
                error: function() {
                    alert(
                        'Error occurred while deleting the account');
                }
            });
        }
    });
});
            </script> -->