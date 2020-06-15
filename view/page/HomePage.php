
	<!-- Introduction to the forum -->
	<div class="jumbotron px-0 pt-0 pb-2" style="text-align:center">
 		<img src="view/images/school-architecture.jpg" class="img-fluid" alt="Responsive image"/>
      	</div>


	<!-- Forum chart title with the school name-->
	<main role="main" class="container">
		<?php if (isset($_SESSION['login'])){

echo <<<VIEW
<div class="d-flex align-items-center bg-dark btn text-white bg-black rounded shadow-sm p-3 mb-2">

	<img src="view/images/school.png" width="40px" width="30" height="30" />

				<div class="">

						<h5 class="pl-3"> Forum de l'école élémentaire du lac de l'ours</h5>

				</div>
				<form class="topics justify-content-center" action="index.php" method="POST">
				<div class="col-md-2">
				<button class="btn btn btn-warning ml-0 my-sm-0" type="submit" name='task' value='ControllerTopics'>Index du forum</button>
				<!--	<input class="btn btn btn-warning ml-2 my-sm-0" name= 'task' value='ControllerTopics'type="submit"></input>-->
				</div>
			</form>
	<div class="ml-auto collapse">
	<form class="form-inline">

				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">

					<button class="btn btn-outline-light text-light my-2 my-sm-0" type="submit">Rechercher</button>
			</form>
	</div>
			</div>
VIEW;
					}
					?>


	<!-- Forum main chart -->
	<div class="mt-3 px-1 pt-3 pb-none bg-primary rounded shadow-sm">

        	<h4 class="border-bottom border-gray pb-2 mb-0 mx-1 text-center text-white">Direction</h4>

        	<table class="table rounded media text-muted pt-3">

 			<!-- First row of the chart -->
			<!-- One can play with the column-widths knowing that the total width of the table is 12 -->
			<form id="mainForm" action="index.php" method="POST">
	      <input type="hidden" id="mainFormTaskInput" name="task" />
				<div class="row border-bottom border-gray bg-light mx-1">
 				<div class="col-7">

					<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

					<p class="media-body pb-3 mb-0 lh-125">
					<strong class="d-block text-gray-dark pl-13"><a href="#" onclick="$('#mainFormTaskInput').val('Rules'); $('#mainForm').submit();">Règles du forum</a></strong>
					Avant que vous commenciez à commenter ou poster, lisez attentivement cette section.

					</p>

				</div>

				<div class="col-1">
					<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

					<p class="media-body pb-3 mb-0 lh-125">
					<strong class="d-block text-gray-dark text-center pr-2">4</strong>messages
					</p>
				</div>

				<div class="col-1">
					<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
					<a href="#"><img src="view/images/headmaster_icon.png" class="d-block text-center" width="50px" /></a>
				</div>

				<div class="col-3">
					<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

					<p class="media-body small pb-3 mb-0 lh-125">
					<a href="#"><strong class="d-block text-gray-dark">Guide pour poster</strong></a>
					par <a href="#"><span class="badge badge-danger">Headmaster</span> Mr. Grizzli</a>
					</p>
				</div>

			</div>

 			<!-- Second row of the chart -->
			<!-- One can play with the column-widths knowing that the total width of the table is 12 -->
			<div class="row border-bottom border-gray bg-white mx-1">
 				<div class="col-7">

					<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

					<p class="media-body pb-3 mb-0 lh-125">
					<strong class="d-block text-gray-dark pl-13"><a href="#" onclick="$('#mainFormTaskInput').val('Actus'); $('#mainForm').submit();">Actualités</a></strong>
					Découvrez toutes les nouveautés de l'école.
					</p>

				</div>

				<div class="col-1">
					<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

					<p class="media-body pb-3 mb-0 lh-125">
					<strong class="d-block text-gray-dark text-center">13</strong>messages
					</p>
				</div>

				<div class="col-1">
					<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
					<a href="#"><img src="view/images/headmaster_icon.png" class="d-block" width="50px" /></a>
				</div>

				<div class="col-3">
					<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

					<p class="media-body small pb-3 mb-0 lh-125">
					<a href="#"><strong class="d-block text-gray-dark">Un ours pour tous à Noël</strong></a>
					par <a href="#"><span class="badge badge-danger">Headmaster</span> Mr. Grizzli</a>
					</p>
				</div>

			</div>

 			<!-- Third row of the chart -->
			<!-- One can play with the column-widths knowing that the total width of the table is 12 -->
			<div class="row border-bottom border-gray bg-light mx-1">
 				<div class="col-7">

					<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

					<p class="media-body pb-3 mb-0 lh-125">
					<strong class="d-block text-gray-dark pl-13"><a href="#" onclick="$('#mainFormTaskInput').val('Contact'); $('#mainForm').submit();">Contacter un administrateur</a></strong>
					Si vous faites face à un problème technique, s'il vous plaît dites le nous ici.
					</p>

				</div>

				<div class="col-1">
					<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

					<p class="media-body pb-3 mb-0 lh-125">
					<strong class="d-block text-gray-dark text-center">2</strong>messages
					</p>
				</div>

				<div class="col-1">
					<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
					<a href="#"><img src="view/images/technician_icon.png" class="d-block" width="50px" /></a>
				</div>

				<div class="col-3">
					<img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">

					<p class="media-body pb-3 mb-0 lh-125 small">
					<a href="#"><strong class="d-block text-gray-dark">Quand reporter un problème technique ?</strong></a>
					par <a href="#"><span class="badge badge-warning">Technicien</span></a>
					</p>
				</div>

			</div>

       </div>
		 </div>
	</form>
		<!-- To see more posts, you need to log in -->
         	<small class="d-block text-right mt-3 pb-0">

			<a class="text-white" href="index.php">Voir tout</a>

		</small>
		</table>
	</div>

	<br />
	<br />
