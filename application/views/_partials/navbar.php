<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      

      <?php 
      
      if($this->session->userdata('access')=='Creator'){

      ?>

      <div class="navbar-header">        
        <a class="navbar-brand" href="<?php echo base_url(); ?>clipnote"><span class="glyphicon glyphicon-home"></span> Clipnote</a>
      </div>

      <ul class="nav navbar-nav navbar-right">        
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('name'); ?></a></li>
        <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Password Change</a></li> 
        <li><a href="<?php echo base_url(); ?>user"><span class="glyphicon glyphicon-user"></span>Admin Page</a></li>                
        <li><a href="<?php echo base_url(); ?>auth/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>

      <?php

        } else {

      ?>

      <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo base_url(); ?>auth"><span class="glyphicon glyphicon-home"></span> Clipnote</a>
      </div>

      <ul class="nav navbar-nav navbar-right">               
        <li><a href="<?php echo base_url(); ?>auth"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>

      <?php
        
        }
      
      ?>

    </div>
  </nav>

  <br>
  <br>
  <br>
  <br>
  <br>