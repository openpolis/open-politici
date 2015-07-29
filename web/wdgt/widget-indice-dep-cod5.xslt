<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fn="http://www.w3.org/2005/xpath-functions" xmlns:xdt="http://www.w3.org/2005/xpath-datatypes" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
	<xsl:output version="4.0" method="html" omit-xml-declaration="yes" indent="no" encoding="UTF-8" doctype-public="-//W3C//DTD HTML 4.0 Transitional//EN" doctype-system="http://www.w3.org/TR/html4/loose.dtd"/>
	<xsl:param name="SV_OutputFormat" select="HTML"/>
	<xsl:variable name="XML" select="/"/>
	<xsl:param name="XML1"/>
	<xsl:param name="dimensione"/>
	<xsl:param name="totale_deputati"/>
	<xsl:template match="/">
	<xsl:variable name="XML1" select="document($XML1)"/>
<body style="font-family:Arial, Helvetica, sans-serif; font-size:10px">
<div style="border:1px solid #9a9797;width:{$dimensione}; background-image:url(http://www.openpolis.it/images/widget/bg5.png); background-repeat:repeat-x; background-position:left bottom;background-color:#dfddde">
<div style="background-color:#f2f2f2; border-bottom:1px solid #9a9797"><a href="http://www.openpolis.it/" target="_blank" style="border:0px none"><img src="http://www.openpolis.it/images/widget/open-widget.png" alt=" " width="74" height="21" style="border:0px none" /></a></div>



<xsl:for-each select="INDICE_ATTIVITA">
	<xsl:for-each select="DEPUTATO">
	<div style="padding:6px 3px 6px 3px; font-weight:bold; background-color:#a6a6a6;">
	<span style="font-size:11px;"><xsl:value-of select="@nome"/></span><br />
	<span>Indice di attivita'</span>
	</div>
	<div>
	<div style="margin:10px;padding:0 0 8px 0;border-bottom:1px dotted #2a76d4;font-weight:bold;">
	<span style="display:block;padding:0 0 5px 0">Indice: <span style="background-color:#10952a;color:#ffffff;padding:3px;"><xsl:value-of select="INDICE"/></span> (min 0 - max 10) </span>
	<span style="display:block;padding:0 0 5px 0;color:#2a76d4;font-size:13px;"><xsl:value-of select="POSIZIONE"/>° su <xsl:value-of select="$totale_deputati"/></span>
	<span>
	<img>
	<xsl:attribute name="src">/images/symbols/0<xsl:value-of select="round(INDICE div 2)"/>m.png</xsl:attribute>
	<xsl:attribute name="width">72</xsl:attribute>
	<xsl:attribute name="height">12</xsl:attribute>
	</img>
	</span>
	</div>
	</div>
	</xsl:for-each>
</xsl:for-each>

<table width="90%" border="0" cellspacing="0" cellpadding="0" style="font-weight:bold;color:#2a76d4;margin:0 10px 10px 10px;font-size:10px;">
<xsl:for-each select="INDICE_ATTIVITA/DEPUTATO/node()[contains(.,'a')]">
<tr>
<td style="padding:5px 0 5px 0">
<a>
<xsl:attribute name="href">
<xsl:value-of select="string(LINK)"/>
</xsl:attribute>
<xsl:attribute name="style">
font-weight:bold;color:#2a76d4;margin:0 10px 10px 10px;font-size:10px;
</xsl:attribute>
<strong><strong><xsl:value-of select="concat(substring(name(),1,1),translate(translate(substring(name(),2),'ABCDEFGHIJKLMNOPQRSTUVWXYZ','abcdefghijklmnopqrstuvwxyz'),'_',' '))"/></strong></strong>
</a>
</td>
<td style="padding:5px 0 5px 0;text-align:center;">
<xsl:value-of select="NUMERO"/>
</td>
</tr>
</xsl:for-each>
</table>

</div>
</body>
</xsl:template>
</xsl:stylesheet>