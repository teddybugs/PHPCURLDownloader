# PHPCURLDownloader

This file is to download vbulletin forum attachment file by providing the URL to the site, example:
https://www.vbulletin-site.com/search.php?searchid=40080663&page=22
it will scrap all the link on the page and look for:

**attachment.php?attachmentid=823974&d=1320428753**

and will download the content to your server (current only saving .jpg attachment).


----------


**Installation:**

    1) change the: 
    	$SCRAP_URL = "http://www.yourbulletin.com/";
    	
    2) change the:
    	$save_path = "C:\\wamp64\\www\\scraper\\tmp\\";
    	
    3) open it to your browser: http://localhost/scraper/get_link.php and put 
       it any vbulletin forum page.
    
    4) It will save the content to C:\\wamp64\\www\\scraper\\tmp\\

**Disclaimer:**
Use it on your own risk, i'm not responsible for any damage that done to your server, please evaluate the code for your self before using it.
