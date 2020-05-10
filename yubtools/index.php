<?php
exit;

// config.php loads the Flickr API key and other configuration details
// (you'll be asked for these when you clone this app)
require_once 'config/config.php'; 

// our Flickr API module
require_once 'XNC/Services/Flickr.php';

// introductory HTML welcome
require_once 'welcome.php';

// remove non-safe characters from the submitted query
// or use a default query if there isn't one

$query = $_GET['q'] ? xnhtmlentities($_GET['q']) : 'frog';

// print the form
?>

<form action="index.php" METHOD="GET">
	<label for="q">Flickr Tag</label>
	<input name="q" value="<?php echo $query ?>"/>
	<input type="submit" value="Search Flickr"/>
</form>

<?php

// log into Flickr, using our config key

$flickr = new XNC_Services_Flickr(PrivateConfig::$flickrKey);

// execute a tag search

$response = $flickr->tagSearch($query);

// how'd we do?

echo "<h3>Showing {$response->totalResultsReturned}";
echo " of {$response->totalResultsAvailable} results</h3>";


// finally, print the results in a table

?>

<table width="99%">
	<thead>
		<tr>
			<th>Image</th>
			<th>Title</th>
		</tr>
	</thead>
	<tbody>
<?php

// loop through all the objects returned by the query

foreach ($response->Result as $result)
{
	// transform any non-safe characters in the image title
	$safetitle = xnhtmlentities($result->title);
	
	// print the table row with the object details
	echo <<<_HTML_
		<tr>
			<td><a href="{$result->Thumbnail->ClickUrl}"><img 
				src="{$result->Thumbnail->Url}"/></a></td>
			<td>{$safetitle}</td>
		</tr>
_HTML_;
}

// and we're done!

?>
	</tbody>
</table>

