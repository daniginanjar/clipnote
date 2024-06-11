<html>
<?php $this->load->view('_partials/head.php') ?>
<body>
<?php $this->load->view('_partials/navbar.php') ?>

    <div class="container mt-3" style="border-left-style: solid; background-color:#f2efef;"> 

        <div class="jumbotron">
            <h1>Login Page</h1>      
            <p>welcome to Clipnote</p>
        </div>

        

        <div class="col-md-6 col-xs-6" style="">
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
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
            <div id="loginmessage">
                <?php echo $this->session->flashdata('msg');?>
            </div> 
        </div> 
        
        <div class="col-md-6 col-xs-6" style="">
            <img style="height:200px" src="https://images.squarespace-cdn.com/content/v1/54341a03e4b08690c01bc8de/1561049223956-DWORH5YYMXO4H9G8K73X/login_banner.jpg?format=1500w" class="img-rounded" alt="Cinque Terre">
        </div>
    </div>

<?php $this->load->view('_partials/footer.php') ?>
</body>
</html>
<?php $this->load->view('_partials/js.php') ?>
