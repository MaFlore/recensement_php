<?php 
    session_start();

    include_once("../connexion.php");
    
    try{
        $liste_admins=$connexion_bd->query("SELECT * FROM administrateur ");
    }
    catch(Exception $e){
        print_r($e);
    }

    

?>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Listes des admins</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="../assets/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../assets/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../assets/vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="../assets/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../assets/vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../assets/vendors/images/deskapp-logo.svg" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>

	<?php
        include('entete.php')
    ?>

	<?php 
        include('menu2.php')
    ?>

	<div class="mobile-menu-overlay"></div>
    <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10">
            <div class="min-height-200px">
                <div class="page-header">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="title">
                                <h4>Adminstrateurs</h4>
                            </div>
                            <nav aria-label="breadcrumb" role="navigation">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Adminstrateurs</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Listes des admins</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- basic table  Start -->
                <div class="pd-20 card-box mb-30">
                    <div class="clearfix mb-20">
                        <div class="pull-right">
                            <a href="ajout_admin.php" class="btn btn-primary btn-sm scroll-click">Ajouter</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prenom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Adresse</th>
                                <th scope="col">Profil</th>
                                <th scope="col">CNI</th>
                                <th scope="col">Statut</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $ordre=0;
                            while($admin=$liste_admins->fetch()){
                                $ordre+=1;  
                            ?>
                            <tr>
                                <th scope="row"><?php echo $ordre;?></th>
                                <td><?php echo $admin['nom']?></td>
                                <td><?php echo $admin['prenom']?></td>
                                <td><?php echo $admin['email']?></td>
                                <td><?php echo $admin['telephone']?></td>
                                <td><?php echo $admin['adresse']?></td>
                                <td><?php echo $admin['profil']?></td>
                                <td><?php echo $admin['cni']?></td>
                                <?php 
                                    if ($admin['statut'] == true) 
                                    echo '<td><span class="badge badge-primary">Actif</span></td>'
                                ?>
                                <?php 
                                    if ($admin['statut'] == false) 
                                    echo '<td><span class="badge badge-warning">Inactif</span></td>'
                                ?>
                                <td>
                                    <a href="modification_admin.php?id=<?=$admin['id']?>" class="btn btn-warning btn-sm scroll-click"><i class="icon-copy dw dw-edit-1"></i></a>
                                    <a href="../models/suppression_admin_bd.php?id=<?=$admin['id']?>" data-toggle="modal" data-target="#Medium-modal" type="button" class="btn btn-danger btn-sm scroll-click"><i class="icon-copy dw dw-trash"></i></a>
                                    <div class="modal fade" id="Medium-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">Suppression d'un administrateur</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Cette action est irréversible</p>
                                                    <p>Vous êtes de vouloir supprimer cet administrateur</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Non</button>
                                                    <button type="button" class="btn btn-danger">Oui</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
        </div>
    </div>
	<!-- js -->
	<script src="../assets/vendors/scripts/core.js"></script>
	<script src="../assets/vendors/scripts/script.min.js"></script>
	<script src="../assets/vendors/scripts/process.js"></script>
	<script src="../assets/vendors/scripts/layout-settings.js"></script>
	<script src="../assets/src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="../assets/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="../assets/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="../assets/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="../assets/vendors/scripts/dashboard.js"></script>
</body>
</html>