<!DOCTYPE html>
<html style="font-size: 16px;">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="page_type" content="np-template-header-footer-from-plugin">
    <title>debithistory</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
<link rel="stylesheet" href="debithistory.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 4.10.5, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "images/download.png"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="debithistory">
    <meta property="og:type" content="website">
  </head>
  <body class="u-body u-xl-mode"><header class="u-clearfix u-header u-white u-header" id="sec-cf88"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="User-login.html" data-page-id="61975515" class="u-image u-logo u-image-1" data-image-width="225" data-image-height="225" title="Blog">
          <img src="images/download.png" class="u-logo-image u-logo-image-1">
        </a>
      </div></header>
    <section class="u-align-center u-clearfix u-palette-5-light-2 u-section-1" id="sec-a73d">
      <div class="u-clearfix u-sheet u-sheet-1">
        <a href="menu.php" data-page-id="56113073" class="u-btn u-btn-round u-button-style u-hover-palette-1-light-2 u-palette-1-base u-radius-2 u-btn-1">Back<span class="u-icon u-text-white"><svg class="u-svg-content" viewBox="0 0 512 512" x="0px" y="0px" style="width: 1em; height: 1em;"><path d="M506.134,241.843c-0.006-0.006-0.011-0.013-0.018-0.019l-104.504-104c-7.829-7.791-20.492-7.762-28.285,0.068 c-7.792,7.829-7.762,20.492,0.067,28.284L443.558,236H20c-11.046,0-20,8.954-20,20c0,11.046,8.954,20,20,20h423.557 l-70.162,69.824c-7.829,7.792-7.859,20.455-0.067,28.284c7.793,7.831,20.457,7.858,28.285,0.068l104.504-104 c0.006-.006,0.011-.013,0.018-.019C513.968,262.339,513.943,249.635,506.134,241.843z"></path></svg><img></span>
        </a>
        <div class="u-expanded-width u-table u-table-responsive u-table-1">
          <table class="u-table-entity u-table-entity-1">
            <colgroup>
              <col width="33.3%">
              <col width="33.3%">
              <col width="33.400000000000006%">
            </colgroup>
            <tbody class="u-table-alt-palette-1-light-3 u-table-body">
              <tr style="height: 28px;">
                <td class="u-table-cell">Source</td>
                <td class="u-table-cell">Diff</td>
                <td class="u-table-cell"> Transaction Date</td>
              </tr>
  <?php
   session_start();
     //connect to database
     include "conn.php";
     if(!isset($_SESSION['login'])){
       header("Location: nohack.html");
    }else{

        $id=($_SESSION["login"]);
        $sql = "SELECT * FROM record where record.userid = ? ORDER BY shijian desc ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
          while($row = mysqli_fetch_array($result)){
          echo "
                <tr style='height: 65px;'>
                <td class='u-table-cell'>{$row['rsource']}</td>
                <td class='u-table-cell'>{$row['diff']}</td>
                <td class='u-table-cell'>{$row['shijian']}</td>
                </tr> ";
            }
        }else {
        echo "<p class='sub'>No Record!</p>";
        }
    } ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    
    
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-2a04"><div class="u-clearfix u-sheet u-sheet-1">
        <p class="u-small-text u-text u-text-variant u-text-1">Sample text. Click to select the Text Element.</p>
      </div></footer>
    <section class="u-backlink u-clearfix u-grey-80">
      <a class="u-link" href="https://nicepage.com/website-design" target="_blank">
        <span>Website Design</span>
      </a>
      <p class="u-text">
        <span>created with</span>
      </p>
      <a class="u-link" href="https://nicepage.studio" target="_blank">
        <span>Website Builder</span>
      </a>. 
    </section>
  </body>
</html>