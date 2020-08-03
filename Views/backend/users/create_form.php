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
                        <form role="form" action="admin.php?controller=user&action=store" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label >Name</label>
                                <input type="text" class="form-control" name="name"  placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label >Email</label>
                                <input type="email" class="form-control" name="email"  placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label >Password</label>
                                <input type="password" class="form-control" name="password"  placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control m-bot15" name="role_id">
                                    <?php foreach ($roles as $key => $value) { ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></option>
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