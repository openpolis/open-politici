<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fn="http://www.w3.org/2005/xpath-functions" xmlns:xdt="http://www.w3.org/2005/xpath-datatypes" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
	<xsl:output version="4.0" method="html" omit-xml-declaration="yes" indent="no" encoding="UTF-8" doctype-public="-//W3C//DTD HTML 4.0 Transitional//EN" doctype-system="http://www.w3.org/TR/html4/loose.dtd"/>
	<xsl:param name="SV_OutputFormat" select="HTML"/>
	<xsl:variable name="XML" select="/"/>
	<xsl:param name="XML1"/>
	<xsl:param name="dimensione"/>
	<xsl:template match="/">
	<xsl:variable name="XML1" select="document($XML1)"/>
<body style="font-family:Arial, Helvetica, sans-serif; font-size:10px">
<div style="border:1px solid #9a9797;width:{$dimensione}; background-image:url(http://www.openpolis.it/images/widget/bg6.png); background-repeat:repeat-x; background-position:left bottom;background-color:#000000">
<div style="background-color:#f2f2f2; border-bottom:1px solid #9a9797"><a href="http://www.openpolis.it/" target="_blank" style="border:0px none"><img src="http://www.openpolis.it/images/widget/open-widget.png" alt=" " width="74" height="21" style="border:0px none" /></a></div>
<div style="padding:6px 3px 6px 3px; font-weight:bold; background-color:#000000;color:#ffffff;border-bottom:2px solid #ffffff;">
<xsl:for-each select="VOTI_CHIAVE">
								<xsl:for-each select="SENATORE">
<span style="font-family:Arial, Helvetica, sans-serif;font-size:11px;"><xsl:value-of select="@nome"/></span><br />
<span style="font-family:Arial, Helvetica, sans-serif;font-size:10px;">Voti chiave in parlamento<br />
</span>
	</xsl:for-each>
</xsl:for-each>
</div>
<xsl:for-each select="VOTI_CHIAVE">
											<xsl:for-each select="SENATORE">
<div>
<ul style="margin:0 0 10px 0; padding:0px;width:100%;">
<xsl:for-each select="VOTO/ATTO_URL">

<li style="list-style-type:none; padding:8px 0 8px 10px;border-bottom:1px dotted #ffffff">
<a>
<xsl:attribute name="href">
<xsl:value-of select="string(../../../SENATORE/@url_openpolis)"/>
</xsl:attribute>
<xsl:attribute name="style">
font-weight:bold;color:#ffffff;text-decoration:none;
</xsl:attribute>
<strong><xsl:value-of select="string(../TITOLO)"/> </strong>
</a>
<br />
<span style="font-weight:bold;color:#9a9797">Voto:</span> <span style="font-weight:bold;color:#ffffff"><xsl:value-of select="string(../VOTO_ESPRESSO)"/></span><br />
<span style="font-weight:bold;color:#9a9797">Esito:</span> <span style="font-weight:bold;color:#ffffff;"><xsl:value-of select="string(../ESITO)"/></span><br />
</li>

</xsl:for-each>
</ul>
</div>
</xsl:for-each>
</xsl:for-each>
</div>
</body>
</xsl:template>
</xsl:stylesheet>