Sample PHP for Category Based On-Page Playlist
============

This PHP script pulls a list of all entries in a given (via GET) category and user, and presents a player with clickable thumbnails.   
It shows how to use the media->list API as well as using the player sendNotification API.   
   
To set up the script - make sure to fill in the configuration details at the top of index.php
Then point your browser to the index.php script, providing `kmscategory` and `kmsuser` over the URL parameters, indicating the id of the user and the category to list.
