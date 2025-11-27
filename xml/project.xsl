<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:template match="/">
    <xsl:for-each select="projects/project">
<article class="project-card">
  <h3 class="project-title"><xsl:value-of select="title"/></h3>
  <p class="project-desc"><xsl:value-of select="desc"/></p>
  <p class="muted"><xsl:value-of select="tech"/></p>
  <p class="project-link" style="display:none">
    <xsl:value-of select="link"/>
  </p>
</article>

    </xsl:for-each>
  </xsl:template>
</xsl:stylesheet>
