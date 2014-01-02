<html>
<head>
   <link href="styles.css" rel="stylesheet" type="text/css" />
 <title>PHP Bing</title>
</head>
<body>
<?php     require("../includes/config2.php"); ?>

<form method="post" action="<?php echo $PHP_SELF;?>"> 
 Type in a search:<input type="text" id="searchText" name="searchText" value="<?php 
 if (isset($_POST['searchText'])){
  echo($_POST['searchText']); }
  else { echo('sushi');}
  ?>"/>
        <input type="submit" value="Search!" name="submit" id="searchButton" />
<?php
if (isset($_POST['submit'])) {
$request = 'http://api.search.live.net/json.aspx?Appid=qjajjTGgzY+NUpkBFrZ7zHpsAzxCT9merMpNZWGFEhs&sources=image&query=' . urlencode( $_POST["searchText"]);
$response  = file_get_contents($request);
$jsonobj  = json_decode($response);
dump($jsonobj);
echo('<ul ID="resultList">');                    
                
foreach($jsonobj->SearchResponse->Image->Results as $value)
{
echo('<li class="resultlistitem"><a href="' . $value->Url . '">');
echo('<img src="' . $value->Thumbnail->Url. '"></li>');

}
echo("</ul>");
} ?>
</form>
</body>
</html>
