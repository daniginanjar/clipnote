<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">

      <?php 
      
      if($this->session->userdata('access')=='Creator'){

      ?>

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>clipnote"><span class="glyphicon glyphicon-home"></span> Clipnote</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">        
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin Page<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>user">User Management</a></li>
            <li><a href="#">Authority Management</a></li>            
          </ul>
        </li>
        <li><a href="<?php echo base_url(); ?>clipnote">Notes</a></li>        
      </ul>
      <ul class="nav navbar-nav navbar-right">                
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('name'); ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Password Change</a></li>                      
            <li><a href="<?php echo base_url(); ?>auth/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>           
          </ul>
        </li>
        
      </ul>
    </div>

      <?php

        } else {

      ?>
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>clipnote"><span class="glyphicon glyphicon-home"></span> Clipnote</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">      
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="<?php echo base_url(); ?>clipnote"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>

      <?php
        
        }
      
      ?>

  </div>
</nav>

<br>
<br>

