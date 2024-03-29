<?php
require_once 'config/config-session.php';

try {
	require_once 'config/db.inc.php';
	require_once 'config/models/admin.list.model.php';

	$result = getAllAdmins($pdo);
	$_SESSION["result"] = $result;

	require_once 'config/views/admin.list.view.php';
} catch (PDOException $e) {
	die("Could not connect. " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>User List</title>
	<style>
		body {
			background-color: #f8f9fa !important
		}

		.p-4 {
			padding: 1.5rem !important;
		}

		.mb-0,
		.my-0 {
			margin-bottom: 0 !important;
		}

		.shadow-sm {
			box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
		}

		/* user-dashboard-info-box */
		.user-dashboard-info-box .candidates-list .thumb {
			margin-right: 20px;
		}

		.user-dashboard-info-box .candidates-list .thumb img {
			width: 80px;
			height: 80px;
			-o-object-fit: cover;
			object-fit: cover;
			overflow: hidden;
			border-radius: 50%;
		}

		.user-dashboard-info-box .title {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			padding: 30px 0;
		}

		.user-dashboard-info-box .candidates-list td {
			vertical-align: middle;
		}

		.user-dashboard-info-box td li {
			margin: 0 4px;
		}

		.user-dashboard-info-box .table thead th {
			border-bottom: none;
		}

		.table.manage-candidates-top th {
			border: 0;
		}

		.user-dashboard-info-box .candidate-list-favourite-time .candidate-list-favourite {
			margin-bottom: 10px;
		}

		.table.manage-candidates-top {
			min-width: 650px;
		}

		.user-dashboard-info-box .candidate-list-details ul {
			color: #969696;
		}

		/* Candidate List */
		.candidate-list {
			background: #ffffff;
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			border-bottom: 1px solid #eeeeee;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			padding: 20px;
			-webkit-transition: all 0.3s ease-in-out;
			transition: all 0.3s ease-in-out;
		}

		.candidate-list:hover {
			-webkit-box-shadow: 0px 0px 34px 4px rgba(33, 37, 41, 0.06);
			box-shadow: 0px 0px 34px 4px rgba(33, 37, 41, 0.06);
			position: relative;
			z-index: 99;
		}

		.candidate-list:hover a.candidate-list-favourite {
			color: #e74c3c;
			-webkit-box-shadow: -1px 4px 10px 1px rgba(24, 111, 201, 0.1);
			box-shadow: -1px 4px 10px 1px rgba(24, 111, 201, 0.1);
		}

		.candidate-list .candidate-list-image {
			margin-right: 25px;
			-webkit-box-flex: 0;
			-ms-flex: 0 0 80px;
			flex: 0 0 80px;
			border: none;
		}

		.candidate-list .candidate-list-image img {
			width: 80px;
			height: 80px;
			-o-object-fit: cover;
			object-fit: cover;
		}

		.candidate-list-title {
			margin-bottom: 5px;
		}

		.candidate-list-details ul {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			margin-bottom: 0px;
		}

		.candidate-list-details ul li {
			margin: 5px 10px 5px 0px;
			font-size: 13px;
		}

		.candidate-list .candidate-list-favourite-time {
			margin-left: auto;
			text-align: center;
			font-size: 13px;
			-webkit-box-flex: 0;
			-ms-flex: 0 0 90px;
			flex: 0 0 90px;
		}

		.candidate-list .candidate-list-favourite-time span {
			display: block;
			margin: 0 auto;
		}

		.candidate-list .candidate-list-favourite-time .candidate-list-favourite {
			display: inline-block;
			position: relative;
			height: 40px;
			width: 40px;
			line-height: 40px;
			border: 1px solid #eeeeee;
			border-radius: 100%;
			text-align: center;
			-webkit-transition: all 0.3s ease-in-out;
			transition: all 0.3s ease-in-out;
			margin-bottom: 20px;
			font-size: 16px;
			color: #646f79;
		}

		.candidate-list .candidate-list-favourite-time .candidate-list-favourite:hover {
			background: #ffffff;
			color: #e74c3c;
		}

		.candidate-banner .candidate-list:hover {
			position: inherit;
			-webkit-box-shadow: inherit;
			box-shadow: inherit;
			z-index: inherit;
		}

		.bg-white {
			background-color: #ffffff !important;
		}

		.p-4 {
			padding: 1.5rem !important;
		}

		.mb-0,
		.my-0 {
			margin-bottom: 0 !important;
		}

		.shadow-sm {
			box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
		}

		.user-dashboard-info-box .candidates-list .thumb {
			margin-right: 20px;
		}
	</style>
</head>

<body>
	<div class="container mt-3 mb-4">
		<div class="col-lg-9 mt-4 mt-lg-0">
			<div class="row">
				<div class="col-md-12">
					<div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
						<table class="table manage-candidates-top mb-0">
							<thead>
								<tr>
									<th>Admin Names</th>
									<th class="text-center">Status</th>
									<th class="action text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									viewAdminSample($_SESSION["result"]);
								?>
							</tbody>
						</table>
						<div class="text-center mt-3 mt-sm-3">
							<ul class="pagination justify-content-center mb-0">
								<li class="page-item disabled"> <span class="page-link">Prev</span> </li>
								<li class="page-item active" aria-current="page"><span class="page-link">1 </span> <span
										class="sr-only">(current)</span></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item"><a class="page-link" href="#">...</a></li>
								<li class="page-item"><a class="page-link" href="#">25</a></li>
								<li class="page-item"> <a class="page-link" href="#">Next</a> </li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>