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
                    	El Tesoro<br>
                        <strong>Ubicación:</strong> Carrera 25 A # 1 A sur 45 Medellín <br>
                        <strong>Fecha de apertura:</strong> 1999
                    </div>
                </a>
                </div>
    
                <div class="box panel panel-default">
                <a href="#torre" data-toggle="modal" style="color:#464646; text-decoration:none;">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/projects/thumbnails/tesoro-torre.jpg">
                    <div class="panel-body">
                    	Torre Médica<br>
                        <strong>Ubicación:</strong> Carrera 25 A # 1 A sur 45 Medellín<br>
						<strong>Fecha de apertura:</strong> 2013
                    </div>
                </a>
                </div>
    
                <div class="box panel panel-default">
                <a href="#puerta" data-toggle="modal" style="color:#464646; text-decoration:none;">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/projects/thumbnails/puerta.jpg">
                    <div class="panel-body">
                    	Puerta del Norte<br>
                       <strong>Ubicación:</strong> Diagonal 55 # 34- 67 Niquia - Bello<br>
                       <strong>Fecha de apertura:</strong> 2008
                    </div>
                </a>
                </div>
    
                <div class="box panel panel-default">
                <a href="#florida" data-toggle="modal" style="color:#464646; text-decoration:none;">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/projects/thumbnails/florida.jpg">
                    <div class="panel-body">
                        Florida Parque<br>
                        <strong>Ubicación:</strong> Calle 71 # 65 – 150  Medellín<br>
						<strong>Fecha de apertura:</strong> 2013
                    </div>
                </a>
                </div>
                <div class="box panel panel-default">
                <a href="#uraba" data-toggle="modal" style="color:#464646; text-decoration:none;">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/projects/thumbnails/nuestro.jpg">
                    <div class="panel-body">
                       	Nuestro Uraba<br>
                        <strong>Ubicación:</strong> KM 100 Apartado - Urabá<br>
						<strong>Fecha de apertura:</strong> 2015
                    </div>
                </a>
                </div>
                <div class="box panel panel-default">
                <a href="#norte" data-toggle="modal" style="color:#464646; text-decoration:none;">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/projects/thumbnails/entrada.jpg">
                    <div class="panel-body">
                       	Entrada Norte<br>
                        <strong>Ubicación:</strong> Zona Norte, en el km 2 vía al mar<br>
						<strong>Fecha de apertura:</strong> 2013
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
                    <h4 class="modal-title" id="myModalLabel">Parque Comercial El Tesoro</h4>
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
                    <p style="text-align:justify;">
                        <strong>Ubicación:</strong> Carrera 25 A # 1 A sur 45 Medellín <br>
                        <strong>Fecha de apertura:</strong> 1999<br>
						<strong>Descripción:</strong> Parque Comercial con un agradable diseño campestre, una excelente mezcla comercial con las mejores marcas nacionales e internacionales; El Tesoro se ha convertido en un icono emblemático de la ciudad de Medellín, e incluso un lugar obligado de visitar por turistas, cuenta con 358 locales comerciales, supermercado Carulla, cines Cinemark y juegos infantiles Happy City.
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
                    <h4 class="modal-title" id="myModalLabel">Torre Médica (El Tesoro)</h4>
                  </div>
                  <div class="modal-body">
                   <div id="carousel-example-generic2" class="carousel slide" data-ride="carousel">
                    
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                        <div class="item active">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/torre2.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/torre3.jpg">
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
                    <p style="text-align:justify;">
                        <strong>Ubicación:</strong> Carrera 25 A # 1 A sur 45 Medellín <br>
                        <strong>Fecha de apertura:</strong> 2013<br>
						<strong>Descripción:</strong> Torre médica que cuenta con la mejor mezcla de los médicos más reconocidos de la ciudad de Medellín e incluso del país, esta torre cuenta con 20 pisos ubicada en la tercera etapa de El Tesoro, con 140 consultorios.
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
                    <h4 class="modal-title" id="myModalLabel">Centro Comercial Puerta del Norte</h4>
                  </div>
                  <div class="modal-body">
                  <div id="carousel-example-generic4" class="carousel slide" data-ride="carousel">
                    
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox4">
                        <div class="item active">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/puerta.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/puerta2.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/puerta3.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/puerta4.jpg">
                        </div>
                      </div>
                    
                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic4" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic4" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      </a>
                    </div>
                    <br>
                    <p style="text-align:justify;">
                        <strong>Ubicación:</strong> Diagonal 55 # 34- 67 Niquia - Bello  <br>
                        <strong>Fecha de apertura:</strong> 2008<br>
						<strong>Descripción:</strong> Centro Comercial con la mejor ubicación de la ciudad, al encontrarse al frente de la estación del metro Niquia y estar en la entrada a Medellín de la parte norte del país, cuenta con un área construida de 128.467,78 MT2 y una importante mezcla comercial que cuenta con 358 locales, 43 burbujas y 237 marcas.
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
                    <h4 class="modal-title" id="myModalLabel">Florida Parque Comercial</h4>
                  </div>
                  <div class="modal-body">
                    <div id="carousel-example-generic3" class="carousel slide" data-ride="carousel">
                    
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox3">
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
                    <p style="text-align:justify;">
                        <strong>Ubicación:</strong> Calle 71 # 65 – 150  Medellín <br>
                        <strong>Fecha de apertura:</strong> 2013<br>
						<strong>Descripción:</strong> Centro comercial ubicado en la parte noroccidental de la ciudad de Medellín con 37 barrios aledaños. Cuenta con  204 locales comerciales, 600 parqueaderos de carros y de motos, Supermercado El Euro, y almacenes de cadena como Agaval y Alkomprar, Cines Procinal y Juegos infantiles Happy City.
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div><!-- Modal -->
            <!-- Modal Uraba -->
            <div class="modal fade bs-example-modal-lg" id="uraba" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nuestro Uraba</h4>
                  </div>
                  <div class="modal-body">
                  	<img src="<?php echo get_template_directory_uri(); ?>/images/projects/uraba.jpg" width="868">
                     <br>
                    <p style="text-align:justify;">
                        <strong>Ubicación:</strong> KM 100 Apartado - Urabá <br>
                        <strong>Fecha de apertura:</strong> 2015<br>
						<strong>Descripción:</strong> Centro comercial ubicado en la principal vía de arteria, punto estratégico en donde esta desarrollándose el crecimiento del municipio de aparatado, cuenta con120 locales comerciales, 450 Parqueaderos para carros y motos, supermercado Olímpica SAO, cines Procinal, Juegos Infantiles Happy City.
                    </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  </div>
                </div>
              </div>
            </div><!-- Modal -->
            <!-- Modal Uraba -->
            <div class="modal fade bs-example-modal-lg" id="norte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Centro Logístico Entrada Norte</h4>
                  </div>
                  <div class="modal-body">
                  	<div id="carousel-example-generic5" class="carousel slide" data-ride="carousel">
                    
                      <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox5">
                        <div class="item active">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/entrada.jpg">
                        </div>
                        <div class="item">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/projects/entrada2.jpg">
                        </div>
                      </div>
                    
                      <!-- Controls -->
                      <a class="left carousel-control" href="#carousel-example-generic5" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      </a>
                      <a class="right carousel-control" href="#carousel-example-generic5" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      </a>
                    </div>
                    <br>
                    <p style="text-align:justify;">
                        <strong>Ubicación:</strong> Zona Norte, en el km 2 vía al mar <br>
                        <strong>Fecha de apertura:</strong> 2013<br>
						<strong>Descripción:</strong> Proyecto de bodegas que cuenta con un Lote de 19,000 m 2, con un área construida en 2 niveles de19,213 m2 y un área de oficinas de 2,400m2. El área de zonas verdes y parqueaderos es de 9,650 m2 con un área de vías de 5,450 m2.

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