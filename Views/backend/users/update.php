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
                            <form role="form" action="admin.php?controller=user&action=update&id=<?php echo $user['id'] ?>" method="post">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" value="<?php echo $user['name'] ?>" name="name"  placeholder="User name ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" value="<?php echo $user['email'] ?>" name="email"  placeholder="User name ">
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