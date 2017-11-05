<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SSA - COMPLETADO</title>
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/tec.ico">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <meta name="description" content="">
  <meta name="author" content="Fernando Manuel Avila Cataño">
  <meta name="theme-color" content="##FFFFFF">
  <meta name="msapplication-navbutton-color" content="##FFFFFF">
  <meta name="apple-mobile-web-app-status-bar-style" content="white">
  <link href="<?php echo base_url(); ?>css/bootstrap.min.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/font-awesome.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/animate.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/ssa.css" type="text/css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>css/fontello.css" type="text/css" rel="stylesheet" />
</head>
<body>
  <?php $this->load->view('include/banner'); ?>
  <div class="row" style="margin-right: 0px; margin-left: 0px;">
    <div class="col-lg-4 col-xl-3"> </div>
    <div class="col-lg-4 col-xl-6">
      <div class="card panelCompletado animated bounceInDown">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-4 col-xl-6">
              <center>
                <img class="img-fluid"  src="http://www.ittepic.edu.mx/images/escudo_itt_grande.png" alt="Instituto Tecnológico de Tepic" />
              </center>
            </div>
            <div class="col-lg-4 col-xl-6">
              <center>
                <i class="fa fa-check-circle colorCompletado animated tada infinite " aria-hidden="true"></i> <br>
                <h2>Seguimiento en el  aula </h2>  <br> <h3><i>Completado</i></h3>  <br> <h6>Gracias por participar.</h6>
              </center>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xl-3"> </div>
      </div>
    </div>
    <canvas id="canvas" width="1147" height="487"></canvas>
    <?php $this->load->view('include/footer'); ?>
  </body>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/tether.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
  <script>
  var livePatern = {
    canvas: null,
    context: null,
    cols: 0,
    rows: 0,
    colors: [252, 251, 249, 248, 241, 240],
    triangleColors: [],
    destColors: [],
    init: function(){
      this.canvas = document.getElementById('canvas');
      this.context = this.canvas.getContext('2d');
      this.cols = Math.floor(document.body.clientWidth / 24);
      this.rows = Math.floor(document.body.clientHeight / 24) + 1;
      this.canvas.width = document.body.clientWidth;
      this.canvas.height = document.body.clientHeight;
      this.drawBackground();
      this.animate();
    },
    drawTriangle: function(x, y, color, inverted){
      inverted = inverted == undefined ? false : inverted;
      this.context.beginPath();
      this.context.moveTo(x, y);
      this.context.lineTo(inverted ? x - 22 : x + 22, y + 11);
      this.context.lineTo(x, y + 22);
      this.context.fillStyle = "rgb("+color+","+color+","+color+")";
      this.context.fill();
      this.context.closePath();
    },
    getColor: function(){
      return this.colors[(Math.floor(Math.random() * 6))];
    },
    drawBackground: function(){
      var eq = null;
      var x = this.cols;
      var destY = 0;
      var color, y;
      while(x--){
        eq = x % 2;
        y = this.rows;
        while(y--){
          destY = Math.round((y-0.5) * 24);

          this.drawTriangle(x * 24 + 2, eq == 1 ? destY : y * 24, this.getColor());
          this.drawTriangle(x * 24, eq == 1 ? destY  : y * 24, this.getColor(), true);
        }
      }
    },
    animate: function(){
      var me = this;
      var x = Math.floor(Math.random() * this.cols);
      var y = Math.floor(Math.random() * this.rows);
      var eq = x % 2;
      if (eq == 1) {
        me.drawTriangle(x * 24, Math.round((y-0.5) * 24) , this.getColor(), true);
      } else {
        me.drawTriangle(x * 24 + 2, y * 24, this.getColor());
      }
      setTimeout(function(){
        me.animate.call(me);
      }, 10);
    },
  };
  !function(){livePatern.init();}()
  </script>
  </html>
