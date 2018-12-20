			<?php 

			?>
			<footer id="footer">
				<div class="container">
				<div class="site-map" style="text-align:center;padding-top:7px; color:black;">
					<a href="http://santajuanainmobiliaria.com/">Inicio</a> | <a href="http://santajuanainmobiliaria.com/quienes-somos/">Quiénes Somos</a> | <a href="http://santajuanainmobiliaria.com/nuevos-proyectos/">Nuevos Proyectos</a> | <a href="http://santajuanainmobiliaria.com/proyectos-finalizados/">Proyectos Finalizados</a> | <a href="http://santajuanainmobiliaria.com/pague-su-factura/">Pague su Factura</a> | <a href="http://facturas.santajuanainmobiliaria.com/" target="_blank">Descargue su Factura</a> | <a href="http://santajuanainmobiliaria.com/contactenos/">Contáctenos</a> | <a href="http://santajuanainmobiliaria.com/noticias/">Noticias</a>
					</div>	

					<?php rose_framework::rose_footer_instagram(); ?>

					<div class="row widget-col bg-gray">

						<?php if(is_active_sidebar( 'footer_left' )) : ?>
							<div class="col-sm-6 bg-black">
								<div class="widget_footer_left">
									<?php dynamic_sidebar( 'footer_left' ); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>

					<div class="row widget-col bg-gray">

						<?php if(is_active_sidebar( 'footer_right' )) : ?>
							<div class="col-sm-6 bg-black">
								<div class="widget_footer_right">
									<?php dynamic_sidebar( 'footer_right' ); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>

					<?php rose_framework::rose_copyright(); ?>
					
					<span class="scroll-top"><i class="fa fa-angle-up"></i></span>
				

				</div>
			</footer>
		</div>

		<?php wp_footer(); ?>
		
	</body>
</html>