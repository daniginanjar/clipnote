<!DOCTYPE html>
<html>    
<?php $this->load->view('_partials/head.php') ?>
<body>
<?php $this->load->view('_partials/navbar.php') ?>

    <div class="container">
        

        <div class="col-md-12 col-xs-12" style="border-left-style: solid; background-color:#f2efef;">
            <div class="jumbotron">
                <h1>Admin Page</h1>      
                <p>welcome <?php echo $this->session->userdata('name'); ?></p>
            </div>

            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#demo">Create New User</button>
            <div id="demo" class="collapse">
                <h2>Create User</h2>
                <form action="<?= base_url('user/create') ?>" method="post">
                    <div class="form-group col-md-6 col-xs-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" required>
                    </div>
                    <div class="form-group col-md-6 col-xs-6">
                        <label for="username">User Name</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="User Name" required>
                    </div>            
                    <div class="form-group col-md-6 col-xs-6">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                    </div>                
                    <div class="form-group col-md-6 col-xs-6">
                        <label for="pwd">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group col-md-6 col-xs-6">                    
                        <label for="pwd">User Type</label>
                        <select class="form-control" id="usertype" name="usertype">
                            <option>CREATOR</option>
                            <option>SUPERADMIN</option>
                            <option>ADMINISTRATOR</option>
                            <option>SUPERUSER</option>
                            <option>USER</option>
                            <option>CUSTOMER</option>
                            <option>GUEST</option>                                                                    
                        </select>
                    </div>
                    
                    <div class="form-group col-md-6 col-xs-6">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                    
                </form>  
            </div>
            
                              
        </div>
            
        <div class="col-md-12 col-xs-12" style="border-left-style: solid; background-color:#f2efef;">
        
            <h2>User List</h2>
            
            <div class="table-responsive">          
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>                        
                        <th>User Name</th>
                        <th>Email</th>
                        <th>User Type</th>
                        <th>Active</th>                      
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['name'] ?></td>                            
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['type'] ?></td>
                            <td><?= $user['user_status'] ?></td>                            
                            <td>
                                <button class="btn-primary" onclick="edituser(<?php echo $user['id'] ?>)">
                                    <a href="<?= base_url('user/edit/'.$user['id']) ?>">Edit</a>
                                </button>
                                <button class="btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                                    Delete                                                       
                                </button>                                                                                    
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Launch demo modal
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" onclick="deleteuser(<?php echo $user['id'] ?>)">Yes</button>
                </div>
                </div>
            </div>
        </div>

        <h5 id="saveresult"></h5>
    
    </div>
    

<?php $this->load->view('_partials/footer.php') ?>
</body>
</html>

<?php $this->load->view('_partials/js.php') ?>