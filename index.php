<!DOCTYPE html>
<html>
    <head>
        <meta name="robots" content="noindex">
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="30">
        <title>Server(s) Status</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/bootstrap-theme.css" rel="stylesheet">
    </head>
    <body>
    	<div class="container">
    		<h3>Server(s) Status</h3>
    		<table class="table table-bordered" id="primary">
				<thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Domain</th>
                        <th class="text-center">IP</th>
                        <th class="text-center">Port</th>
                        <th class="text-center">Status</th>
                        <th class="text-center deleteMode" style="width:75px">Delete</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
			</table>
			<input id="editMode" type="button" value="Edit mode" checked="checked" class="btn btn-default pull-right" />
			<form class="form-inline" role="form" action="index.php" method="post">
				<div class="form-group">
					<input type="text" class="form-control" id="name" name="name" placeholder="Name">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" id="host" name="host" placeholder="Domain / IP">
				</div>
				<div class="form-group">
					<input type="text" size="5" class="form-control" id="port" name="port" placeholder="Port">
				</div>
				<button type="submit" class="btn btn-default" id="add-button">Add</button>
			</form>
    	</div>
    	<script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/app.js" type="text/javascript"></script>	
    </body>
</html>
