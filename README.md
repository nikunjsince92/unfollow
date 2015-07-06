# unfollow
This Application is developed for Twitter users, so that they can see there friends list in a better way and can also unfollow the unwanted friends.

Here is the working link of the project
        http://nikunj.freakengineers.com/unfollow/index.php

Frontend-
1). Completely on Bootstrap.
2). Animations using jQuery.
3). Have tried to keep the interface simple but classy.
4). For user convenience, two modes are provided to display friends list (box and table view).
5). By clicking on friends name or photo, user can see there twitter profile.

Middleware-
Two APIs have been developed.
1). To return a JSON consisting only required data about the friends.
2). To return a JSON consisting all the details of the friend we have unfollowed.

Backend-
1). Proper authorization through OAuth.
2). Two REST APIs
friends/list
friendships/destroy
3). Proper Sign Out (through sessions).
4). Separate file for every task for better understanding of code by everyone.
