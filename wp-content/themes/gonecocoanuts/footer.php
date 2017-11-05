		<footer class="site-footer">
			<?php wp_footer(); ?>
			<!--<nav class="site-nav">
				<?php/*
				$args = array('theme_location' => 'footer');
				?>
				<?php wp_nav_menu( $args ); */?>
			</nav>-->
			
	
			<table id="footer-columns">
				<tr>
					<th>
						<span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=sAK8RUBUapD5W9vCJJ2kugf6XTTA5DMTzwkcgtfwXLMY8r4s0rhEYZzLeSf9"></script></span>
					</th>
					<th>
						<!-- PayPal Logo -->
						<table id="paypal-logo" border="0" cellpadding="0" cellspacing="0" align="center">
							<tr>
								<td align="center"></td>
							</tr>
							<tr>
								<td align="center">
									<a href="https://www.paypal.com/webapps/mpp/paypal-popup" title="How PayPal Works" onclick="javascript:window.open('https://www.paypal.com/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;">
										<img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_SbyPP_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark"></a>
								</td>
							</tr>
						</table>
						<!-- PayPal Logo -->
					</th>
					<th>
						<div class="widget-area">
							<?php if ( dynamic_sidebar('sidebar') ) : else : endif; ?>
						</div>
					</th>
				</tr>
			</table>
		</footer>
	</div> <!-- container -->
</body>
</html>