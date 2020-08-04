<?php
require_once 'Views/backend/partitions/header.php';
?>
    <div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Category Form
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <form role="form"
                                  action="admin.php?controller=user&action=update&id=<?php echo $user['id'] ?>"
                                  method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="<?php echo $user['name'] ?>"
                                           name="name" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" value="<?php echo $user['email'] ?>"
                                           name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password"
                                           value="<?php echo $user['password'] ?>" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control m-bot15" name="role_id">
                                        <?php foreach ($roles as $key => $value) { ?>
                                            <?php if ($user['role_id'] == $value['id']) { ?>
                                                <option selected
                                                        value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                            <?php } else if ($_SESSION['role'] == 'manager') {
                                                if ($value['name'] == 'admin') {
                                                } else { ?>
                                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
                                            <?php } ?>
                                        <?php } ?>

                                    </select>
                                </div>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </form>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>
<?php
require_once 'Views/backend/partitions/footer.php';
?>