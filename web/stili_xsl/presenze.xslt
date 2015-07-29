<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fn="http://www.w3.org/2005/xpath-functions" xmlns:xdt="http://www.w3.org/2005/xpath-datatypes" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
	<xsl:output version="4.0" method="html" indent="no" encoding="UTF-8" doctype-public="-//W3C//DTD HTML 4.0 Transitional//EN" doctype-system="http://www.w3.org/TR/html4/loose.dtd"/>
	<xsl:param name="SV_OutputFormat" select="'HTML'"/>
	<xsl:variable name="XML" select="/"/>
	<xsl:param name="XML1"/>
	<xsl:template match="/">
		<xsl:variable name="XML1" select="document($XML1)"/>
				
				<div class="header2">
				<span class="rights-elements">Esporta <a href="" title="" hreflang="it" lang="it"><img src="img/symbols/xml.png" alt="Esporta XML" width="23" height="12" border="0" /></a> <a href="#" title="" hreflang="it" lang="it"><img src="img/symbols/blog.png" alt="Esporta per Blog" width="76" height="12" /></a> <a href="#" title="" hreflang="it" lang="it"><img src="img/buttons/close.png" alt="Chiudi blocco" width="15" height="14" /></a></span>
				<h3>Presenze in Parlamento <span>(su 4.000 votazioni elettroniche)</span> <a href="#" title="" hreflang="it" lang="it">[?]</a></h3>
				</div>
			<div class="table-container">
			<table cellspacing="0" border="0" summary="Tabella delle presenze in parlamento">
			<tbody>
										<xsl:for-each select="PRESENZE_IN_VOTAZIONI_ELETTRONICHE_AULA">
											<xsl:for-each select="DEPUTATO">
												<xsl:for-each select="PRESENTE">
													<tr class="dark">
													        <td>
														<strong>Presente</strong>
														</td>
														<td class="center">
															<xsl:for-each select="NUMERO">
																<xsl:apply-templates/>
															</xsl:for-each>
															<xsl:for-each select="PERCENTUALE">
															         (<xsl:apply-templates/>)
															</xsl:for-each>
														</td>
														<td class="lastcenter">
														<xsl:for-each select="NUMERO">
															<xsl:if test="133 > 10">
															valutazione
															</xsl:if>
														</xsl:for-each>	
														</td>
													</tr>
												</xsl:for-each>
												<xsl:for-each select="ASSENTE">
														<tr class="light">
								        <td>
									<strong>Assente</strong>
									</td>
									<td class="center">
										<xsl:for-each select="NUMERO">
											<xsl:apply-templates/>
										</xsl:for-each>
										<xsl:for-each select="PERCENTUALE">
										         (<xsl:apply-templates/>)
										</xsl:for-each>
									</td>
									<td class="lastcenter">
										
									</td>
									</tr>
												</xsl:for-each>
												<xsl:for-each select="IN_MISSIONE">
					<tr class="dark">
					        <td>
						<strong>In missione</strong>
						</td>
						<td class="center">
							<xsl:for-each select="NUMERO">
								<xsl:apply-templates/>
							</xsl:for-each>
							<xsl:for-each select="PERCENTUALE">
							         (<xsl:apply-templates/>)
							</xsl:for-each>
						</td>
						<td class="lastcenter">
							
						</td>
					</tr>
												</xsl:for-each>
											</xsl:for-each>
										</xsl:for-each>
						</tbody>
				<xsl:for-each select="$XML">
					<tbody>
							<xsl:for-each select="PRESENZE_IN_VOTAZIONI_ELETTRONICHE_AULA">
								<xsl:for-each select="DEPUTATO">
									<xsl:for-each select="PRESENTE">
										<tr>
											<td>
												<xsl:for-each select="NUMERO">
													<xsl:apply-templates/>
												</xsl:for-each>
											</td>
											<td>
												<xsl:for-each select="PERCENTUALE">
													<xsl:apply-templates/>
												</xsl:for-each>
											</td>
										</tr>
									</xsl:for-each>
								</xsl:for-each>
							</xsl:for-each>
						</tbody>
					
				</xsl:for-each>
				</table>
				</div>
		
	</xsl:template>
</xsl:stylesheet>