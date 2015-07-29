<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fn="http://www.w3.org/2005/xpath-functions" xmlns:xdt="http://www.w3.org/2005/xpath-datatypes" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
	<xsl:output version="4.0" method="html" omit-xml-declaration="yes" indent="no" encoding="UTF-8" doctype-public="-//W3C//DTD HTML 4.0 Transitional//EN" doctype-system="http://www.w3.org/TR/html4/loose.dtd"/>
	<xsl:param name="SV_OutputFormat" select="HTML"/>
	<xsl:variable name="XML" select="/"/>
	<xsl:param name="XML1"/>
	<xsl:param name="dimensione"/>
	<xsl:template match="/">
	<xsl:variable name="XML1" select="document($XML1)"/>
<body style="font-family:Arial, Helvetica, sans-serif; font-size:10px">
<div style="border:1px solid #9a9797;width:{$dimensione};background-color:#000000"><div style="background-color:#f2f2f2; border-bottom:1px solid #9a9797"><a href="http://www.openpolis.it/" target="_blank" style="border:0px none"><img src="http://www.openpolis.it/images/widget/open-widget.png" alt=" " width="74" height="21" style="border:0px none" /></a></div>
<div style="padding:6px 3px 6px 3px; font-weight:bold; background-color:#c9c7c7;">
<xsl:for-each select="PRESENZE_IN_VOTAZIONI_ELETTRONICHE_AULA">
								<xsl:for-each select="SENATORE">
<span style="font-size:11px;"><xsl:value-of select="@nome"/></span><br />
<span>Presenze in Parlamento<br />
(su <xsl:value-of select="./PRESENTE/NUMERO+./ASSENTE/NUMERO+./IN_MISSIONE/NUMERO"/> votazioni elettroniche)</span>
	</xsl:for-each>
</xsl:for-each>
</div>
<xsl:for-each select="PRESENZE_IN_VOTAZIONI_ELETTRONICHE_AULA">
											<xsl:for-each select="SENATORE">
<div>
<ul style="margin:0 0 10px 0; padding:0px;width:100%;">
<li style="list-style-type:none; padding:8px 0 8px 10px;border-bottom:1px dotted #ffffff;color:#ffffff">
<span><strong>PRESENTE</strong></span><br />
<span style="font-weight:bold;color:#ffffff;width:80px;display:block;float:left;">
															<xsl:for-each select="PRESENTE/NUMERO">
																<xsl:apply-templates/>
															</xsl:for-each>
															<xsl:for-each select="PRESENTE/PERCENTUALE">
															         (<xsl:apply-templates/>%)
															</xsl:for-each>
															</span>
<span style="font-weight:bold;display:block;"><xsl:choose>
												<xsl:when test="(round(PRESENTE/PERCENTUALE*5 div 100)) &gt; 0">
												<img>
												<xsl:attribute name="src">http://www.openpolis.it/images/symbols/0<xsl:value-of select="round(PRESENTE/PERCENTUALE*5 div 100)"/>m.png</xsl:attribute>
												<xsl:attribute name="style">border:0;</xsl:attribute>
												</img>
												</xsl:when>
     											<xsl:otherwise>
												<img>
												<xsl:attribute name="src">http://www.openpolis.it/images/symbols/01m.png</xsl:attribute>
												<xsl:attribute name="style">border:0;</xsl:attribute>
												</img>
												</xsl:otherwise>
												</xsl:choose>
												</span></li>

<li style="list-style-type:none; padding:8px 0 8px 10px;border-bottom:1px dotted #ffffff;color:#ffffff">
<span><strong>ASSENTE</strong></span><br />
<span style="font-weight:bold;color:#ffffff;width:80px;display:block;float:left;">
<xsl:for-each select="ASSENTE/NUMERO">
																<xsl:apply-templates/>
															</xsl:for-each>
															<xsl:for-each select="ASSENTE/PERCENTUALE">
															         (<xsl:apply-templates/>%)
															</xsl:for-each></span>
<span style="font-weight:bold;display:block;"><xsl:choose>
												<xsl:when test="(round(ASSENTE/PERCENTUALE*5 div 100)) > 0">
												<img>
												<xsl:attribute name="src">http://www.openpolis.it/images/symbols/0<xsl:value-of select="round(ASSENTE/PERCENTUALE*5 div 100)"/>m.png</xsl:attribute>
												<xsl:attribute name="style">border:0;</xsl:attribute>
												</img>
												</xsl:when>
     											<xsl:otherwise>
												<img>
												<xsl:attribute name="src">http://www.openpolis.it/images/symbols/01m.png</xsl:attribute>
												<xsl:attribute name="style">border:0;</xsl:attribute>
												</img>
												</xsl:otherwise>
												</xsl:choose>
												</span>
</li>

<li style="list-style-type:none; padding:8px 0 8px 10px;border-bottom:1px dotted #ffffff;color:#ffffff">
<span><strong>IN MISSIONE </strong></span><br />
<span style="font-weight:bold;color:#ffffff;width:80px;display:block;float:left;">
							<xsl:for-each select="IN_MISSIONE/NUMERO">
								<xsl:apply-templates/>
							</xsl:for-each>
							<xsl:for-each select="IN_MISSIONE/PERCENTUALE">
							         (<xsl:apply-templates/>%)
							</xsl:for-each>
							</span>
<span style="font-weight:bold;display:block;"><xsl:choose>
												<xsl:when test="(round(IN_MISSIONE/PERCENTUALE*5 div 100)) &gt; 0">
												<img>
												<xsl:attribute name="src">http://www.openpolis.it/images/symbols/0<xsl:value-of select="round(PRESENTE/PERCENTUALE*5 div 100)"/>m.png</xsl:attribute>
												<xsl:attribute name="style">border:0;</xsl:attribute>
												</img>
												</xsl:when>
     											<xsl:otherwise>
												<img>
												<xsl:attribute name="src">http://www.openpolis.it/images/symbols/01m.png</xsl:attribute>
												<xsl:attribute name="style">border:0;</xsl:attribute>
												</img>
												</xsl:otherwise>
												</xsl:choose>
												</span>
</li>

</ul>
</div>
</xsl:for-each>
</xsl:for-each>
</div>
</body>
</xsl:template>
</xsl:stylesheet>