<html>
  <?php $this->load->view('_partials/head.php') ?>
  <body>

  <?php $this->load->view('_partials/navbar.php') ?>

  

  <div class="container"> 
  <br>
  <br>
  <br>
  <br>
  <br>
  
    <div class="w3-container">
        <!-- <div class="w3-row">
            <div class="w3-col" style="width:30%"><p></p></div>
            <div class="w3-col" style="width:40%">
                <div class="w3-card-4">
                    <div class="w3-container w3-blue">
                        <h2>Silahkan Login</h2>
                    </div>
                    <form class="w3-container" method="POST" action="<?php echo site_url('auth/autentikasi');?>">
                        <p>      
                            <label class="w3-text-blue"><b>Email</b></label>
                            <input class="w3-input w3-border w3-sand" name="email" type="email">
                        </p>
                        <p>      
                            <label class="w3-text-blue"><b>Password</b></label>
                            <input class="w3-input w3-border w3-sand" name="pass" type="password">
                        </p>
                        <p>
                            <button class="w3-btn w3-blue">Masuk</button>
                        </p>
                    </form>
                </div>
                <div class="w3-panel w3-blue w3-display-container">
                    <?php echo $this->session->flashdata('msg');?>
                </div>                  
            </div>
            <div class="w3-col" style="width:30%"><p></p></div>
        </div> -->

        

        <form method="POST" action="<?php echo site_url('auth/autentikasi');?>">
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="pass" class="form-control" id="pass" placeholder="Password">
        </div>
        <div class="checkbox">
            <label><input type="checkbox"> Remember me</label>
        </div>
        <button type="submit" class="btn btn-default">Login</button>
        </form>
        <div id="loginmessage">
            <?php echo $this->session->flashdata('msg');?>
        </div> 

    </div>
 </body>
</html>

<?php $this->load->view('_partials/js.php') ?>
