<?php
/**
 * The template for displaying content in the page.php template
 *
 * @package Catch Themes
 * @subpackage Catch Kathmandu
 * @since Catch Kathmandu 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if ( function_exists( 'catchkathmandu_content_image' ) ) : catchkathmandu_content_image(); endif; ?>
    
    <div class="entry-container">
    	<header class="entry-header">
    		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'catchkathmandu' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
        	<!-- Button trigger modal -->
            <div id="items">
                <div class="box panel panel-default">
                <a href="#tesoro" data-toggle="modal" style="color:#464646; text-decoration:none;">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/projects/thumbnails/tesoro.jpg">
                    <div class="panel-body">
                    	<h3 style="margin-bottom:0px;">El TESORO</h3><br>
                        <strong>Ubicación:</strong> Carrera 25 A # 1 A sur 45 Medellín <br>
                        <strong>Fecha de apertura:</strong> 1999
                    </div>
                </a>
                </div>
    
                <div class="box panel panel-default">
                <a href="#torre" data-toggle="modal" style="color:#464646; text-decoration:none;">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/projects/thumbnails/tesoro-torre.jpg">
                    <div class="panel-body">
                    	<h3 style="margin-bottom:0px;">TORRE MÉDICA (El Tesoro)</h3><br>
                        <strong>Ubicación:</strong> Carrera 25 A # 1 A sur 45 Medellín<br>
						<strong>Fecha de apertura:</strong> 2013
                    </div>
                </a>
                </div>
    
                <div class="box panel panel-default">
                <a href="#puerta" data-toggle="modal" style="color:#464646; text-decoration:none;">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/projects/thumbnails/blank.jpg">
                    <div class="panel-body">
                    	<h3 style="margin-bottom:0px;">PUERTA DEL NORTE</h3><br>
                       <strong>Ubicación:</strong> Diagonal 55 # 34- 67 Niquia - Bello<br>
                       <strong>Fecha de apertura:</strong> 2008
                    </div>
                </a>
                </div>
    
                <div class="box panel panel-default">
                <a href="#florida" data-toggle="modal" style="color:#464646; text-decoration:none;">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/projects/thumbnails/florida.jpg">
                    <div class="panel-body">
                        <h3 style="margin-bottom:0px;">FLORIDA</h3><br>
                        <strong>Ubicación:</strong> Ubicación: Calle 71 # 65 – 150  Medellín<br>
						<strong>Fecha de apertura:</strong> 2013
                    </div>
                </a>
                </div>
                <div class="box panel panel-default">
                <a href="#uraba" data-toggle="modal" style="color:#464646; text-decoration:none;">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/projects/thumbnails/nuestro.jpg">
                    <div class="panel-body">
                       	<h3 style="margin-bottom:0px;">NUESTRO URABA</h3><br>
                        <strong>Ubicación:</strong> KM 100 Apartado - Urabá<br>
						<strong>Fecha de apertura:</strong> 2015
                    </div>
                </a>
                </div>
            </div>
            
            <!-- Modal TESORO -->
            <div class="modal fade bs-example-modal-lg" id="tesoro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">EL TESORO</h4>
                  </div>
                  <div class="modal-body">
                  	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        <div class="item active">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/tesoro.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/tesoro2.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/tesoro3.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/tesoro4.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/tesoro5.jpg">
                        </div>
                      </div>
                    
                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      </a>
                    </div>
                    <br>
                    <p>
                        <strong>Ubicación:</strong> Carrera 25 A # 1 A sur 45 Medellín <br>
                        <strong>Fecha de apertura:</strong> 1999<br>
						<strong>Descripción:</strong> Ancla Carulla, Cines Cinemark y juegos infantiles Happy City
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div><!-- Modal -->
            
            <!-- Modal TORRE -->
            <div class="modal fade bs-example-modal-lg" id="torre" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">TORRE MÉDICA (El Tesoro)</h4>
                  </div>
                  <div class="modal-body">
                    <div id="carousel-example-generic2" class="carousel2 slide" data-ride="carousel">
                    
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        <div class="item active">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/torre.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/torre2.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/torre3.jpg">
                        </div>
                        </div>
                      </div>
                    
                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic2" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic2" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      </a>
                    </div>
                    <br>
                    <p>
                        <strong>Ubicación:</strong> Carrera 25 A # 1 A sur 45 Medellín <br>
                        <strong>Fecha de apertura:</strong> 2013<br>
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div><!-- Modal -->
            
            <!-- Modal PUERTA -->
            <div class="modal fade bs-example-modal-lg" id="puerta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">PUERTA DEL NORTE</h4>
                  </div>
                  <div class="modal-body">
                    <p>
                        <strong>Ubicación:</strong> Diagonal 55 # 34- 67 Niquia - Bello  <br>
                        <strong>Fecha de apertura:</strong> 2008<br>
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div><!-- Modal -->
            <!-- Modal FLORIDA -->
            <div class="modal fade bs-example-modal-lg" id="florida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">FLORIDA PLAZA</h4>
                  </div>
                  <div class="modal-body">
                    <div id="carousel-example-generic3" class="carousel3 slide" data-ride="carousel">
                    
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        <div class="item active">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/florida.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/florida2.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/florida3.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/florida4.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/florida5.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/florida6.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/florida7.jpg">
                        </div>
                      </div>
                    
                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic3" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic3" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      </a>
                    </div>
                    <br>
                    <p>
                        <strong>Ubicación:</strong> Calle 71 # 65 – 150  Medellín <br>
                        <strong>Fecha de apertura:</strong> 2013<br>
						<strong>Descripción:</strong> 204 locales comerciales, 600 parqueaderos de carros y de motos, anclas Supermercado El Euro, Agaval. Alkomprar, Cines Procinal y  Juegos infantiles Happy City.
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div><!-- Modal -->
            <!-- Modal FLORIDA -->
            <div class="modal fade bs-example-modal-lg" id="uraba" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">NUESTRO URABA</h4>
                  </div>
                  <div class="modal-body">
                  	<img src="<?php echo get_template_directory_uri(); ?>/images/projects/uraba.jpg" width="898">
                     <br>
                    <p>
                        <strong>Ubicación:</strong> Calle 71 # 65 – 150  Medellín <br>
                        <strong>Fecha de apertura:</strong> 2013<br>
						<strong>Descripción:</strong> 204 locales comerciales, 600 parqueaderos de carros y de motos, anclas Supermercado El Euro, Agaval. Alkomprar, Cines Procinal y  Juegos infantiles Happy City.
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div><!-- Modal -->
        	<?php the_content(); ?>
     	</div><!-- .entry-content -->
        
  	</div><!-- .entry-container -->
    
</article><!-- #post-<?php the_ID(); ?> -->