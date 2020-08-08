<!doctype html>

<html>
    <head>
        <title>YouTube API Project</title>
        
        <link rel="stylesheet" type="text/css" href="../Youtube/Css/Style.css">
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        
    </head>
    <body>
        <h2>Search Videos on YouTube</h2>
        <div class="search-form-container">
            <form id="keywordForm" method="post" action=''>
                <div class="input-row">
                    Search Keyword : <input class="input-field" type="search" id="keyword" name="keyword"  placeholder="Enter Search Keyword..." required>
                </div>
                <div class="input-row">
                Max Results: <input type="number" class="input-field" id="result" name="result" placeholder="Max Results Resuired..." min="1" max="20" required>
                   </div>
                <input class="btn-submit"  type="submit" name="submit" value="Submit">
            </form>
        </div>
        
       
        <?php
              
         if(isset($response)){
                 $keywords = $response["keyword"];
                 $max = $response["result"];
              if (!empty($keywords))
              {   
                $apikey = 'AIzaSyDliyJ5AjeSRT26ncDNo9SYQCTXVjSuFm4'; 
                $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $keywords . '&maxResults=' . $max . '&key=' . $apikey;

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_VERBOSE, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);

                curl_close($ch);
                $data = json_decode($response);
                $value = json_decode(json_encode($data), true);
            ?>

            <div class="result-heading">About <?php echo $max; ?> Results</div>
            <div class="videos-data-container" id="SearchResultsDiv">
            <?php
				  $key=0;
                for ($i = 0; $i < $max; $i++) {
                    if($value['items'][$i]['id']['kind']=='youtube#video'){
                    $videoId = $value['items'][$key]['id']['videoId'];
                    $title = $value['items'][$key]['snippet']['title'];
                    $description = $value['items'][$key]['snippet']['description'];
                    ?> 
    
                        <div class="video-tile">
                        <div  class="videoDiv">
                            <iframe id="iframe" style="width:100%;height:100%" src="//www.youtube.com/embed/<?php echo $videoId; ?>" 
                                    data-autoplay-src="//www.youtube.com/embed/<?php echo $videoId; ?>?autoplay=1"></iframe>                     
                        </div>
                        <div class="videoInfo">
                        <div class="videoTitle"><b><?php echo $title; ?></b></div>
                        <div class="videoDesc"><?php echo $description; ?></div>
                        </div>
                        </div>
           <?php 
						$key++;
                }
                 else{
                  echo "Sorry, No Results found for the Search <b></u>".$keywords."</u> </b><br> Please Try some other Keyword";
               }
               }
              
            } 
         }
            ?> 
        </div>   
    </body>
</html>
