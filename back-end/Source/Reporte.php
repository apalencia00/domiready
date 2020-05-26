<table width="500" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#999999">
  <tr> 
    <td height="50" bgcolor="#CCCCCC"> <div align="left"><font size="2"><strong><font face="Verdana">Integración 
        de JasperReport con PHP</font></strong></font></div></td>
  </tr>
  <tr> 
    <td> 
    <br>
    <php
    
    if($_POST["select"] != "") {
      $dir ="D:\\tutorial\\";
      $informe = $_POST["select"];
      $jrDirLib = "D:\\tutorial\\lib\\";
    
      $handle = @opendir($jrDirLib);
  
      while(($lib = readdir($handle)) !== false) {
        $classpath .= 'file:'.$jrDirLib.'/'.$lib .';';
      }
  
      java_require($classpath);
  
      $jcm = new JavaClass("net.sf.jasperreports.engine.JasperCompileManager");
      $report = $jcm->compileReport($dir .$informe.".jrxml");
      
      $jfm = new JavaClass("net.sf.jasperreports.engine.JasperFillManager");
      $print = $jfm->fillReport($report,new Java("java.util.HashMap"),new Java("net.sf.jasperreports.engine.JREmptyDataSource"));
      
      $jem = new JavaClass("net.sf.jasperreports.engine.JasperExportManager");
      $jem->exportReportToPdfFile($print, $dir .$informe.".pdf");
    }
    
    ?>
    
      <form name="form1" method="post" action="#">
        <table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr> 
            <td width="50%"> <div align="right"><font size="2" face="Verdana">Documento:</font></div></td>
            <td><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
              <select name="select" id="doc">
                <option value="doc1" selected>documento 1</option>
                <option value="doc2">documento 2</option>
                <option value="doc3">documento 3</option>
              </select>
              </font></strong></td>
          </tr>
          <tr> 
            <td width="50%"> </td>
            <td><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
              <input type="submit" name="Submit" value="Enviar">
              </font></strong></td>
          </tr>
        </table>
      </form> 
    </td>
  </tr>
</table>