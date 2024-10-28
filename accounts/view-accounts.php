<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Accounts</h4>
            </div>
        </div>
    </div>

    <div class="modal-container"></div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                        <?php
                            require_once '../classes/account.class.php';
                            session_start();
                            $productObj = new Account();
                        ?>
                          
                        <div class="page-title-right d-flex align-items-center"> 
                            <a id="add-account" href="#" class="btn btn-primary brand-bg-color">Add Account</a>
                        </div>
                    </div>      

                    <div class="table-responsive">
                        <table id="table-accounts" class="table table-centered table-nowrap mb-0">
                            <thead class="table-light">
                            <?php
                                require_once '../classes/account.class.php';

                                $productObj = new Account();
                             ?>
                                <tr>
                                    <th class="text-start">No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $accountObj = new Account();

                                $i = 1;
                                $array = $accountObj->getAll();

                                foreach ($array as $arr) {
                                ?>
                                    <tr>
                                        <td class="text-start"><?= $i ?></td>
                                        <td><?= $arr['first_name'] ?></td>
                                        <td><?= $arr['last_name'] ?></td>
                                        <td><?= $arr['username'] ?></td>
                                        <td><?= $arr['role'] ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
