<html>
  <?php $this->load->view('_partials/head.php') ?>
  <body>

  <?php $this->load->view('_partials/navbar.php') ?>

  

  <div class="container"> 
    <br />
    <br />
    <br />
    
    <div class="row">

        <div class="col-md-6 col-xs-6">
            <?php if($this->session->flashdata('message_login_error')): ?>
                <div class="invalid-feedback">
                        <?= $this->session->flashdata('message_login_error') ?>
                </div>
            <?php endif ?>

            <h1>Login</h1>	
            <form action="/action_page.php" method="post">
                <div class="form-group">
                    <label for="name">Email/Username</label>
                    <input type="text" name="username" value="<?= set_value('username') ?>" required class="form-control" id="username">
                    <div class="invalid-feedback">
                        <?= form_error('username') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password*</label>
                    <input type="password" name="password" value="<?= set_value('password') ?>" required class="form-control" id="password">
                    <div class="invalid-feedback">
                        <?= form_error('password') ?>
                    </div>
                </div>
                <div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                </div>
                
                <input type="submit" class="button button-primary" value="Login">
            </form>

        </div>
        <div class="col-md-6 col-xs-6">
            <img src="https://media.istockphoto.com/id/1426988809/photo/security-password-login-online-concept-hands-typing-and-entering-username-and-password-of.webp?b=1&s=170667a&w=0&k=20&c=AJD5Wv30lmyILccJyMpQGhkmh0VhZ5WNDtk53MO1OVM=" class="img-rounded" alt="Cinque Terre">
        </div>

        	

		

    </div>
  </div>
 </body>
</html>

<?php $this->load->view('_partials/js.php') ?>
