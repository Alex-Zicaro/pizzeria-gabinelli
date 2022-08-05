<?php

use App\Controller\{Utilisateurs, Controller , Images , Commentaires , Produits};

$produit = new Produits;

$categories = $produit->produit->selectCategories();

$produit->search();
// var_dump($_POST['search']);

?>


<div class="super_container margin-bot-10">
	
	<!-- Header -->
	
	

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1560918577/phone.png" alt=""></div>05.34.48.09.63  </div>
						
						<div class="top_bar_content ml-auto gauche">
							<div class="top_bar_menu">
							
							
								<ul class="standard_dropdown top_bar_dropdown">
									
									<li>
										<a href="produits" style="color: white" >Pizza<i class="fas fa-chevron-down"></i></a>
										<ul>

											<?php foreach($categories as $categorie): ?>
												<li><a href="produits?categorie=<?= $categorie['id'] ?>"><?= $categorie['nom_categ'] ?></a></li>
											<?php endforeach; ?>
										</ul>
									</li>
								</ul>

							</div>
							<div class="top_bar_user">
							<div>
							<ul class="standard_dropdown top_bar_dropdown">
									
									<li>
										<a href="profil" style="color: white" >Profil<i class="fas fa-chevron-down"></i></a>
										<ul>

											
												<li><a href="profil">Profil</a></li>
												<li><a href="accueil?deco=true">Deconnexion</a></li>
										</ul>
									</li>
								</ul>
								</div>
								<div><a href="panier" style="color: white">Panier</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="recherche" method="POST" class="header_search_form clearfix">
										<input type="search" name="search" required="required" id="search-bar" placeholder="Rechercher une pizza...">

										<input type="submit" name="" id="checkout-button" value="Rechercher"></input>
									</form>
								</div>
							</div>
						</div>
					</div>




						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		
		