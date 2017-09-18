<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>SSA</title>
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
	<div class="row" >
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
				</div>
				<div class="card-body">
					<form id="forms">
						<div id="fb-render"></div>
							<button type="submit" id="subir1" name="subir1">guardar</button>
					</form>
					<form id="test">
					<div id="fb-editor"></div>
					<button type="submit" id="subir" name="subir">guardar</button>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="http://formbuilder.online/assets/js/form-builder.min.js"></script>
<script src="<?php echo base_url(); ?>js/form-render.min.js"></script>
<script>
jQuery(function($) {
	$(document.getElementById('fb-editor')).formBuilder();
	/*$('#test').submit(function () {
            var data = new FormData($('#test')[0]);
						alert(""+data);
            $.ajax({
                type: 'POST',
                url: '/api/form',
                data: data,
                contentType: false,
                processData: false,
                cache: false
            });
        }); */
});
jQuery(document).ready(function($) {
  var fbRender = document.getElementById('fb-render'),
    formData = '[{"type":"text","label":"Text Field","className":"form-control","name":"text-1478701075825"},{"type":"select","label":"Select","className":"form-control","name":"select-1478701076382","values":[{"label":"Option 1","value":"option-1","selected":true},{"label":"Option 2","value":"option-2"},{"label":"Option 3","value":"option-3"}]},{"type":"textarea","label":"Text Area","className":"form-control","name":"textarea-1478701077511"}]';

  var formRenderOpts = {
    formData: formData
  };
  $(fbRender).formRender(
		{
	      formData: '[{"type":"text","label":"Text Field","className":"form-control","name":"text-1478701075825"},{"type":"select","label":"Select","className":"form-control","name":"select-1478701076382","values":[{"label":"Option 1","value":"option-1","selected":true},{"label":"Option 2","value":"option-2"},{"label":"Option 3","value":"option-3"}]},{"type":"textarea","label":"Text Area","className":"form-control","name":"textarea-1478701077511"}]', // This is data you stored in database when you build the form
	      dataType: 'json'
	    }
	);
});
$('#forms').on('submit', function (e) {
  e.preventDefault();
// Collect form data
  var formData = $(this).serialize();
	alert(formData);
// Send data to server
  $.post('save-form.php', formData)
      .done(function (response) {
        console.log('form saved')
      }).fail(function (jqXHR) {
    console.log('form was not saved')
  });
  return false;
});

</script>
</html>
